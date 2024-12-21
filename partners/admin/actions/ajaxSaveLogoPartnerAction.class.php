<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLogoForm.class.php";

class partners_ajaxSaveLogoPartnerAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new PartnerLogoForm();
            $form->bind($request->getPostParameter('Partner'),$request->getFiles('Partner'));
            $response=null;
            if ($form->isValid())
            {    
                $partner=new Partner($form['id']->getValue());
                if ($form->hasValue('logo') && $partner->isLoaded())
                {  
                    $file=$form->getValue('logo');
                    $file->setFilename($partner->getNameForLogo());
                    $file->save($partner->getLogo()->getPath());
                    $partner->set('logo',$file->getFilename());
                    $partner->save();
                    $response=array("logo"=>$partner->get('logo'),"id"=>$partner->get('id'));
                }  
            }        
          //  var_dump($form->getErrorSchema()->getErrorsMessage());
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
