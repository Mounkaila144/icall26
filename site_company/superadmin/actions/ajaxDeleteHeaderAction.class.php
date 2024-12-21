<?php

class site_company_ajaxDeleteHeaderAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';   
    
    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $current_user=$this->getUser()->getGuardUser(); // get current user 
      try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
                throw new mfException(__("thanks to select a site"));
          if (!$this->getUser()->hasCredential(array(array('superadmin','admin_company'))))
            throw new mfException(__("you don't have the right permission to do this action."));
          $company=new mfValidatorInteger();
          $company_id=$company->isValid($request->getPostParameter('Company'));
          $company= new SiteCompany($company_id,$site);
          if ($company->get('header') && $company->isLoaded())
          {    
            $company->deleteHeader();
            $response = array("action"=>"deleteHeader","id" =>$company->get('id'));
          }  
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
