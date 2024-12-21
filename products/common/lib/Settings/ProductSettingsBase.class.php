<?php
 

class ProductSettingsBase extends mfSettingsBase {        
     
     protected static $instance=null;
               
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
     
    
}
