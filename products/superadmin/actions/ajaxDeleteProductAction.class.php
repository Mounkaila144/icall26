<?php

/*
 * Generated by SuperAdmin Generator date : 24/04/13 15:45:29
 */
 
class products_ajaxDeleteProductAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();   
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));    
          $item=new mfValidatorInteger();
          $id=$item->isValid($request->getPostParameter('Product'));          
          $item= new Product($id,$site);           
          $item->disable();              
          $response = array("action"=>"deleteProduct","id" =>$id,"info"=>__("Product [%s] has been deleted.",$item->get('meta_title')));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}

