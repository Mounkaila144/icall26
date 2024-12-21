<?php

require_once dirname(__FILE__).'/../locales/Forms/CalculateDateForm.class.php';

class utils_ajaxCalculateDateAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {
            $this->user = $this->getUser();
            $this->form=new CalculateDateForm($request->getPostParameter('Date'));
            $this->form->bind($request->getPostParameter('Date'));
            $this->settings = UtilsHolidayCalendarSettings::load();
            
            if ($this->form->isValid()) 
            {
                $response = array("date"=>$this->settings->calculateDate($this->form->getValue("date")));
            }  
            else
            {
                $response = array("error"=>implode("<br/>", $this->form->getErrorSchema()->getErrorsMessage())); 
//                echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }     
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;   
    }

}

