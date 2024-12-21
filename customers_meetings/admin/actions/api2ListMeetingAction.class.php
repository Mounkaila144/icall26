<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/ListMeeting

//require_once dirname(__FILE__)."/../locales/Api/FormFilters/CustomerMeetingApiFormFilter.class.php";
//require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsPager.class.php";
require_once dirname(__FILE__)."/../locales/Api/v2/CustomerMeetingListFormatterApi2.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsPager.class.php";

class customers_meetings_api2ListMeetingAction extends mfAction {

    function execute(mfWebRequest $request) {              
        /*$this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');*/
        $messages = mfMessages::getInstance();                                
       if (!$this->getUser()->hasCredential([['superadmin','api_v2_customer_meeting_list']]))
             $this->forwardTo401Action ();
         try 
      {        
          $data = new CustomerMeetingListFormatterApi2($this);         
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$data->getData()->toArray();
    }

}