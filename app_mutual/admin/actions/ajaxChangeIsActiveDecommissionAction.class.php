<?php

class app_mutual_ajaxChangeIsActiveDecommissionAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {        
            $form = new ChangeForm();
            $form->bind($request->getPostParameter('MutualProductDecommission'));
            if ($form->isValid())
            {
                $item= new MutualProductDecommission($form->getValue('id'));    
                if ($item->isLoaded())
                {  
                    $value=((string)$form['value']=='YES')?"NO":"YES"; 
                    $item->set('is_active',$value);
                    $item->save();                
                    $response = array("action"=>"ChangeIsActiveDecommission","id"=>$item->get('id'),"state" =>$value);
                }
            }                          
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

