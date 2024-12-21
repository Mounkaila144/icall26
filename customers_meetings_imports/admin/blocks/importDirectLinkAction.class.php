<?php



class customers_meetings_imports_importDirectLinkActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
    } 
    
    
}