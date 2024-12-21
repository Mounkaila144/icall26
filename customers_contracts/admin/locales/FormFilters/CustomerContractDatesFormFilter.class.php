<?php


class CustomerContractDatesFormFilter extends CustomerContractsFormFilter {

    
    
    function configure() {
        parent::configure();
        $this->equal->addValidator( "dates_is_valid",new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)));
    }
    
    
     
    
}

