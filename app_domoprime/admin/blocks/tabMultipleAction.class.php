<?php

class app_domoprime_tabMultipleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        $this->settings= DomoprimeSettings::load();
    } 
    
    
}