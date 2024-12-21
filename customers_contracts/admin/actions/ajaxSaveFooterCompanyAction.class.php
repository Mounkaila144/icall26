<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractCompanyFooterForm.class.php";

class customers_contracts_ajaxSaveFooterCompanyAction extends mfAction {
    

       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {              
            $form = new CustomerContractCompanyFooterForm();
            $form->bind($request->getPostParameter('CustomerContractCompany'),$request->getFiles('CustomerContractCompany'));
            $response=null;            
            if ($form->isValid())
            {    
                $company=new CustomerContractCompany($form['id']->getValue());                   
                if ($form->hasValue('footer') && $company->isLoaded())
                {  
                    $file=$form->getValue('footer');
                    $file->setFilename($company->getNameForFooter());
                    $file->save($company->getFooter()->getPath());
                    $company->set('footer',$file->getFilename());
                    $company->save();
                    $response=array("footer"=>$company->get('footer'),"id"=>$company->get('id'));
                }                       
            }   else { var_dump($form->getErrorSchema()->getErrorsMessage()); }          
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
