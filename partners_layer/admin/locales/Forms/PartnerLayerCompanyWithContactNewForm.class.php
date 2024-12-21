<?php


class PartnerLayerCompanyWithContactNewForm extends mfForm {
    
    
     function configure() {       
        $this->embedForm('company', new PartnerLayerCompanyBaseForm($this->getDefault('company')));
        $this->defaults['contact']['country']=$this->defaults['company']['country'];             
        $this->embedForm('contact', new PartnerLayerContactBaseForm($this->getDefault('contact')));
        $this->company['email']->setOption('required',false);
        unset($this->company['id'],$this->contact['id']);        
     }
    
}


