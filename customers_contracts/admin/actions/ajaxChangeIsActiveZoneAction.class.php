<?php


class customers_contracts_ajaxChangeIsActiveZoneAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        try
        {  
            $form=new ChangeForm();           
            $form->bind($request->getPostParameter('CustomerContractZone'));
            if (!$form->isValid())     
            {                
               throw new mfException("Form invalid!");                         
            }
            $value=$form->getValue('value')=='NO'?'YES':'NO';
            $zone=new CustomerContractZone($form->getValue('id'));
            $zone->set('is_active', $value)->save();   
            $response = array(
                            "action"=>"ChangeIsActiveZone",
                            "id" =>$zone->get('id'),                           
                            "value" =>$zone->get('is_active'),                           
                            "info"=>__("Status has been updated.")
                            );
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
