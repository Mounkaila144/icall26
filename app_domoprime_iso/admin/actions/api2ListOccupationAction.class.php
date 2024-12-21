<?php

//  www.ecosol16.net/admin/api/v2/applications/iso0/admin/ListOccupation
 
class app_domoprime_iso_api2ListOccupationAction extends mfAction {

    function execute(mfWebRequest $request) {                  
             $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
         if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_api2_list_occupation'))))
            $this->forwardTo401Action();                                               
         return DomoprimeOccupation::getOccupationForI18nSelect();
    }

}