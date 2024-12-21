<?php

class dashboard_ajaxViewLogAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
         if (!$request->isXmlHttpRequest())
            return mfView::NONE;
         $messages = mfMessages::getInstance();    
         $logValidator=new mfValidatorLogFile();
         $logValidator->addMessages(array(
                                         'file'=> __("file [{value}] doesn't exist"),
                                         'invalid'=> __("the file [{value}] is invalid")
                                         )
                                   );
         try
         {
            $this->log=$logValidator->isValid($request->getPostParameter('name'));
         }
         catch (mfValidatorError $e)
         {
             $messages->addError($e);     
         }
    }
	
}

