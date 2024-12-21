<?php

class UserItemFormatterApi extends mfFormatterFilterItemApi  {        
     
    function getDefaultsData()
    {
        return $this->getItem()->toArray(array());
    }
    
    function getData()
    {    
        if ($this->isFromThemeFormatter())       
        {                                                 
            return $this->theme_formatter_api->getData();                 
        }
        return array(  'id'=>array('properties'=>array('style'=>'display:none'),
                                    'label'=>__('id')
                                  ),
                       "line1"=>array(                           
                            'fields'=>array(                                                             
                                'is_active'=>array('label'=>__('State'),
                                                    'choices'=>array(
                                                        array(
                                                            'value'=>'YES',
                                                            'icon'=>'ion-icon-checkmark-outline',
                                                            'color'=>'green'
                                                        ),
                                                        array(
                                                            'value'=>'NO',
                                                            'icon'=>'ion-icon-close-outline',
                                                            'color'=>'red'
                                                        ),
                                                        
                                                    )
                                    ),                                
                                'username'=>array('label'=>__('Username')),
                                'firstname'=>array('label'=>__('Firstname')),
                                'lastname'=>array('label'=>__('Lastname')),
                                'email'=>array('label'=>__('Email')),
                            ),                                                      
                       ),
                       
                       "line2"=>array(
                            'fields'=>array(                                                              
                                'teams'=>array('label'=>__('Teams'),                                    
                                              'default'=>__('No team')
                                    ),
                                'profiles'=>array(    
                                    'label'=>__('Profiles'),
                                    'default'=>__('No profile'),
                                    'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_profile']])
                                    ),
                                'callcenter_id'=>array(
                                    'label'=>__("Callcenter"),
                                    'method'=>'Callcenter',
                                    'default'=>__('No callcenter'),
                                    'condition'=> ($this->getFilter()->hasValidator('callcenter_id') && $this->getItem()->hasCallcenter())
                                ),
                                'company_id'=>array(
                                    'label'=>__("Company"),
                                    'method'=>'Company',
                                    'default'=>__('No company'),
                                    'condition'=> ($this->getFilter()->hasValidator('company_id') && $this->getItem()->hasCompany())
                                ),
                                'created_at'=>array(
                                    'label'=>__("Date creation"),
                                    'format'=>array(
                                        'method'=>'CreatedAt',
                                        'output'=>array(
                                            'method'=>'getFormatted',
                                            'options'=>'a'
                                        )
                                    )
                                ),
                            ),                                                      
                       ),
                       
                       "line3"=>array(
                            'fields'=>array(                                                              
                                'groups'=>array(
                                                'label'=>__('Groups'),
                                                'default'=>__('No group'),
                                                'method'=>'SerializedI18nGroups',
                                                'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_groups']])
                                ),
                                'functions'=>array(
                                    'label'=>__('Functions'),
                                    'default'=>__('No function'),
                                    'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_functions']])
                                ),
                                'manager_id'=>array(
                                    'method'=>'TeamManagers',
                                    'default'=>__('No manager'),
                                    'label'=>__('Managers/Teams'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','settings_user_list_managers']]) && $this->getItem()->hasTeamManagers())
                                ),
                                'has_user_permissions'=>array('label'=>__('permissions'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','settings_user_permissions']]) && $this->getItem()->hasUserPermission())
                                ),
                                /*'lastlogin'=>array(
                                    'label'=>__('Last login'),
                                    'format'=>array(
                                        'method'=>'Lastlogin',
                                        'output'=>array(
                                            'method'=>'getFormatted',
                                            'options'=>'a'
                                        )
                                    )
                                ),
                                'last_password_gen'=>array(
                                    'label'=>__('Last password generation'),
                                    'format'=>array(
                                        'method'=>'LastPasswordGen',
                                        'output'=>array(
                                            'method'=>'getFormatted',
                                            'options'=>'a'
                                        )
                                    )
                                ),*/
                            ),                                                      
                       ),
                       "line4"=>array(
                            'fields'=>array(                                                              
                                'is_locked'=>array(
                                                'label'=>__('Locked'),
                                                'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                    ),                                
                                'locked_at'=>array(
                                                'label'=>__('Locked at'),
                                                'format'=>array(
                                                    'method'=>'LockedAt',
                                                    'output'=>array(
                                                        'method'=>'getFormatted',
                                                        'options'=>'a'
                                                    )
                                                ),
                                                'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                    ),                                
                                'unlocked_by'=>array(
                                                'label'=>__('Unlocked by'),
                                                'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                    ),                                
                                'number_of_try'=>array(
                                                'label'=>__('Number of trys'),
                                                'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                    ),                                
                                'creator_id'=>array(
                                                'label'=>__('Creator'),
                                                'method'=>'Creator',
                                                'default'=>__('No creator'),
                                                'condition'=>($this->getUser()->hasCredential([['superadmin','admin','settings_user_list_creator']])&&$this->getItem()->hasCreator())
                                    ),                                
                                'status'=>array(
                                                'label'=>__('Status'),
                                                'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_user_remove']])
                                    ),                                
                            ),                                                      
                        ),
                             
                                                    
            
                 
                    );
    }
    
    
    function process()
    {
        ///$this->loadTheme();
        $this->loadFormatterTheme();
        parent::process();
        return $this;
    }
  
}
