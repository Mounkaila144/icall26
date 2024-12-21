<?php

require_once dirname(__FILE__)."/../locales/Forms/CompanyPictureForm.class.php";

class site_company_ajaxSavePictureAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new CompanyPictureForm();
            $form->bind($request->getPostParameter('Company'),$request->getFiles('Company'));
            $response=null;
            if ($form->isValid())
            {    
                $site_company=new SiteCompany($form['id']->getValue());
                if ($form->hasValue('picture') && $site_company->isLoaded())
                {  
                    $file=$form->getValue('picture');
                    $file->setFilename($site_company->getNameForPicture());
                    $file->save($site_company->getPicture()->getPath());
                    $site_company->set('picture',$file->getFilename());
                    $site_company->save();
                    $site_company->getPicture()->generate();
                    $response=array("picture"=>$site_company->get('picture'),"id"=>$site_company->get('id'));
                }  
            }     
            else
                var_dump($form->getErrorSchema());
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
