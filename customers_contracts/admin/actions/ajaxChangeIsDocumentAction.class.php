<?php


class customers_contracts_ajaxChangeIsDocumentAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try
        {  
            $form=new ChangeForm();           
            $form->bind($request->getPostParameter('CustomerContract'));
            if (!$form->isValid())     
            {                
               throw new mfException("Form invalid!");                         
            }
            $value=$form->getValue('value')=='N'?'Y':'N';
            $contract=new CustomerContract($form->getValue('id'));
            $contract->set('is_document', $value)->save();   
            $response = array(
                            "action"=>"ChangeIsDocument",
                            "id" =>$contract->get('id'),                           
                            "value" =>$contract->get('is_document'),                           
                            "info"=>__("Document has been updated.")
                            );
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
