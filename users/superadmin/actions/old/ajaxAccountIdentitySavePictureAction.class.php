<?php
/*
 
 // Calcul des nouvelles dimensions
list($width, $height) = getimagesize($filename);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Chargement
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// Redimensionnement
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Affichage
imagejpeg($thumb); 
 
 
 */
class users_ajaxAccountIdentitySavePictureAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        $current_user=$this->getUser()->getGuardUser(); // get current user 
        $form = new userAccountPictureForm();
        $form->bind($request->getPostParameter('user'),$request->getFiles('user'));
        $response=null;
        if ($form->isValid())
        {    
            $user=new User($form->getValue('id'));
            // Controle si les access sont autorisés
            if ($user->get('id')!=$current_user->get('id')&&!$this->getUser()->hasCredential('superadmin_users'))
                $this->forwardTo401Action();   
            
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
        $response=$messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
        return $response; 
    }

}
