<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterPictureForm.class.php";

class partners_polluter_ajaxSavePictureAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new PartnerPolluterPictureForm();
            $form->bind($request->getPostParameter('PartnerPolluter'),$request->getFiles('PartnerPolluter'));
            $response=null;
            if ($form->isValid())
            {    
                $polluter=new PartnerPolluterCompany($form['id']->getValue());
                if ($form->hasValue('picture') && $polluter->isLoaded())
                {  
                    $file=$form->getValue('picture');
                    $file->setFilename($polluter->getNameForPicture());
                    $file->save($polluter->getPicture()->getPath());
                    $polluter->set('picture',$file->getFilename());
                    $polluter->save();
                    $response=array("picture"=>$polluter->get('picture'),"id"=>$polluter->get('id'));
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
