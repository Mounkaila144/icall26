<?php

class customers_meetings_ajaxLoadEmailModelI18nMeetingAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {    
       $messages = mfMessages::getInstance();     
       try
       {                    
          $meeting=new CustomerMeeting($request->getPostParameter('Meeting'));
          if ($meeting->isNotLoaded())
              throw new mfException(__("Meeting is invalid."));
          $model_i18n=new CustomerModelEmailI18n($request->getPostParameter('CustomerModelEmailI18n'));        
          if ($model_i18n->isNotLoaded())           
              throw new mfException(__("Model is invalid."));
          try
          {
            $content=$this->getComponent('/customers_meetings/email', array('COMMENT'=>false,'meeting'=>$meeting,'model_i18n'=>$model_i18n))->getContent();         
          }
          catch (SmartyCompilerException $e)
          {
              trigger_error($e->getMessage());
              throw new mfException(__("Error Syntax in model."));              
          }
         
          $response = array("action"=>"LoadModelI18n",
                            "id" =>$model_i18n->get('id'),
                            "model"=>array('body'=>$content,'subject'=>$model_i18n->get('subject')),
                            "info"=>__("Model [%s] has been loaded.",$model_i18n->get('value')));          
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      $this->getController()->setRenderMode(mfView::RENDER_JSON);          
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;         
   }

}