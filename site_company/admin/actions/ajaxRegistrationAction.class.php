<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteCompanyForm.class.php";

class CompanyRegistrationForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'country'=>new mfValidatorString(array("min_length"=>2,"max_length"=>2))
            ));
    }
}

class site_company_ajaxRegistrationAction extends mfAction {
    
      
    function execute(mfWebRequest $request) {   
      $messages = mfMessages::getInstance();  
    
      try 
      {         
          $form=new CompanyRegistrationForm();
          $form->bind($request->getPostParameter('Registration'));
          if (!$form->isValid())
          {             
              $this->getController()->setRenderMode(mfView::RENDER_JSON);
              return array("error"=>__("error bad format."));
          }
          $this->form=new SiteCompanyForm(array('country'=>(string)$form['country']));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }      
    }

}

