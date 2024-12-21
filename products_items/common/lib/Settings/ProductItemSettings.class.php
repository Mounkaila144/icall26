<?php
 

class ProductItemSettings extends mfSettingsBase {        
     
     protected static $instance=null;
               
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
     
     function getDefaults()
     {
         $this->add(array(                 
                "calculation_by_ttc"=>"NO",     
                "format_price"=>"#.00"
              ));   
     }
     
     function isCalculationByTTC()
     {
         return $this->get('calculation_by_ttc')=='YES';
     }
}
