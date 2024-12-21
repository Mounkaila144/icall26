<?php

require_once dirname(__FILE__)."/../locales/Forms/CompanyStampForm.class.php";

class site_company_ajaxSaveStampAction extends mfAction {
    

       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {
            if (!$this->getUser()->hasCredential(array(array('superadmin','admin_company'))))
               $this->forwardTo401Action();          
            $form = new CompanyStampForm();
            $form->bind($request->getPostParameter('Company'),$request->getFiles('Company'));
            $response=null;
            if ($form->isValid())
            {    
                $site_company=new SiteCompany($form['id']->getValue());                 
                if ($form->hasValue('stamp') && $site_company->isLoaded())
                {  
                    $file=$form->getValue('stamp');
                    $file->setFilename($site_company->getNameForStamp());
                    $file->save($site_company->getStamp()->getPath());
                    $site_company->set('stamp',$file->getFilename());
                    $site_company->save();
                    $response=array("stamp"=>$site_company->get('stamp'),"id"=>$site_company->get('id'));
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
