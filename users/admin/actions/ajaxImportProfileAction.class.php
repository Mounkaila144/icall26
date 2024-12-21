<?php
require_once dirname(__FILE__)."/../locales/Imports/ImportProfileUploadForm.class.php";

class users_ajaxImportProfileAction extends mfAction {
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();       
         $this->form= new ImportProfileUploadForm();          
    }

}
