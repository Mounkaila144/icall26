<?php

class ContractItemFormatterApi extends mfFormatterFilterItemApi  {
        
     
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
        return array(  'id'=>array('properties'=>array('style'=>'display:none')),
                       "line1"=>array(                           
                            'fields'=>array(                                                             
                                'is_hold'=>array(
                                    'style'=>array(
                                        'method'=>'isHold',
                                        'parameters'=>array(
                                            'true'=>'content:fa-check;color:#00ff00',
                                            'false'=>'content:fa-uncheck;color:#ff0000',                                    
                                ))),                                
                                'is_signed'=>array(
                                    'style'=>array(
                                        'method'=>'isSigned',
                                        'parameters'=>array(
                                            'true'=>'content:fa-check;color:#00ff00',
                                            'false'=>'content:fa-uncheck;color:#ff0000',                                    
                                ))),                                
                                'is_hold_quote'=>array(
                                    'style'=>array(
                                        'method'=>'isHoldQuote',
                                        'parameters'=>array(
                                            'true'=>'content:fa-check;color:#00ff00',
                                            'false'=>'content:fa-uncheck;color:#ff0000',                                    
                                ))),                                
                                'reference',
                            ),                                                      
                       ),
                       "line2"=>array(
                            'fields'=>array(                                                              
                                'state_id'=>array(
                                            //'method'=>'getStatus',
                                            'default'=>__('No state')),
                                'customer_id'=>array(
                                            //'method'=>'getCustomer',
                                            'default'=>__('No customer')),

                            ),                                                      
                       ),
                       
                       "line3"=>array(
                            'fields'=>array(  
                                'polluter_id'=>array(
                                            //'method'=>'getPolluter',
                                            'default'=>__('No customer')),
                                'is_billable'=>array(
                                    'style'=>array(
                                        'method'=>'isBillable',
                                        'parameters'=>array(
                                            'true'=>'content:fa-check;color:#00ff00',
                                            'false'=>'content:fa-uncheck;color:#ff0000',                                    
                                ))), 
                            ),                                                      
                       ),
                       'manager_id'=>array(/*'method'=>'getManager',*/'default'=>__('No manager'))      
                                                    
            
                  /*   'id'=>array(
                         'fields'=>array(
                             'functions'=>array(
                                 'label'=>__('Function'), 
                                 'default'=>__('No function')
                                 ),                                                        
                             'groups'=>array(
                                 'label'=>__('Groups'), 
                                 'default'=>__('No group')
                                 ),                            
                               'lastlogin'=>array('format'=>array('method'=>'Lastlogin','output'=>array('method'=>'getFormatted','options'=>array('d','q')))),  
                             
                             ),                            
                         ),
                       //  'style'=>'display:none'),
                     'username',
                    'firstname',
                    'lastname',
                     'email',
                     'is_locked'=>array(
                                     'label'=>__('Locked'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                     'locked_at'=>array(
                                     'label'=>__('Locked at'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                     'unlocked_by'=>array(
                                     'label'=>__('Unlocked by'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']]),
                                     'method'=>'UnlockedBy'
                                        ), 
                     'number_of_try'=>array(
                                     'label'=>__('Number of trys'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                   /*  'profile_id'=>array(
                                     'label'=>__('Profiles'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_profile']]),
                                     'method'=>'Profile' 
                                        ), */
                 /*    'group_id'=>array(
                                     'label'=>__('Groups'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_users_list_groups']]),
                                     
                                        ),*/ 
                 /*    'teams'=>array(
                                    'default'=>__('No team')
                                        ), 
                     'profiles'=>array(
                                        'default'=>__('No profile')
                                        ), 
                     'functions'=>array( //'method'=>'getFunctions',
                                       'default'=>__('No function')
                                        ), 
                     'groups'=>array( 'method'=>'getSerializedI18nGroups',
                                      'default'=>__('No group')
                                        ), 
                     'callcenter_id'=>array(
                                     'label'=>__('Callcenter'),                                     
                                     'condition'=>$this->getFilter()->equal->hasValidator('callcenter_id'),
                                     'default'=>__('No call center'),
                                     'method'=>'Callcenter'
                                        ), 
                     'company_id'=>array(
                                     'method'=>'getCompany',
                                     'label'=>__('Company'),
                                     'condition'=>$this->getFilter()->equal->hasValidator('company_id'),
                                     'default'=>__('No company'),                                   
                                        ), 
                     'is_active', 
                     'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'getFormatted','options'=>'d'))), 
                     'lastlogin'=>array('format'=>array('method'=>'Lastlogin','output'=>array('method'=>'getFormatted','options'=>array('d','q')))),  
                     'last_password_gen', 
                     'has_user_permissions'=>array(//'label'=>__('Permissions'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_user_permissions']])
                                        ),                                           
                     'manager_id'=>array(//'label'=>__('Managers/Teams'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_user_list_managers']]),
                                     'method'=>'ManagerTeam'
                                        ), 
                     'status'=>array(//'label'=>__('Status'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','admin','settings_user_remove']])
                                        ), 
                    // 'actions'=>array('label'=>__('Action')), 
                    
                    //  'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'Formatted','options'=>'d'))),  // formatter
                    //  'created_at'=>array('output'=>'')   // method in object */
                    );
    }
    
    
    function process()
    {
        //$this->loadTheme();
        $this->loadFormatterTheme();
        parent::process();
        return $this;
    }
  
}
