<?php

class CustomerContractHoldViewFormBuilder {
    
    protected $user=null,$form=null;
    
    function __construct($user,mfForm $form) {
        $this->form=$form;
        $this->user=$user;       
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getForm()
    {
        return $this->form;
    }
    
    function configure()
    {           
           if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_opc_at'))))
           {    
               $this->getForm()->setValidator("opc_at",new mfValidatorI18nDate(array('date_format'=>"a","required"=>false)));
           }  
           elseif ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_opc_at_datetime'))))
            {          
               $this->getForm()->setValidator('opc_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));
            }  
            if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_opc_range'))))
            {
                 $this->getForm()->setValidator('opc_range_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractRange::getRangesForI18nSelect())));
            } 
           if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_financial_partner'))))
           {    
               $this->getForm()->setValidator( 'financial_partner_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+PartnerUtils::getPartnerForSelect())));
           }  
           if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_time_state'))))
           {
               $this->getForm()->setValidator('time_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractTimeStatus::getStatusForI18nSelect())));
           } 
           if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_opc_status'))))
           {
               $this->getForm()->setValidator('opc_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractOpcStatus::getStatusForI18nSelect())));
           } 
           if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_admin_status'))))
           {
               $this->getForm()->setValidator('admin_status_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array(""=>__("Not defined"))+CustomerContractAdminStatus::getStatusForI18nSelect())));
           } 
           if ($this->getUser()->hasCredential(array(array('superadmin_debugX','contract_modify_hold_state'))))
           {
                $this->getForm()->setValidator('state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("Not defined"))+CustomerContractStatusUtils::getStatusForI18nSelect())));
           }   
           if ($this->getUser()->hasCredential(array(array('superadmin_debug','contract_modify_hold_sav_at_date'))))
           {          
               $this->getForm()->setValidator('sav_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
           }            
           if ($this->getForm()->hasFields())
           {
                $this->getForm()->setValidator('id',new mfValidatorInteger());     
           }    
    }
    
}