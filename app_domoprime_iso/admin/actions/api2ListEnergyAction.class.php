<?php

//  www.ecosol16.net/admin/api/v2/applications/iso0/admin/ListEnergy
 
class app_domoprime_iso_api2ListEnergyAction extends mfAction {

    function execute(mfWebRequest $request) {                  
             $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
         if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_api2_list_energy'))))
            $this->forwardTo401Action();                                               
         return DomoprimeEnergy::getEnergyForI18nSelect();
    }

}