<?php

class UserListTheme32FormatterApi  extends UserListFormatterApi {
    
   
    
    function getHeader()
    {        
        return array(
                     'id'=>array(
                         'label'=>__('ID'),
                         'style'=>'display:none'
                         ),

                     'is_locked'=>array('label'=>__('Locked'),
                                     'condition'=>$this->getUser()->hasCredential([['superadmin','settings_users_list_security']])
                                        ), 
                    );
    }        
    
    
     
     function getFilter()
    {
        return array();
    }
  
   

    
   
}

