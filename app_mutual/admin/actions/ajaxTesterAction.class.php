<?php

class app_mutual_ajaxTesterAction extends mfAction {
    
    function execute(mfWebRequest $request) {      
        
        $messages = mfMessages::getInstance();
        
        $this->meeting = new CustomerMeetingMutual(79642);//79642
        $this->engine_core = new AppMutualEngineCore($this->meeting,date('Y-m-d H:i:s'));
        
        try 
        {
            $this->engine_core->process();
            echo "Commission ".$this->engine_core->getGlobalCommission()." <br/>";
            echo "Decommission ".$this->engine_core->getGlobalDecommission()." <br/>";
            $this->engine_calculation = new MutualEngineCalculationMeeting($this->engine_core);
        }       
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
        
//        $pattern= "# \w*?[aeiou]{2}\w*? #";
//
//        $string = "There’s a lion loose in the Maister park";
//
//        $matches= array();
//
//        preg_match_all($pattern, $string, $matches);
//        var_dump($matches);
        return mfView::NONE;
    }
}
  