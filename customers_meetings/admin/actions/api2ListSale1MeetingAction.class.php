<?php
// www.ecosol16.net/admin/api/v2/meetings/admin/ListSale1Meeting

 
class customers_meetings_api2ListSale1MeetingAction extends mfAction {
   
    public function execute(\mfWebRequest $request) {
           $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        if (!$this->getUser()->hasCredential(array(array('superadmin','api2_meeting_list_sales'))))
            $this->forwardTo401Action(); 
        if (!$this->getUser()->hasGroups('telepro') || $this->getUser()->hasGroups('commercial'))        
            return UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser());        
        return array();
    }

}
