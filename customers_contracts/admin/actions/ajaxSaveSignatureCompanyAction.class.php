<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractCompanySignatureForm.class.php";

class customers_contracts_ajaxSaveSignatureCompanyAction extends mfAction {
    

       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {                 
            $form = new CustomerContractCompanySignatureForm();
            $form->bind($request->getPostParameter('CustomerContractCompany'),$request->getFiles('CustomerContractCompany'));
            $response=null;
            if ($form->isValid())
            {    
                $company=new CustomerContractCompany($form['id']->getValue());                 
                if ($form->hasValue('signature') && $company->isLoaded())
                {  
                    $file=$form->getValue('signature');
                    $file->setFilename($company->getNameForSignature());
                    $file->save($company->getSignature()->getPath());
                    $company->set('signature',$file->getFilename());
                    $company->save();
                    $response=array("signature"=>$company->get('signature'),"id"=>$company->get('id'));
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
