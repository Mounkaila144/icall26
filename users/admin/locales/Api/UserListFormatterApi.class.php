<?php

require_once __DIR__."/FormFilters/UsersApiFormFilter.class.php";
require_once __DIR__."/Formatters/UserItemFormatterApi.class.php";

class UserListFormatterApi  extends mfFormatterActionApi{
    
                        
    function getSettings()
    {
        return $this->settings=$this->settings===null?new UserSettings():$this->settings;
    }
    
    function getHeader()
    {
        if ($this->isFromTheme())       
        {            
            return $this->theme_api->getHeader(); 
        }    
        return array(
                     
            
                    /* 'id'=>array(
                         'label'=>__('ID'),
                         'style'=>'display:none'
                         ),
                     'username'=>array('label'=>__("Username")),
                     'firstname'=>array('label'=>__("Firstname")),
                     'lastname'=>array('label'=>__("Lastname")),
                     'email'=>array('label'=>__("Email")),
                     'is_locked'=>array('label'=>__('Locked'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                     'locked_at'=>array('label'=>__('Locked at'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                     'unlocked_by'=>array('label'=>__('Unlocked by'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                     'number_of_try'=>array('label'=>__('Number of trys'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                     'profile_id'=>array('label'=>__('Profiles'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_profile']])
                                        ), 
                     'group_id'=>array('label'=>__('Groups'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_users_list_groups']])
                                        ), 
                     'team_id'=>array('label'=>__('Teams')), 
                     'callcenter_id'=>array('label'=>__('Callcenter'),
                                     'condition'=>$this->formFilter->equal->hasValidator('callcenter_id')
                                        ), 
                     'company_id'=>array('label'=>__('Company'),
                                     'condition'=>$this->formFilter->equal->hasValidator('company_id')
                                        ), 
                     'is_active'=>array('label'=>__('State')), 
                     'created_at'=>array('label'=>__('Date creation')), 
                     'lastlogin'=>array('label'=>__('Last login')), 
                     'last_password_gen'=>array('label'=>__('Last password generation')), 
                     'has_user_permissions'=>array('label'=>__('Permissions'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_user_permissions']])
                                        ),                                           
                     'manager_id'=>array('label'=>__('Managers/Teams'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_user_list_managers']]),                                     
                                        ), 
                     'status'=>array('label'=>__('Status'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_user_remove']])
                                        ), */
                   //  'actions'=>array('label'=>__('Actions')), 

                    //  'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'Formatted','options'=>'d'))),  // formatter
                    //  'created_at'=>array('output'=>'')   // method in object 
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
                            'username'=>array('label'=>__('Username')),                           
                            "id",                             
                            "firstname"=>array('label'=>__('Firstname')),
                            "lastname"=>array('label'=>__('Lastname')),
                            "email"=>array('label'=>__('Email')),                                    
                            "number_of_try"=>array('label'=>__('Number of trys')),                                    
                      ),
                      'equal'=>array(
                           "unlocked_by"=>array(
                                'label'=>__('Unlocked by'),
                                'condition'=> ($this->getUser()->hasCredential([['superadmin','settings_users_list_security']]))
                               ),
                           "is_locked"=>array(
                               'label'=>__('Locked'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','settings_users_list_security']]))
                               ),
                           "profile_id"=>array(
                               'label'=>__('Profils'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','settings_users_list_profile']]))
                               ),
                           "group_id"=>array(
                               'label'=>__('Groupes'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','settings_users_list_groups']]))
                               ),
                           "team_id"=>array(
                               'label'=>__('Team')
                               ),
                           "callcenter_id"=>array(
                               'label'=>__('Callcenter'),
                               'condition'=> ($this->formFilter->equal->hasValidator('callcenter_id') && (count($this->formFilter->equal['callcenter_id']->getOption('choices')) > 1))
                               ),
                           "is_active"=>array(
                               'label'=>__('State'),
                               ),
                           "has_user_permissions"=>array(
                               'label'=>__('Permissions'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','settings_user_permissions']]))
                               ),
                           "manager_id"=>array(
                               'label'=>__('Team Manager ?'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','settings_user_list_managers']]))
                               ),
                           "creator_id"=>array(
                               'label'=>__('Creator'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','settings_user_list_creator']]))
                               ),
                           "status"=>array(
                               'label'=>__('Status'),
                               'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','settings_user_remove']]))
                               ),
                          
                      ),            
                    );
    }
    
    function process()
    {   
        try
        {
            $this->loadTheme();            
            $this->formFilter= new UsersApiFormFilter($this->getUser());              
            foreach ($this->getHeader() as $field=>$values)
                $this->getWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
             foreach ($this->getFilter() as $field=>$values)
                     $this->getFilterWidgets()->pushIf(is_numeric($field)?true:(isset($values[$field]['condition'])?$values[$field]['condition']:true), new mfWidgetFieldApi(is_numeric($field)?$values:$field, is_numeric($field)?array():$values));
            $this->pager=new UserPager();    
            $this->formFilter->bind($this->getAction()->getRequest()->getPostParameter('filter'));
            if ($this->formFilter->isValid() || $this->getAction()->getRequest()->getPostParameter('filter')==null)
            {        
                //echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUSer()->getCountry());
                $this->pager->setParameter('user_id',$this->getUSer()->getGuardUser()->get('id'));
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

