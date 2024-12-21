<?php

class app_mutual_ajaxChangeIsActiveMutualCalculationMeetingAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {  
        
        $messages = mfMessages::getInstance();   
        try 
        {        
            $form = new ChangeForm();
            $form->bind($request->getPostParameter('MutualCalculationMeeting'));
            if ($form->isValid())
            {
                $item= new MutualEngineCalculationMeeting($form->getValue('id'));    
                if ($item->isLoaded())
                {  
                    $value=((string)$form['value']=='YES')?"NO":"YES"; 
                    $item->set('is_active',$value);
                    $item->save();                
                    $response = array("action"=>"ChangeIsActiveMutualCalculationMeeting","id"=>$item->get('id'),"state" =>$value);
                }
            }                          
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

