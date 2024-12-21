<?php


class PartnerWithContactNewForm extends mfForm {
    
    
     function configure() {       
        $this->embedForm('company', new PartnerBaseForm($this->getDefault('company')));
        $this->defaults['contact']['country']=$this->defaults['company']['country'];             
        $this->embedForm('contact', new PartnerContactBaseForm($this->getDefault('contact')));
        $this->company['email']->setOption('required',false);
        unset($this->company['id'],$this->contact['id']);        
     }
    
     
      function getValuesForCompany()
     {
         $values= $this['company']->getValue();
         $parameters=array();
         foreach (['software_editor' ,'software_name' ,'software_date' ,'software_version','qualification_reference','qualification_date'] as $field)
              $parameters[$field]=$this['company'][$field]->getValue();
         $values['parameters']=json_encode($parameters);
         return $values;
     }
     
}


