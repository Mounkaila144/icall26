<?php


class MutualPartnerWithContactNewForm extends mfForm {
    
    
    function configure() {       
       $this->embedForm('company', new PartnerBaseForm($this->getDefault('company')));
       $this->defaults['contact']['country']=$this->defaults['company']['country'];             
       $this->embedForm('contact', new PartnerContactBaseForm($this->getDefault('contact')));
       $this->company['email']->setOption('required',false);
       unset($this->company['id'],$this->contact['id'],$this->company['country']);        
    }
    
    function getValues()
    {
        $values= parent::getValues();
        $values['company']['country']='FR';
        return $values;
    }
    
}


