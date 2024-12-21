<?php

// www.ecosol26.net/admin/applications/domoprime/admin/UploadImportPolluter
require_once dirname(__FILE__).'/../locales/Forms/ImportPolluterUploadForm.class.php';

class app_domoprime_UploadImportPolluterAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        
     /*  $archive = new PartnerPolluterCompanyUnArchive(__DIR__."/../data/0.6/archive.zip",array('company_model_id'=>new SiteCompanyModel(8)));
         $archive->process();
          $this->getEventDispather()->notify(new mfEvent($archive, 'app.domoprime.polluter.import.process'));    
        die(__METHOD__); */
        
        
        $messages = mfMessages::getInstance();
        $form = new ImportPolluterUploadForm();        
         $this->getEventDispather()->notify(new mfEvent($form, 'app.domoprime.polluter.import.form'));     
        try
        {
            $form->bind($request->getPostParameter('ImportPolluter'),$request->getFiles('ImportPolluter'));
            if($form->isValid()){               
                $archive = new PartnerPolluterCompanyUnArchive($form->getValue('file'),$form->getOptions());
                $archive->process();       
                
                $this->getEventDispather()->notify(new mfEvent($archive, 'app.domoprime.polluter.import.process'));     
                $response= array("info"=>(__('Polluter has been imported.')));
//                echo "<pre>"; var_dump($files); echo "</pre>";
            }
            else{
//                echo "<pre>"; var_dump ($form->getErrorSchema ()->getErrorsMessage()); echo "</pre>";
                $messages->addError(implode("<br />", $form->getErrorSchema()->getErrorsMessage()));
            }
        }
        catch (mfException $e) {
            $messages->addError($e);
        }
        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
