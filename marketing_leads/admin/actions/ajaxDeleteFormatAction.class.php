<?php

class marketing_leads_imports_ajaxDeleteFormatAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        try 
        {        
            $item=new MarketingLeadsWpFormsLeadsImportFormat($request->getPostParameter('WpFormsLeadsImportFormat'));        
            if ($item->isLoaded())
            {    
                $item->delete();
                $response = array("action"=>"DeleteFormat",
                                  "id" =>$item->get('id')
                            );
            }    
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

