<?php

class UserProfileXML  extends XMLObject {
    
    
    
    function __construct(UserProfile $profile, $options = array()) {
        parent::__construct($profile, $options);
        $this->setOption('path', mfConfig::get('mf_site_app_cache_dir')."/exports/profile/".$profile->get('id'));
        $this->setOption('name','module');
    }
   
    
    function getName()
    {
        
        //var_dump($this->getItem()->getEscapedValue());die(__METHOD__);
        return $this->getItem()->getI18n()->getEscapedValue().".xml";
    }
    
    function toXML()
    {         
        $this->output='<profile>';           
        $this->output.='<name>'.$this->getItem()->get('name').'</name>'; 
        $this->output.='<i18n>'; 
            $this->output.='<value>'.$this->getItem()->getI18n()->get('value').'</value>'; 
            $this->output.='<lang>'.$this->getItem()->getI18n()->get('lang').'</lang>'; 
        $this->output.='</i18n>'; 
        $groups=$this->getItem()->getFunctionsAndGroupsWithPermissionsForProfile();
        $this->output.='<functions>'; 
        foreach ($this->getItem()->getFunctionsList() as $function)
        {
            $this->output.='<function>'; 
            $this->output.="<name>".$function->get('name')."</name>";                                     
            $this->output.='<i18n>'; 
            $this->output.='<value>'.$function->getI18n()->get('value').'</value>'; 
            $this->output.='<lang>'.$function->getI18n()->get('lang').'</lang>'; 
            $this->output.='</i18n>';       
            $this->output.='</function>'; 
        }
        $this->output.='</functions>';
        $this->output.='<groups>'; 
        foreach ($groups as $group)
        {              
                $this->output.='<group>';  
                    foreach (array('is_active','name') as $field){
                        $this->output.=sprintf("<%s>%s</%s>",$field,$group->get($field),$field);
                    }
                    $this->output.='<permissions>'; 
                        foreach ($group->getPermissionsList() as $permission)
                        {
                            $this->output.='<permission>'.$permission->get('name').'</permission>'; 
                        }
                    $this->output.='</permissions>'; 
                $this->output.='</group>';             
        }  
        $this->output.='</groups>';    
        $this->output.='</profile>';      
        return $this;
    }
}
