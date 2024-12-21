<?php



class customers_meetings_forms_newActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
    } 
    
    
}