<?php

/*
 * Generated by SuperAdmin Generator date : 24/04/13 15:45:29
 */
 
class customers_meetings_forms_ajaxUpdateContractAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try {

            CustomerMeetingForms::updateContract();
            $messages->addInfo(__("Contract has been updated"));
        } catch (mfException $e) {
            $messages->addError($e);
        }
        $this->forward($this->getModuleName(), 'ajaxListPartialForm');
    }

}
