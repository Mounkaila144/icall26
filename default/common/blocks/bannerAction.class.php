<?php


class default_bannerActionComponent extends mfActionComponent {

        
    function execute(mfWebRequest $request)
    {                      
       foreach (array('application','class','id','site') as $name)
            $this->$name=$this->getParameter($name);       
       if ($this->site)
       {
           
       }   
       else
       {    
         $this->banner=$request->getSite()->getBanner();
       }           
    } 
    

}

