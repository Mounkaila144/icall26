<?php

class MarketingLeadsWpFormsLeadsImportSettings extends mfSettingsBase {
    
    protected static $instance=null;    

    function __construct($data=null,$site=null)
    {
        parent::__construct($data,null,'frontend',$site);
    } 

    function getDefaults()
    {   
        $this->add(array(
                            "default_language"=>"FR",
                            "number_of_items"=>100,
//                            "leads_status"=>null
                        ));
    }     
    
//    function hasLeadsStatus()
//    {
//        if ($this->get('leads_status') instanceof mfArray)
//        {
//           return !$this->getLeadsStatus()->isEmpty();
//        }
//        return false;
//    }
//    
//    function getLeadsStatus()
//    {
//        
//    }
}
