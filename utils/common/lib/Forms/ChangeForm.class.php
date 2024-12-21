<?php


class ChangeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
                 "id"=>new mfValidatorInteger(),
                 "value"=> new mfValidatorChoice(array("choices"=>array("NO","YES","N","Y")))
                ));
    }
    
       function getIsActiveValue()
    {
        return ((string)$this['value']=='YES')?"NO":"YES";
    }
    
    function getToggle()
    {
         return ((string)$this['value']=='YES')?"NO":"YES";
    }
}
