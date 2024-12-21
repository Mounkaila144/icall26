<?php


require_once __DIR__."/CustomerRequestEnergyServiceForm.class.php";
require_once __DIR__."/CustomerRequestOccupationServiceForm.class.php";
require_once __DIR__."/CustomerRequestLayerTypeServiceForm.class.php";

 class CustomerRequestServiceForm extends mfForm {
 
    
    function configure()
    {
        $this->setValidators(array(                                    
            "revenue"=>new mfValidatorI18nNumber(array('required'=>false)),                                                                             
            "number_of_people"=>new mfValidatorNumber(array('required'=>false)),    
            "parcel_surface"=>new mfValidatorNumber(array('required'=>false)),    
            "parcel_reference"=>new mfValidatorString(array('required'=>false)),        
            "install_surface_wall"=>new mfValidatorNumber(array('required'=>false)),    
            "install_surface_top"=>new mfValidatorNumber(array('required'=>false)),    
            "install_surface_floor"=>new mfValidatorNumber(array('required'=>false)),    
            "tax_credit_used"=>new mfValidatorNumber(array('required'=>false)),    
            "surface_wall"=>new mfValidatorNumber(array('required'=>false)),    
            "surface_top"=>new mfValidatorNumber(array('required'=>false)),    
            "surface_floor"=>new mfValidatorNumber(array('required'=>false)),    
            "surface_ite"=>new mfValidatorNumber(array('required'=>false)),    
            "number_of_fiscal"=>new mfValidatorNumber(array('required'=>false)),             
            "more_2_years"=>new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')),
            "number_of_children"=>new mfValidatorNumber(array('required'=>false)),    
            "declarants"=>new mfValidatorString(array('required'=>false)),        
            "created_at"=>new mfValidatorDate(array('required'=>false,'with_time'=>true,'date_format'=>"~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>[0-1][0-9]|2[0-3]):(?P<minute>[0-5][0-9]):(?P<second>[0-5][0-9])~")),
            "updated_at"=>new mfValidatorDate(array('required'=>false,'with_time'=>true,'date_format'=>"~(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2}) (?P<hour>[0-1][0-9]|2[0-3]):(?P<minute>[0-5][0-9]):(?P<second>[0-5][0-9])~")), 
            "number_of_parts"=>new mfValidatorNumber(array('required'=>false)),   
            "boiler_quantity"=>new mfValidatorNumber(array('required'=>false)), 
            "pack_quantity"=>new mfValidatorNumber(array('required'=>false)), 
            "surface_ite"=>new mfValidatorNumber(array('required'=>false)), 
        ));
        $this->embedForm('energy_id', new CustomerRequestEnergyServiceForm(),array('required'=>false));
        $this->embedForm('occupation_id', new CustomerRequestOccupationServiceForm(),array('required'=>false));
        $this->embedForm('layer_type_id', new CustomerRequestLayerTypeServiceForm(),array('required'=>false));
    }
    
 
}


