<?php

class UserSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     protected $telepro_groups=null,$sales_groups=null,$sale_profiles=null,$telepro_profiles=null,$default_team_id=null;
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);
     } 
      
     function getDefaults()
     {   
         $this->add(array(
                              "has_manager2"=>'NO',    
                              "has_callcenter"=>'NO',  
                              "activity_timer"=>10 * 60,
                              "remaining_time"=>60,
             
                              "logout_timer"=>15,
                              "telepro_groups"=>array(),
                              "sales_groups"=>array(),
             
                               "telepro_profiles"=>null,
                              "sale_profiles"=>null,
                                         
                            /* for password generation */
                            "nb_uppercase"=>1,
                            "nb_numbers"=>2,
                            "nb_of_specific_chars"=>1,
                            "length_of_pass"=>8,
                            "list_of_specific_chars"=>"#'()@[]{}=+*/.!;?,:$&",
             
                             "default_team_id"=>null
                          ));
        
     }        
     
     function hasManager2()
     {
         return (boolean)($this->get('has_manager2')=='YES');
     }
     
     function hasCallCenter()
     {
        return (boolean)($this->get('has_callcenter')=='YES'); 
     }
     
     function getActivityTimer()
     {
         return $this->get('activity_timer',5 * 60 ) * 1000 ;  // 5 minutes
     }
     
     function getRefreshLogoutTimer()
     {
         return $this->get('logout_timer',15 ) * 1000 ;  // 15 seconds
     }
     
     
     function hasSaleGroups()
     {
          if ($this->get('sales_groups'))
            return !$this->getSaleGroups()->isEmpty();
          return false;
     }
     
     function getSaleGroups()
     {
          if ($this->sales_groups===null)
             $this->sales_groups=GroupUtils::getSaleGroupsByIdForSelect(new mfArray($this->get('sales_groups')),$this->getSite());        
         return $this->sales_groups;       
     }        
     
     function hasTeleproGroups()
     {
          if ($this->get('telepro_groups'))
                return !$this->getTeleproGroups()->isEmpty();
          return false;
     }
     
     function getTeleproGroups()
     {     
         if ($this->telepro_groups===null)
             $this->telepro_groups=GroupUtils::getTeleproGroupsByIdForSelect(new mfArray($this->get('telepro_groups')),$this->getSite());        
         return $this->telepro_groups;       
     }  
     
     
     function hasTeleproProfiles()
     {
         if ($this->get('telepro_profiles'))           
            return !$this->getTeleproProfiles()->isEmpty();        
         return false;
     }
     
     function getTeleproProfiles()
     {              
         return $this->telepro_profiles=$this->telepro_profiles===null?UserProfile::getProfilesFromSelectionForSelect(new mfArray($this->get('telepro_profiles')),$this->getSite()):$this->telepro_profiles;                 
     } 
     
     function hasSaleProfiles()
     {
         if ($this->get('sale_profiles'))         
             return !$this->getSaleProfiles()->isEmpty();          
         return false;
     }
     
     function getSaleProfiles()
     {     
         return $this->sale_profiles=$this->sale_profiles===null?UserProfile::getProfilesFromSelectionForSelect(new mfArray($this->get('sale_profiles')),$this->getSite()):$this->sale_profiles;                 
     } 
     
     
     function getOptionsForValidator()
    {
        $options = array();        
        foreach(array("nb_uppercase"=>"number_of_special","nb_numbers"=>"number_of_digit","nb_of_specific_chars"=>"number_of_upper",
                      "length_of_pass"=>"max_length","length_of_pass"=>"min_length","list_of_specific_chars"=>"special_list") as $value=>$option)
        {
            $option[$option] = $this->get($value);
        }
        return $options;
    }
    
    function hasDefaultTeam()
    {        
        return $this->get('default_team_id')?$this->getDefaultTeam()->isLoaded():false;
    }
    
    function getDefaultTeam()
    {
        return $this->default_team_id=$this->default_team_id===null?new UserTeam($this->get('default_team_id')):$this->default_team_id;
    }
}
