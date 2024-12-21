<?php

require_once dirname(__FILE__)."/../locales/Forms/CompanySignatureForm.class.php";

class site_company_ajaxSaveSignatureAction extends mfAction {
    

       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {
            if (!$this->getUser()->hasCredential(array(array('superadmin','admin_company'))))
               $this->forwardTo401Action();          
            $form = new CompanySignatureForm();
            $form->bind($request->getPostParameter('Company'),$request->getFiles('Company'));
            $response=null;
            if ($form->isValid())
            {    
                $site_company=new SiteCompany($form['id']->getValue());                 
                if ($form->hasValue('signature') && $site_company->isLoaded())
                {  
                    $file=$form->getValue('signature');
                    $file->setFilename($site_company->getNameForSignature());
                    $file->save($site_company->getSignature()->getPath());
                    $site_company->set('signature',$file->getFilename());
                    $site_company->save();
                    $response=array("signature"=>$site_company->get('signature'),"id"=>$site_company->get('id'));
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
