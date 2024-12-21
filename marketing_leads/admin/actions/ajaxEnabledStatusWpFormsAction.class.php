<?php


class marketing_leads_ajaxEnabledStatusWpFormsAction extends mfAction {
    
    function execute(mfWebRequest $request) {     
        $messages = mfMessages::getInstance();   
        try 
        {         
            $validator = new mfValidatorInteger();
            $form = new MarketingLeadsWpForms($validator->isValid($request->getPostParameter('WpForms')));
            if ($form->isLoaded())
            {    
                $form->set('status','ACTIVE');
                $form->save();
                $response = array("action"=>"EnableWpForms","id" =>$form->get('id'));
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }
}
