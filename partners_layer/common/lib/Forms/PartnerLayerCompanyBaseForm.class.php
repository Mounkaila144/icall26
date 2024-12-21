<?php


class PartnerLayerCompanyBaseForm extends mfForm {
    
    
 
        function configure() {        
            
            $this->setValidators(array(
                'id' => new mfValidatorInteger(),  
                'name' => new mfValidatorName(),                 
                'email' => new mfValidatorEmail(array("required"=>false)), 
                'web' => new mfValidatorString(array("required"=>false)),            
                'address1' => new mfValidatorString(array("required"=>false)),
                'address2' => new mfValidatorString(array("required"=>false)),
                //'is_active'=>new mfValidatorChoice(array("choices"=>array("YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),
                'phone' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
                'fax' => new mfValidatorString(array("required"=>false)),
                'city' => new mfValidatorString(array("required"=>false)),
                'postcode' => new mfValidatorString(array("required"=>false)),
                'rge' => new mfValidatorString(array("required"=>false)),
                'country' => new mfValidatorI18nChoiceCountry(array("required"=>false)),
                'mobile' => new mfValidatorString(array("min_length"=>10,"max_length"=>10,"required"=>false)),
              //  'coordinates' => new mfValidatorCoordinates(array("required"=>false)),   
                'is_default'=>new mfValidatorBoolean(array("true"=>"YES","false"=>"NO","empty_value"=>"NO")),
                'siret'=> new mfValidatorString(array("required"=>false)), 
                 'logo'=> new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>2 *1024 *1024,
                                                 )),
                 'rge_start_at'=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),
            'rge_end_at'=>new mfValidatorI18nDate(array("date_format"=>"a","required"=>false)),
                  'comments'=> new mfValidatorString(array("required"=>false)), 
            ));  
            
            //$this->setDefault('is_active','YES');
    }
}
