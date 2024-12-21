<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterLogoForm.class.php";

class partners_polluter_ajaxSaveLogoAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new PartnerPolluterLogoForm();
            $form->bind($request->getPostParameter('PartnerPolluter'),$request->getFiles('PartnerPolluter'));
            $response=null;
            if ($form->isValid())
            {    
                $polluter=new PartnerPolluterCompany($form['id']->getValue());
                if ($form->hasValue('logo') && $polluter->isLoaded())
                {  
                    $file=$form->getValue('logo');
                    $file->setFilename($polluter->getNameForLogo());
                    $file->save($polluter->getLogo()->getPath());
                    $polluter->set('logo',$file->getFilename());
                    $polluter->save();
                    $response=array("logo"=>$polluter->get('logo'),"id"=>$polluter->get('id'));
                }  
            }                 
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
