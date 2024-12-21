<?php

class users_ajaxUserSavePictureAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
        $form = new userPictureForm();
        $form->bind($request->getPostParameter('user'),$request->getFiles('user'));
        $response=array();
        if ($form->isValid())
        {    
            $user=new User($form->getValue('id'),'admin',$site);
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
