<?php


class CustomerContractPollutingCompanyWithContactNewFom extends mfFormSite{
    
    protected $user=null;
    
    function __construct($user,$defaults=array(),$site=null)
    {               
        $this->user=$user;
        parent::__construct($defaults,array(),$site);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
            
     function configure() {       
        $this->embedForm('company', new CustomerContractPollutingCompanyBaseForm($this->getDefault('company')));
        $this->defaults['contact']['country']=$this->defaults['company']['country'];             
        $this->embedForm('contact', new CustomerContractPollutingContactBaseForm($this->getDefault('contact'),$this->getSite()));
        $this->company['email']->setOption('required',false);
        unset($this->company['id'],$this->contact['id'],$this->company['country']);      
        if ($this->getUser()->hasCredential(array(array('superadmin','app_domoprime_iso_polluter_new_type'))))
           $this->company->addValidator('type',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>DomoprimePollutingCompany::getTypes()->unshift(array(''=>'')))));
     }
}
