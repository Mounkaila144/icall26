<?php

require_once dirname(__FILE__)."/../locales/Forms/UserSuperAdminNewForm.class.php";

class users_ajaxDashboardNewUserSaveAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $response=array();
        if ($request->getPostParameter('user')!=null)
        {    
            try {
                $user = new User(); 
                $form = new UserSuperAdminNewForm();   
                $form->bind($request->getPostParameter('user'),$request->getFiles('user'));
                if ($form->isValid()) {
                    $user->add($form->getValues());
                    if ($user->isExist())
                        throw new mfException (__("user already exists")); 
                    if ($form->hasValue('picture'))
                    {
                       $file=$form->getValue('picture');
                       $user->set('picture',$file->getFilename().$file->getExtension()); 
                    }    
                    $user->save();
                    // Mandatory : Need to save object before file because path depends of id
                    if ($file)
                    {
                       $file->save($user->getPicture()->getPath());  
                    }
                    $messages->addInfo(__("user %s (%s) has been saved",array($user,$user->get('username'))));
                    $this->getEventDispather()->notify(new mfEvent($user, 'user.change','new')); 
                }
                else
                {    
                   $response=array('errors'=>$form->getErrorSchema()->getErrorsMessage());
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
       }
       if ($messages->hasMessages('error'))
            $response['error']=$messages->getDecodedErrors();
       if ($messages->hasMessages('info'))
            $response['info']=$messages->getDecodedInfos();
       return $response; 
    }

}
