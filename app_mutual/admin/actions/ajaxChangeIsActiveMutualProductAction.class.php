<?php

class app_mutual_ajaxChangeIsActiveMutualProductAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {        
            $form = new ChangeForm();
            $form->bind($request->getPostParameter('MutualProduct'));
            if ($form->isValid())
            {
                $item= new MutualProduct($form->getValue('id'));    
                if ($item->isLoaded())
                {  
                    $value=((string)$form['value']=='YES')?"NO":"YES"; 
                    $item->set('is_active',$value);
                    $item->save();                
                    $response = array("action"=>"ChangeIsActiveMutualProduct","id"=>$item->get('id'),"state" =>$value);
                }
            }                          
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

