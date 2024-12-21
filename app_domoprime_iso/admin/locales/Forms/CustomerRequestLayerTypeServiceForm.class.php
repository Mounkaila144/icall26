<?php


class CustomerRequestLayerTypeServiceForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(                     
            'name' => new mfValidatorString(array('required'=>false)), 
            'value' => new mfValidatorString(),                              
        ));       
    }
}

