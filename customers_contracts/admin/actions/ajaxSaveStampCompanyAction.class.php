<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractCompanyStampForm.class.php";

class customers_contracts_ajaxSaveStampCompanyAction extends mfAction {
    

       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {             
            $form = new CustomerContractCompanyStampForm();
            $form->bind($request->getPostParameter('CustomerContractCompany'),$request->getFiles('CustomerContractCompany'));
            $response=null;
            if ($form->isValid())
            {    
                $company=new CustomerContractCompany($form['id']->getValue());                 
                if ($form->hasValue('stamp') && $company->isLoaded())
                {  
                    $file=$form->getValue('stamp');
                    $file->setFilename($company->getNameForStamp());
                    $file->save($company->getStamp()->getPath());
                    $company->set('stamp',$file->getFilename());
                    $company->save();
                    $response=array("stamp"=>$company->get('stamp'),"id"=>$company->get('id'));
                }                  
            }  
            else
            {
            //    var_dump($form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
