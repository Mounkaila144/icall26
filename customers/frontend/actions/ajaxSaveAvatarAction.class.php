<?php



require_once dirname(__FILE__)."/../locales/Forms/CustomerUserAvatarForm.class.php";


class customers_ajaxSaveAvatarAction extends mfAction {
    
    
        
     function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {        
        $response=null;
        $form = new CustomerUserAvatarForm();
        $form->bind($request->getPostParameter('CustomerUser'),$request->getFiles('CustomerUser'));
        if ($form->isValid())
        {              
            $item=$this->getUser()->getGuardUser();
            if ($item->isLoaded() && $form->hasValue('avatar'))
            {  
                $file=$form->getValue('avatar');
                $item->setAvatarFile($file);
                $item->save();  
                $file->save($item->getAvatar()->getPath(),$item->get('avatar'));                                
                $response=array("avatar"=>$item->get('avatar'));
            }   
        }                      
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}


