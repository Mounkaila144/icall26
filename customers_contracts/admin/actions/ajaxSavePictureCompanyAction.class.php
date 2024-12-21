<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractCompanyPictureForm.class.php";

class customers_contracts_ajaxSavePictureCompanyAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new CustomerContractCompanyPictureForm();
            $form->bind($request->getPostParameter('CustomerContractCompany'),$request->getFiles('CustomerContractCompany'));
            $response=null;
            if ($form->isValid())
            {    
                $company=new CustomerContractCompany($form['id']->getValue());
                if ($form->hasValue('picture') && $company->isLoaded())
                {  
                    $file=$form->getValue('picture');
                    $file->setFilename($company->getNameForPicture());
                    $file->save($company->getPicture()->getPath());
                    $company->set('picture',$file->getFilename());
                    $company->save();
                    $response=array("picture"=>$company->get('picture'),"id"=>$company->get('id'));
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
