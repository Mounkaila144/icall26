<?php
/*
 * Generated by SuperAdmin Generator date : 25/03/13 22:41:46
 */
 
class modules_manager_ajaxChangeIsAvailableModuleManagerAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);     
          if (!$site)  
               throw new mfException(__("thanks to select a site"));  
          $form=new moduleManagerChangeForm();
          $form->bind($request->getPostParameter('moduleManager'));
          if ($form->isValid())
          {
             $item= new moduleManager($form->getValue('id'),$site);    
             if ($item->isLoaded())
             {  
              //  if ($item->IsAvailableNotAuthorized())
              //      throw new mfException(__("operation is not authaurized."));
                $value=((string)$form['value']=='YES')?"NO":"YES"; 
                $item->set('is_available',$value);
                $item->save();
                $item->getModule()->removeConfigCache();                
                $response = array("action"=>"ChangeIsAvailableModuleManager","id"=>$item->get('id'),"state" =>$value);
             }
          }    
          else
          {
              $messages->addErrors(array_merge($form->getErrorSchema()->getGlobalErrors(),$form->getErrorSchema()->getErrors()));
          }             
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
