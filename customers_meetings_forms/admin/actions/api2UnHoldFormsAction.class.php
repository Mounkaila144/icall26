<?php

// www.ecosol16.net/admin/api/v2/customers/meeting/forms/admin/UnHoldForms


class customers_meetings_forms_api2UnHoldFormsAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {             
         $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*')
                ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept'); 
        if (!$this->getUser()->hasCredential(array(array('superadmin', 'api2_unhold'))))
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();          
        try {
             $response=new mfArray();
            if ($request->getGetAndPostParameter('contract'))
            {
                $meeting_or_contract=new CustomerContract($request->getGetAndPostParameter('contract'));
                if ($meeting_or_contract->isNotLoaded())           
                        throw new mfException('Contract is invalid');
            }
            elseif ($request->getGetAndPostParameter('meeting'))
            {
                $meeting_or_contract=new CustomerMeeting($request->getGetAndPostParameter('meeting'));
                if ($meeting_or_contract->isNotLoaded())           
                        throw new mfException('Meeting is invalid');
            }
            $forms=new CustomerMeetingForms($meeting_or_contract);   
            if ($forms->isNotLoaded())
                    throw new mfException('Forms is invalid');
            $forms->setUnHold(); 
            $forms->save();
            return $response->add(array('id'=>$forms->get('id'),'status'=>'OK'))->toArray();
        } catch (mfException $e) {
            $messages->addError($e);
        }
         return $messages->hasMessages('error')?array("errors"=>$messages->getDecodedErrors()):$response->toArray();
    }

}
