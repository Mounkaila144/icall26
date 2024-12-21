<?php

class UserListTheme34FormatterApi  extends UserListFormatterApi {
    
   
    
    function getHeader()
    {        
        return array(
                     'id'=>array(
                         'label'=>__('ID'),
                         'style'=>'display:none'
                         ),
                  /*   'username'=>array('label'=>__("Username")),
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
                                     'condition'=>$this->getAction()->formFilter->equal->hasValidator('callcenter_id')
                                        ), 
                     'company_id'=>array('label'=>__('Company'),
                                     'condition'=>$this->getAction()->formFilter->equal->hasValidator('company_id')
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
                                        ), 
                   //  'actions'=>array('label'=>__('Actions')), */

                    //  'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'Formatted','options'=>'d'))),  // formatter
                    //  'created_at'=>array('output'=>'')   // method in object 
                    );
    }        
    
    
     
    
  
   

    
   
}

