<?php
 

class SiteOversightSettings extends mfSettingsBase {      
       
     protected static $instance=null;
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                'emails'=>"" ,                 
                'oversights'=>"",
              ));        
     }
         
     function hasEmails()
     {
         return $this->get('emails') || $this->get('oversights');
     }
     
     function getEmails()
     {
        $values=$this->get('emails',new mfArray());
        if ($this->get('oversights'))
            $values->merge($this->get('oversights'));
        return $values;
     }
}
