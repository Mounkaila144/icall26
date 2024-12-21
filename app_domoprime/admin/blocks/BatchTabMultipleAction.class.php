<?php

class app_domoprime_BatchTabMultipleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
        $this->settings= DomoprimeSettings::load();
        if (!$this->getUSer()->hasCredential(array(array('superadmin','contract_multiple_iso_batch'))))
                return mfView::NONE;
    } 
    
    
}