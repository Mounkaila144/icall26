<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormPositionsForm.class.php";

class customers_meetings_forms_ajaxPositionsFormAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();           
        try 
        {                          
            $this->form_positions=new CustomerMeetingFormPositionsForm($request->getPostParameter('PositionForms'));
            
         //   var_dump($this->form->getCSRFToken());
            
            if ($request->isMethod('POST') && $request->getPostParameter('PositionForms'))
            {
                $this->form_positions->bind($request->getPostParameter('PositionForms'));
                if ($this->form_positions->isValid())
                {
                    CustomerMeetingFormUtils::updatePositionForFormsAndFormFields($this->form_positions->getValue('forms'));
                    $messages->addInfo(__("Positions of forms has been saved."));
                }   
                else 
                {
                   // echo "<pre>"; var_dump($this->form_positions->getErrorSchema()->getErrorsMessage()); echo "</pre>"; 
                    $messages->addError(__("Form has some errors."));
                }
            }
        } 
        catch (mfException $e) 
        {
            $messages->addError($e);
        }
        $this->forms=CustomerMeetingFormUtils::getPositions();
    }

}

