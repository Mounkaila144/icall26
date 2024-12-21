<?php


class UserModelEmailVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {
        $this->variables= array(
            'user.name'=>__('user','',$dictionnary),
            'user.firstname'=>__('user firstname','',$dictionnary),
            'user.lastname'=>__('user lastname','',$dictionnary),
            'user.mobile'=>__('user mobile','',$dictionnary),
            'user.phone'=>__('user phone','',$dictionnary),
            'user.courtesy'=>__('user courtesy','',$dictionnary),
            'user.gender'=>__('user gender','',$dictionnary),                    
        );
    } 
    
  
    
    
}


