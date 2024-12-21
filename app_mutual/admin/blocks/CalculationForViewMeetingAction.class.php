<?php

class app_mutual_CalculationForViewMeetingActionComponent extends mfActionComponent {
    
    function execute(mfWebRequest $request)
    {        
        $this->meeting = $this->getParameter("meeting");
        $this->meeting_calculation = MutualEngineCalculationMeeting::getFirstEngineMeetingCalculationForMeeting($this->meeting);
    } 
    
}