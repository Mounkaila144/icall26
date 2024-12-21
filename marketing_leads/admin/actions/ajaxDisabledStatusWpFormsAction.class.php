<?php

class marketing_leads_ajaxDisabledStatusWpFormsAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $form = new MarketingLeadsWpForms($validator->isValid($request->getPostParameter('WpForms')));
            if ($form->isLoaded())
            {    
                $form->set('status','DELETE');
                $form->save();
                $response = array("action"=>"DisableWpForms","id" =>$form->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
