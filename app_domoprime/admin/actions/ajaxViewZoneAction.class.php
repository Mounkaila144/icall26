<?php
 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeZoneViewForm.class.php";
 
class app_domoprime_ajaxViewZoneAction extends mfAction {
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->form= new DomoprimeZoneViewForm($request->getPostParameter('DomoprimeZone'));
        $this->item=new DomoprimeZone($request->getPostParameter('DomoprimeZone'));
       // echo "<pre>";var_dump($this->item);echo "</pre>";
    }

}
