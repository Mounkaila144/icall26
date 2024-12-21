<?php


class PartnerBaseForm extends mfForm {
    
 //   protected $registration_validators=array();
                  
    function configure() {              
        $this->setValidators(array(
            'id' => new mfValidatorInteger(),  
            'name' => new mfValidatorName(),                 
            'email' => new mfValidatorEmail(array("required"=>false)), 
            'web' => new mfValidatorString(array("required"=>false)),            
            'address1' => new mfValidatorString(array("required"=>false)),
            'address2' => new mfValidatorString(array("required"=>false)),
            'phone' => new mfValidatorString(array("required"=>false)),
            'fax' => new mfValidatorString(array("required"=>false)),
            'city' => new mfValidatorString(array("required"=>false)),
            'postcode' => new mfValidatorString(array("required"=>false)),
            'country' => new mfValidatorI18nChoiceCountry(array("required"=>false)),
            'mobile' => new mfValidatorString(array("required"=>false)),
            'coordinates' => new mfValidatorCoordinates(array("required"=>false)),   
            'siret' => new mfValidatorString(array("required"=>false)),   
            'comments' => new mfValidatorString(array("required"=>false)),           
            'software_editor' => new mfValidatorString(array("required"=>false)),   
            'software_name' => new mfValidatorString(array("required"=>false)),   
            'software_date' => new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),
            'software_version' => new mfValidatorString(array("required"=>false)),                    
            'qualification_reference' => new mfValidatorString(array("required"=>false)),
            'qualification_date' =>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),

        ));                            
   /*   foreach (mfCountryCompany::getInstance($this->getDefault('country'))->getRegistration() as $name=>$validator)
      {              
          $name_validator=$validator['name'];                
          $options=isset($validator['options'])?$validator['options']:array();        
          $this->setValidator($name,new $name_validator($options));
          if (isset($validator['title']))
              $this->getValidator($name)->title=$validator['title'];
          $this->getValidator($name)->registration=true;
          $this->registration_validators[$name]=$this->getValidator($name);
          if (!$this->getDefaults() && isset($validator['default']))
          {            
              $this->setDefault($name,$validator['default']);              
          }
          $this->getValidator($name)->setOption('required',false); // Not mandatory for superadmin only
      }       */  
    }
    
 /*   function getRegistrationValidators()
    {
        return $this->registration_validators;
    }*/
    
}


