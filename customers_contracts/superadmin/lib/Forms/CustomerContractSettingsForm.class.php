<?php



 class CustomerContractSettingsForm extends CustomerContractSettingsBaseForm {
 
    
  
    function configure()
    {
        parent::configure();
        $this->setValidator("has_assistant",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                     
        $this->setValidator("has_polluter",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                     
        $this->setValidator("has_partner_layer",new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")));                     
        $this->setValidator("filter_numberofitems_by_page",new mfValidatorChoice(array('key'=>true,'choices'=>array('10'=>10,'20'=>20,'50'=>50,'100'=>100))));                     
    }
    
 
}


