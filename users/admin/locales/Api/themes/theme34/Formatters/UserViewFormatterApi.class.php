<?php


class UserViewTheme34FormatterApi extends UserViewFormatterApi {
    
    
    function getData()
    {                  
        return array(
                     'id'=>array('style'=>'display:none'),
                     'username'=>array('label'=>__("Username")),
                   /*  'company_id'=>array('label'=>__('Company'),                                                                       
                                        'default'=>__('No company'),
                                        'method'=>'getCompany',
                                      //  'flatten'=>array(),
                                       //  'condition'=>$this->getForm()->hasValidator('company_id')
                                        ),       */                 
                     // 'firstname',
                   //  'lastname',
                       'email',
                   //  'sex'=>array('label'=>__('Title'),"properties"=>(!$this->getUser()->hasCredential([['superadmin','admin','settings_user_modify']])?""=>"":"")),
            
                    
                   //  'created_at'=>array('format'=>array('method'=>'CreatedAt','output'=>array('method'=>'Formatted','options'=>'d'))),  // formatter
                   //  'created_at'=>array('output'=>'')   // method in object 
                    );
     } 
   
}

