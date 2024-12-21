<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterSignatureForm.class.php";

class partners_polluter_ajaxSaveSignatureAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new PartnerPolluterSignatureForm();
            $form->bind($request->getPostParameter('PartnerPolluter'),$request->getFiles('PartnerPolluter'));
            $response=null;
            if ($form->isValid())
            {    
                $polluter=new PartnerPolluterCompany($form['id']->getValue());
                if ($form->hasValue('signature') && $polluter->isLoaded())
                {  
                    $file=$form->getValue('signature');
                    $file->setFilename($polluter->getNameForSignature());
                    $file->save($polluter->getSignature()->getPath());
                    $polluter->set('signature',$file->getFilename());
                    $polluter->save();
                    $response=array("signature"=>$polluter->get('signature'),"id"=>$polluter->get('id'));
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
