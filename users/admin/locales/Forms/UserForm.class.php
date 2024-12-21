<?php

class UserForm extends UserBaseForm {

    function configure()
    {
        $settings=  UserSettings::load();
        parent::configure();        
        if ($settings->hasCallCenter())   
        {    
            $this->setValidator("callcenter_id",new mfValidatorChoice(array("choices"=>array(""=>"")+Callcenter::getCallcenterForSelect(),"key"=>true,"required"=>false)));        
        }
        if ($this->getUser()->hasCredential(array(array('superadmin','settings_user_view_company'))))
        {
            $this->setValidator('company_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractCompany::getActiveCompaniesForSelect()->unshift(array(""=>__("Not defined"))))));       
        }
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')));
        unset($this['team_id']);      
    }        
    
    
}