<?php

require_once dirname(__FILE__)."/../locales/Forms/ImportPolluterUploadForm.class.php";

class app_domoprime_ajaxImportPolluterAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
         $this->user=$this->getUser();       
         $this->form= new ImportPolluterUploadForm();
         $this->getEventDispather()->notify(new mfEvent($this->form, 'app.domoprime.polluter.import.form'));          
    }

}
