<?php

require_once __DIR__."/CustomerMeetingsFormFilter.class.php";

class DialogListFilterMeetingsFormFilter extends CustomerMeetingsFormFilter {

    
    function configure()
    {         
        parent::configure();        
        $this->setDefault('nbitemsbypage',10);
        $this->setValidator('selected',new ObjectExistsValidator('CustomerMeeting',array('required'=>false)));
        $this->setValidator('nbitemsbypage',new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20"),"key"=>true)));                    
    }
    
    
    
}

