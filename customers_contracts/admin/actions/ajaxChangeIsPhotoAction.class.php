<?php


class customers_contracts_ajaxChangeIsPhotoAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try
        {  
            $form=new ChangeForm();           
            $form->bind($request->getPostParameter('CustomerContract'));
            if (!$form->isValid())                                
               throw new mfException("Form invalid!");                                     
            $value=$form->getValue('value')=='N'?'Y':'N';
            $contract=new CustomerContract($form->getValue('id'));
            $contract->set('is_photo', $value)->save();   
            $response = array(
                            "action"=>"ChangeIsPhoto",
                            "id" =>$contract->get('id'),                           
                            "value" =>$contract->get('is_photo'),                           
                            "info"=>__("Photo has been updated.")
                            );
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
