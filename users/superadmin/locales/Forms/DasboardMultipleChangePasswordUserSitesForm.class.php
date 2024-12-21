<?php



class DasboardMultipleChangePasswordUserSitesForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {              
        $this->setValidators(array(           
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),            
        ));           
    }
          
    
    function getSelection()
    {
        return new mfArray((array)$this['selection']->getValue());
    }
    
    function getSites()
    {
        if ($this->sites===null)
        {
            $this->sites=SiteUtils::getSitesBySites($this['selection']->getValue());
        }  
        return $this->sites;
    }
     
}