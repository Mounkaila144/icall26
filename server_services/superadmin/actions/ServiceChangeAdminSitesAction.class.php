<?php

require_once dirname(__FILE__).'/../locales/Forms/ChangeAdminSitesForm.class.php';

class server_services_ServiceChangeAdminSitesAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();                       
        try
        {                         
            $form = new ChangeAdminSitesForm($request->getPostParameters()); 
            if (!$request->isMethod('POST')) 
                return array('status'=>'KO','error'=>__('No params found'));
            $form->bind($request->getPostParameters());
            if($form->isValid())
            {
                $form->execute();
                $response=array('status'=>'OK');
            }
            else
            {
                $response=array('status'=>'KO','error'=> $form->getErrorSchema()->getErrorsMessage());
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
            return array('error'=>$messages->getDecodedErrors());
        }  
        return $response;
    }

}
