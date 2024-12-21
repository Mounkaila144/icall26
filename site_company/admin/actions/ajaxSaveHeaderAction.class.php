<?php

require_once dirname(__FILE__)."/../locales/Forms/CompanyHeaderForm.class.php";

class site_company_ajaxSaveHeaderAction extends mfAction {
    
      
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {
            if (!$this->getUser()->hasCredential(array(array('superadmin','admin_company'))))
               $this->forwardTo401Action(); 
         
            $form = new CompanyHeaderForm();
            $form->bind($request->getPostParameter('Company'),$request->getFiles('Company'));
            $response=null;
            if ($form->isValid())
            {    
                $site_company=new SiteCompany($form['id']->getValue());
                if ($form->hasValue('header') && $site_company->isLoaded())
                {  
                    $file=$form->getValue('header');
                    $file->setFilename($site_company->getNameForHeader());
                    $file->save($site_company->getHeader()->getPath());
                    $site_company->set('header',$file->getFilename());
                    $site_company->save();
                    $response=array("header"=>$site_company->get('header'),"id"=>$site_company->get('id'));
                }  
            }            
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
