<?php


class CustomerContractPollutingCompanyBaseForm extends mfForm{
    
    
 
        function configure() {        
            
            $this->setValidators(array(
                'id' => new mfValidatorInteger(),  
                'name' => new mfValidatorName(),                 
                'commercial' => new mfValidatorName(array("required"=>false)),  
                'username' => new mfValidatorString(array("required"=>false)),
                'email' => new mfValidatorEmail(array("required"=>false)), 
                'web' => new mfValidatorDomain(array("required"=>false)),            
                'address1' => new mfValidatorString(array("required"=>false)),
                'address2' => new mfValidatorString(array("required"=>false)),
                //'is_active'=>new mfValidatorChoice(array("choices"=>array("YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),
                'phone' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
                'fax' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
                'city' => new mfValidatorString(array("required"=>false)),
                'postcode' => new mfValidatorString(array("required"=>false)),
                'footer' => new mfValidatorString(array("required"=>false)),
                'country' => new mfValidatorI18nChoiceCountry(array("required"=>false)),
                'mobile' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
                'coordinates' => new mfValidatorCoordinates(array("required"=>false)),  
                'is_default'=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
                'has_pacreno'=>new mfValidatorBoolean(array("true"=>"Y","false"=>"N","empty_value"=>"N")),
                'siret'=> new mfValidatorString(array("required"=>false)), 
                 'logo'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>2 *1024 *1024,
                                                 )),
                 'signature'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 *1024 *1024,
                                                 )),
                 'picture'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>2 *1024 *1024,
                                                 )),
                 'comments' => new mfValidatorString(array("required"=>false)),
                 'remarks' => new mfValidatorString(array("required"=>false)),
                 'prime_precision' => new mfValidatorInteger(array("required"=>false)), 
            ));  
            
            //$this->setDefault('is_active','YES');
    }
}
