<?php

//  www.ecosol16.net/admin/api/v2/applications/iso/admin/ListPolluter
//  
//require_once __DIR__."/../locales/Api/2/FormFilters/DomoprimeMasterProductsApi2FormFilter.class.php";
//require_once __DIR__."/../locales/Api/2/DomoprimeMasterProductsFormatterApi2.class.php";
//require_once __DIR__."/../locales/Pagers/DomomprimeMasterProductsPager.class.php";

class app_domoprime_api2ListPolluterAction extends mfAction {

    function execute(mfWebRequest $request) {                  
            $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
         if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso3_api2_list_polluter'))))
            $this->forwardTo401Action();                                                        
         return DomoprimePollutingCompany::getPollutersForApi2()->toArray();
    }

}