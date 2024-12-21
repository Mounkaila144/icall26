<?php

// http://www.ecosol16.net/admin/users/UploadImportProfile

require_once __DIR__.'/../locales/Imports/ImportProfileUploadForm.class.php';
require_once __DIR__.'/../locales/Imports/UserProfileImportXML.class.php';

class users_UploadImportProfileAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
             
        
        
        $messages = mfMessages::getInstance();
        $form = new ImportProfileUploadForm();        
        try
        {
            $form->bind($request->getPostParameter('ImportProfile'),$request->getFiles('ImportProfile'));
            if($form->isValid()){               
                $xml = new UserProfileImportXml($form->getValue('file'));
                $xml->process();      
                
                $response= array("info"=>(__('Profile has been imported.')));
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
