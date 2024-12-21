<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractCompanyHeaderForm.class.php";

class customers_contracts_ajaxSaveHeaderCompanyAction extends mfAction {
    
      
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
            $form = new CustomerContractCompanyHeaderForm();
            $form->bind($request->getPostParameter('CustomerContractCompany'),$request->getFiles('CustomerContractCompany'));
            $response=null;
            if ($form->isValid())
            {    
                $company=new CustomerContractCompany($form['id']->getValue());
                if ($form->hasValue('header') && $company->isLoaded())
                {  
                    $file=$form->getValue('header');
                    $file->setFilename($company->getNameForHeader());
                    $file->save($company->getHeader()->getPath());
                    $company->set('header',$file->getFilename());
                    $company->save();
                    $response=array("header"=>$company->get('header'),"id"=>$company->get('id'));
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
