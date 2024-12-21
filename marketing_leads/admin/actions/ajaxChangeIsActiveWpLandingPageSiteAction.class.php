<?php

class marketing_leads_ajaxChangeIsActiveWpLandingPageSiteAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {        
            $form = new ChangeForm();
            $form->bind($request->getPostParameter('WpLandingPageSite'));
            if ($form->isValid())
            {
                $item= new MarketingLeadsWpLandingPageSite($form->getValue('id'));    
                if ($item->isLoaded())
                {  
                    $value=((string)$form['value']=='YES')?$item->disable():$item->enable();                
                    $response = array("action"=>"ChangeIsActiveWpLandingPageSite","id"=>$item->get('id'),"state"=>$item->get('is_active'));
                }
            }                          
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

