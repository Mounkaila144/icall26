<?php

class customers_contracts_ajaxLoadEmailModelI18nContractForSaleAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {    
       $messages = mfMessages::getInstance();     
       try
       {                  
          $contract=new CustomerContract($request->getPostParameter('Contract'));
          if ($contract->isNotLoaded())
              throw new mfException(__("Contract is invalid."));
          $user=new User($request->getPostParameter('User'),'admin');
          if ($user->isNotLoaded())
              throw new mfException(__("User is invalid."));
          if ($contract->get('sale_1_id')!=$user->get('id') && $contract->get('sale_2_id')!=$user->get('id'))
              throw new mfException(__("User is not contract owner."));
          $model_i18n=new UserModelEmailI18n($request->getPostParameter('UserModelEmailI18n'));        
          if ($model_i18n->isNotLoaded())           
              throw new mfException(__("Model is invalid."));
          try
          {
            $content=$this->getComponent('/customers_contracts/emailForSale', array('COMMENT'=>false,'contract'=>$contract,'user'=>$user,'model_i18n'=>$model_i18n))->getContent();         
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