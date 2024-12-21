<?php

class app_domoprime_zoneForMeetingActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
         $meeting=$this->getParameter('meeting'); 
         
         $this->zone= new DomoprimeZone(array('code'=>$meeting->getCustomer()->getAddress()->getDept()));
    } 
    
    
}