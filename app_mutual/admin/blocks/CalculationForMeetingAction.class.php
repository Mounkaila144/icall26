<?php


class app_mutual_CalculationForMeetingActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {        
        $this->meeting = $this->getParameter("meeting");
    } 
    
}