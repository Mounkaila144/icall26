<?php

require_once __DIR__."/FormFilters/CustomerMeetingApi2FormFilter.class.php";
require_once __DIR__."/Formatters/CustomerMeetingItemFormatterApi2.class.php";

class CustomerMeetingListFormatterApi2 extends mfFormatterActionApi2 {
                            
    function getSettings()
    {
        return $this->settings=$this->settings===null?new CustomerMeetingSettings():$this->settings;
    }
       
    
    function process()
    {   
        try
        {            
            $this->formFilter= new CustomerMeetingApi2FormFilter($this->getUser());              
          //  foreach ($this->getHeader() as $field=>$values)
          //      $this->getWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
          ////   foreach ($this->getFilter() as $field=>$values)
          ///           $this->getFilterWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
            $this->pager=new CustomerMeetingsPager($this->formFilter);    
            $this->formFilter->bind($this->getAction()->getRequest()->getPostParameter('filter'));
            if ($this->formFilter->isValid() || $this->getAction()->getRequest()->getPostParameter('filter')==null)
            {        
                //echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getLanguage());
                $this->pager->setParameter('user_id',$this->getUSer()->getGuardUser()->get('id'));
                $this->pager->setParameter('callcenter_id',$this->getUser()->getGuardUser()->get('callcenter_id')); 
                $this->pager->setPage($this->getAction()->getRequest()->getPostParameter('page'));                    
                $this->pager->execute();                                                    
                foreach ($this->pager->getItems() as $item)
                {
                    $this->data['data'][]=$item->toArrayForApi2($this->formFilter)->toArray();                                          
                }                                  
                $this->data['number_of_items']=$this->pager->getResults();             
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

