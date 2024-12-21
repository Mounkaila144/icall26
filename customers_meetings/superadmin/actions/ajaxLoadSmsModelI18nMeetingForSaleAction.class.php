<?php

class customers_meetings_ajaxLoadSmsModelI18nMeetingForSaleAction extends mfAction {
      
    const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {    
       $messages = mfMessages::getInstance();     
       try
       {            
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        if (!$site) 
              throw new mfException(__("thanks to select a site"));                      
          $meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$site);
          if ($meeting->isNotLoaded())
              throw new mfException(__("Meeting is invalid."));
          $user=new User($request->getPostParameter('User'),'admin',$site);
          if ($user->isNotLoaded())
              throw new mfException(__("User is invalid."));
          if ($meeting->get('sales_id')!=$user->get('id') && $meeting->get('sale2_id')!=$user->get('id'))
              throw new mfException(__("User is meeting owner."));
          $model_i18n=new UserModelSmsI18n($request->getPostParameter('UserModelSmsI18n'),$site);        
          if ($model_i18n->isNotLoaded())           
              throw new mfException(__("Model is invalid."));
          try
          {
            $content=$this->getComponent('/customers_meetings/smsForSale', array('COMMENT'=>false,'meeting'=>$meeting,'user'=>$user,'model_i18n'=>$model_i18n))->getContent();         
          }
          catch (SmartyCompilerException $e)
          {
              trigger_error($e->getMessage());
              throw new mfException(__("Error Syntax in model."));              
          }
         
          $response = array("action"=>"LoadModelI18n",
                            "id" =>$model_i18n->get('id'),
                            "model"=>array('message'=>$content),
                            "info"=>__("Model [%s] has been loaded.",$model_i18n->get('value')));          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->getController()->setRenderMode(mfView::RENDER_JSON);          
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;         
   }

}