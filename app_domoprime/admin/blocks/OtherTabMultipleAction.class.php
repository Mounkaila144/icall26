<?php

class app_domoprime_OtherTabMultipleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        $this->settings= DomoprimeSettings::load();
        if (!$this->getUSer()->hasCredential(array(array('superadmin','contract_multiple_iso_other'))))
            return mfView::NONE;
    } 
    
    
}