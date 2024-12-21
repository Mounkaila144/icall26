<?php


class users_variablesSmsTabActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->variables=new UserModelSmsVariables();  
    } 
    
    
}

