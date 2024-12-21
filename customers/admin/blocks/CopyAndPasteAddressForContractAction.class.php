<?php

class customers_CopyAndPasteAddressForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        if (!$this->getUser()->hasCredential(array(array('superadmin','customer_geoportail_address_copy_and_paste'))))
            return mfView::NONE;
    } 
    
    
}