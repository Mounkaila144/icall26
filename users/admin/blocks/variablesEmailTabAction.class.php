<?php


class users_variablesEmailTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new UserModelEmailVariables();  
    } 
    
    
}

