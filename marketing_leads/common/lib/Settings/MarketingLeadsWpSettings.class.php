<?php

class MarketingLeadsWpSettings extends mfSettingsBase {
    
    protected static $instance=null;
    protected $default_attribution=null;    

    function __construct($data=null,$site=null)
    {
        parent::__construct($data,null,'frontend',$site);
    } 

    function getDefaults()
    {   
        $this->add(array(
                            "max_leads_to_fetch"=>1000,
                            "state"=>0,
                            "default_state"=>0,
                            "sended_state"=>0,
                            "table_lead_name"=>"mod555_contact",
                            "blacklist_phones_list"=>null
                        ));
    }
            
    function getStatusForMeeting()
    {
        $state=new CustomerMeetingStatus($this->get("state"),$this->getSite());          
        if ($state->isNotLoaded())    
            return null;
        return $state;
    }
    
    function hasStatusForMeeting()
    {
        return (boolean) $this->get('state');
    }
    
    function hasBlacklistPhonesList()
    {
        return (boolean) $this->get('blacklist_phones_list');
    }
    
    function getBlacklistPhonesList()
    {
        return $this->get('blacklist_phones_list');
    }
     
    function getDefaultStatus()
    {
        return $this->_default_state = $this->_default_state===null?new MarketingLeadsWpFormsStatus($this->get("default_state"),$this->getSite()):$this->_default_state;                 
    }
    
    function hasDefaultStatus()
    {
        return (boolean) $this->get('default_state');
    }
    
      
    function getSendedStatus()
    {
        $state = new MarketingLeadsWpFormsStatus($this->get("sended_state"),$this->getSite());
        return ($state->isNotLoaded())?0:$state;
    }
     
    function hasDefaultSendedStatus()
    {
        return (boolean) $this->get('sended_state');
    }
}
