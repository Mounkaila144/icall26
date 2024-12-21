<?php

require_once dirname(__FILE__)."/../locales/Forms/UserPictureForm.class.php";

class users_ajaxDashboardUserSavePictureAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        $form = new UserPictureForm();
        $form->bind($request->getPostParameter('user'),$request->getFiles('user'));
        $response=array();
        if ($form->isValid())
        {    
            $user=new User($form->getValue('id'));
            if ($user->isLoaded()&&$form->hasValue('picture'))
            { 
                $file=$form->getValue('picture');
                $file->save($user->getPicture()->getPath());
                $user->set('picture',$file->getFilename());
                $user->save();
                $response=array("picture"=>$user->get('picture'),"id"=>$form->getValue('id'));
            }   
        }
        else
        {
            $messages->addErrors(array_merge($form->getErrorSchema()->getGlobalErrors(),$form->getErrorSchema()->getErrors()));
        }    
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
