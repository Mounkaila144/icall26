<?php


class users_functionsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
       $this->functions_i18n=$this->getUser()->getGuardUser()->getFormattedFunctionsI18n();                
       $this->user=$this->getUser();
      // var_dump($this->functions_i18n);
    } 
    
    
}

