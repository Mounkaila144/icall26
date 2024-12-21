<?php


class SiteCompanyBaseForm extends mfForm {
    
    protected $registration_validators=array();
                  
    function configure() {              
        $this->setValidators(array(
            'id' => new mfValidatorInteger(),  
            'name' => new mfValidatorName(),  
            'commercial' => new mfValidatorName(array("required"=>false)),         
            'email' => new mfValidatorEmail(), 
            'footer_text'=>new mfValidatorString(array("required"=>false)),
         //   'email_system' => new mfValidatorEmail(), 
            'web' => new mfValidatorDomain(array("required"=>false)),            
            'address1' => new mfValidatorString(array("required"=>false)),
         //   'address2' => new mfValidatorString(array("required"=>false)),
            'phone' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
            'fax' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
            'city' => new mfValidatorString(array("required"=>false)),
            'postcode' => new mfValidatorString(array("required"=>false)),
            'country' => new mfValidatorI18nChoiceCountry(array("required"=>false)),
            'mobile' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
        //    'coordinates' => new mfValidatorCoordinates(array("required"=>false)),
            'picture'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 *1024 *1024,
                                                 )),
            'header'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 *1024 *1024,
                                                 )),
            'footer'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 *1024 *1024,
                                                 )),
             'stamp'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 *1024 *1024,
                                                 )),
              'signature'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 *1024 *1024,
                                                 )),
            'siret'=>new mfValidatorString(array('required'=>false)),
            'tva'=>new mfValidatorString(array('required'=>false)),
            'rcs'=>new mfValidatorString(array('required'=>false)),
            'ape'=>new mfValidatorNAF(array('required'=>false)) ,
            'gender'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname'=> new mfValidatorName(array("required"=>false)),
            'lastname'=> new mfValidatorName(array("required"=>false)),          
            'function'=> new mfValidatorString(array("required"=>false)),
            'capital'=> new mfValidatorString(array("required"=>false)),
            'comments'=> new mfValidatorString(array("required"=>false)),
            'rge'=> new mfValidatorString(array("required"=>false)),
               'firstname1'=> new mfValidatorName(array("required"=>false)),
            'lastname1'=> new mfValidatorName(array("required"=>false)),          
            'function1'=> new mfValidatorString(array("required"=>false)),
            'rge_start_at'=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),
            'rge_end_at'=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),
        ));                            
    /*  foreach (mfCountryCompany::getInstance($this->getDefault('country'))->getRegistration() as $name=>$validator)
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
      }    */     
    }
    
    function getRegistrationValidators()
    {
        return $this->registration_validators;
    }
    
}


