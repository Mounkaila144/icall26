<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLayerCompanyLogoForm.class.php";

class partners_layer_ajaxSaveLogoLayerCompanyAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();
        try
        {          
           
            $form = new PartnerLayerCompanyLogoForm();
            $form->bind($request->getPostParameter('PartnerLayer'),$request->getFiles('PartnerLayer'));
            $response=null;
            if ($form->isValid())
            {    
                $layer=new PartnerLayerCompany($form['id']->getValue());
                if ($form->hasValue('logo') && $layer->isLoaded())
                {  
                    $file=$form->getValue('logo');
                    $file->setFilename($layer->getNameForLogo());
                    $file->save($layer->getLogo()->getPath());
                    $layer->set('logo',$file->getFilename());
                    $layer->save();
                    $response=array("logo"=>$layer->get('logo'),"id"=>$layer->get('id'));
                }  
            }        
          //  var_dump($form->getErrorSchema()->getErrorsMessage());
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }  
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;        
    }

}
