<?php

class site_company_ajaxGeneratePictureAction extends mfAction {
    

    function execute(mfWebRequest $request) {     
      $messages = mfMessages::getInstance(); 
      $current_user=$this->getUser()->getGuardUser(); // get current user 
      try 
      {          
          $company=new mfValidatorInteger();
          $company_id=$company->isValid($request->getPostParameter('Company'));
          $company= new SiteCompany($company_id);
          if ($company->isNotLoaded()) 
              throw new mfException(__('Company is _invalid.'));
          $company->getPicture()->generate();
          
          $response = array("action"=>"GeneratePicture",
                            "info"=>__("Pictures have been generated."),
                            "picture"=>$company->getPicture()->toArray(array('thumb')),
                            "id" =>$company->get('id'));
            
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
