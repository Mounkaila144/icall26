<?php

class dialogListFilterMultipleSitesFormFilter extends mfFormFilterBase {
 
    function configure()
    {
       $this->setDefault('nbitemsbypage',"10");
       // Base Query
       $this->setQuery("SELECT * FROM ".  Site::getTable().";");
       // Validators 
       $this->setValidators(array(  
           
           "selected"=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selected')),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","*"=>"*",))),         
        ));
    }
}