<?php

class customers_contracts_ajaxLoadEmailModelI18nContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {    
       $messages = mfMessages::getInstance();     
       try
       {            
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        if (!$site) 
              throw new mfException(__("thanks to select a site"));    
          $contract=new CustomerContract($request->getPostParameter('Contract'),$site);
          if ($contract->isNotLoaded())
              throw new mfException(__("Contract is invalid."));
          $model_i18n=new CustomerModelEmailI18n($request->getPostParameter('CustomerModelEmailI18n'),$site);        
          if ($model_i18n->isNotLoaded())           
              throw new mfException(__("Model is invalid."));
          try
          {
            $content=$this->getComponent('/customers_contracts/email', array('COMMENT'=>false,'contract'=>$contract,'model_i18n'=>$model_i18n))->getContent();         
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