<?php

class marketing_leads_ajaxChangeIsActiveWpFormsAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {        
            $form = new ChangeForm();
            $form->bind($request->getPostParameter('WpForms'));
            if ($form->isValid())
            {
                $item= new MarketingLeadsWpForms($form->getValue('id'));    
                if ($item->isLoaded())
                {  
                    $value=((string)$form['value']=='YES')?$item->disable():$item->enable();                
                    $response = array("action"=>"ChangeIsActiveWpForms","id"=>$item->get('id'),"state" =>$item->get('is_active'));
                }
            }                          
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

