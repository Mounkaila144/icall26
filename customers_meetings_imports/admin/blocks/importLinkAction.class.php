<?php



class customers_meetings_imports_importLinkActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
    } 
    
    
}