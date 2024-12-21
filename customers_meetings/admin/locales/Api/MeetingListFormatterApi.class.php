<?php

require_once __DIR__."/FormFilters/MeetingApiFormFilter.class.php";
require_once __DIR__."/Formatters/MeetingItemFormatterApi.class.php";

class MeetingListFormatterApi  extends mfFormatterActionApi{
                            
    function getSettings()
    {
        return $this->settings=$this->settings===null?new CustomerMeetingSettings():$this->settings;
    }
    
    function getHeader()
    {
        if ($this->isFromTheme())       
        {            
            return $this->theme_api->getHeader(); 
        }    
        return array(
                     
            
                   
                    );
    }        
    
    
    function getFilter()
    {
        if ($this->isFromTheme())       
        {            
            return $this->theme_api->getFilter(); 
        }    
        return array(
                     'search'=>array(
                            'query'=>array('label'=>__('Customer, Phone, City, Company')),                                                                                          
                      ),
                      'equal'=>array(
                           "opc_range_id"=>array(
                                'label'=>__('Range'),
                                'condition'=> ($this->formFilter->equal->hasValidator('opc_range_id'))
                               ),
                           "company_id"=>array(
                               'label'=>__('Company'),
                               'condition'=> ($this->formFilter->equal->hasValidator('company_id'))
                               ),
                           "sales_id"=>array(
                               'label'=>__('commercial_1'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_sale1']]))
                               ),
                           "sale2_id"=>array(
                               'label'=>__('commercial_2'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_sale2']]))
                               ),
                           "telepro_id"=>array(
                               'label'=>__('telepro_id'),
                               'condition'=> ($this->formFilter->equal->hasValidator('telepro_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_telepro']]))
                               ),
                           "assistant_id"=>array(
                               'label'=>__('assistant_id'),
                                'condition'=> ($this->formFilter->equal->hasValidator('assistant_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_assistant']]) && (count($this->formFilter->equal['assistant_id']->getOption('choices')) > 1))
                               ),
                           "team_id"=>array(
                               'label'=>__('team_id'),
                               'condition'=> ($this->formFilter->equal->hasValidator('team_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_team']]))
                               ),
                           "campaign_id"=>array(
                               'label'=>__('Compaign'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_campaign']]))
                               ),
                           "callcenter_id"=>array(
                               'label'=>__('callcenter'),
                               'condition'=> ($this->formFilter->equal->hasValidator('callcenter_id') && $this->getUser()->hasCredential([['superadmin','meeting_view_list_callcenter']]))
                               ),
                           "polluter_id"=>array(
                               'label'=>__('polluter'),
                               'condition'=> ($this->formFilter->equal->hasValidator('polluter_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_polluter']]))
                               ),
                           "state_id"=>array(
                               'label'=>__('sale_state'),
                               'condition'=> ($this->formFilter->equal->hasValidator('state_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_state']]))
                               ),
                           "status_call_id"=>array(
                               'label'=>__('status_call'),
                               'condition'=> ($this->formFilter->equal->hasValidator('status_call_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_callstatus']]))
                               ),
                           "status_lead_id"=>array(
                               'label'=>__('Status lead'),
                               'condition'=> ($this->formFilter->equal->hasValidator('status_lead_id') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_lead_status']]))
                               ),
                           "is_confirmed"=>array(
                               'label'=>__('Confirmed'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','meeting_view_list_confirmed']]))
                               ),
                            "status"=>array(
                               'label'=>__('Status'),
                               'condition'=> ($this->formFilter->equal->hasValidator('status') && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_status']]))
                               ),
                      ),            
                    );
    }
    
    function process()
    {   
        try
        {
            $this->loadTheme();            
            $this->formFilter= new MeetingApiFormFilter($this->getUser());              
            foreach ($this->getHeader() as $field=>$values)
                $this->getWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
             foreach ($this->getFilter() as $field=>$values)
                     $this->getFilterWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
            $this->pager=new CustomerMeetingsPager($this->formFilter);    
            $this->formFilter->bind($this->getAction()->getRequest()->getPostParameter('filter'));
            if ($this->formFilter->isValid() || $this->getAction()->getRequest()->getPostParameter('filter')==null)
            {        
                //echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUSer()->getCountry());
                $this->pager->setParameter('user_id',$this->getUSer()->getGuardUser()->get('id'));
                $this->pager->setParameter('callcenter_id',$this->getUser()->getGuardUser()->get('callcenter_id')); 
                $this->pager->setPage($this->getAction()->getRequest()->getPostParameter('page'));                    
                $this->pager->execute();                                         
                if (!$this->getWidgets()->isEmpty())
                    $this->data['header']=$this->getWidgets()->toArray();
                
                foreach ($this->pager->getItems() as $item)
                {
                    $this->data['data'][]=$item->toArrayForApi($this->formFilter)->toArray();                                    
                }                  
                $this->data['number_of_items']=array('value'=>$this->pager->getResults(),'text'=>FloatFormatter::getInstance($this->pager->getResults())->getChoices());
                $this->data['schema']=$this->formFilter->getMapping()->getValues()->toArray();
                
                $this->data['schema']['data']=$this->getFilterWidgets()->toArray();
                $this->data['defaults']=$this->formFilter->getDefaults();
                return $this;
            }   
            throw new mfException(__('Filter has some errors.'));
        }
        catch (mfException $e)
        {
            //var_dump($e->getMessage());
            //die(__METHOD__);
            $this->data['errors']=$this->formFilter->getErrorSchema()->getErrorsMessage();
        }       
    }
    
  
   

    
   
}

