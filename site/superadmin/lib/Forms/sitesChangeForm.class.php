<?php

class SitesChangeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
                   "selection"=>new mfValidatorSchemaForEach(new mfValidatorDomain() ,count($this->getDefault('selection'))),
                   "value"=> new mfValidatorBoolean()
                ));
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        $name="site_".($this->getOptions()?$this->getOptions()."_":"")."available";
        $values['value']=$values['value']?"YES":"NO";
        foreach ($values['selection'] as $index=>$item)
        {
            $values['sites'][$index]['site_host']=$item;
            $values['sites'][$index][$name]=$values['value'];
        }    
        return $values;
    }
}

