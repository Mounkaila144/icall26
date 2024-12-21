<?php

class app_mutual_ajaxChangeIsActiveMutualPartnerAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {        
            $form=new ChangeForm();
            $form->bind($request->getPostParameter('MutualPartner'));
            if ($form->isValid())
            {
                $item = new MutualPartner($form->getValue('id'));    
                if ($item->isLoaded())
                {  
                    $value=((string)$form['value']=='YES')?"NO":"YES"; 
                    $item->set('is_active',$value);
                    $item->save();                
                    $response = array("action"=>"ChangeIsActiveMutualPartner","id"=>$item->get('id'),"state" =>$value);
                }
            }    
            else
            {
//                echo "<pre>"; var_dump($form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

