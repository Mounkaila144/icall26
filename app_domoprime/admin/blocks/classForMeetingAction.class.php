<?php

class app_domoprime_classForMeetingActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {      
            try
            {
                  $this->engine=new DomoprimeEngine($this->getParameter('meeting'));
                  $this->engine->process();   
            }
            catch (mfException $e)
            {
                $this->getMessage()->addError($e);
            }
    
    } 
    
    
}