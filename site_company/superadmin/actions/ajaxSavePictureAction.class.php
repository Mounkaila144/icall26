<?php

require_once dirname(__FILE__)."/../locales/Forms/CompanyPictureForm.class.php";

class site_company_ajaxSavePictureAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
            $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
            if (!$site) 
                throw new mfException(__("thanks to select a site"));
            $form = new CompanyPictureForm();
            $form->bind($request->getPostParameter('Company'),$request->getFiles('Company'));
            $response=null;
            if ($form->isValid())
            {    
                $site_company=new SiteCompany($form['id']->getValue(),$site);
                if ($form->hasValue('picture') && $site_company->isLoaded())
                {  
                    $file=$form->getValue('picture');
                    $file->setFilename($site_company->getNameForPicture());
                    $file->save($site_company->getPicture()->getPath());
                    $site_company->set('picture',$file->getFilename());
                    $site_company->save();
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
