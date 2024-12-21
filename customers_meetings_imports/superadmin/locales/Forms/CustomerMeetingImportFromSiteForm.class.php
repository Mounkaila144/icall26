<?php

class CustomerMeetingImportFromSiteForm extends mfForm {

    protected $user=null;
    
    function __construct($user,$defaults = array()) {
        $this->user=$user;
        parent::__construct($defaults);
    }
    
    function getUser()
    {
        return $this->user;
    }

    function configure() { 
      // $this->setDefaults(array('creation_at'=>array('from'=>'2016-05-02','to'=>'2016-05-05')));
       $this->setValidators(array(
             "creation_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
             "site_id"=>new mfValidatorChoice(array('choices'=>SitesAdmin::getSitesByHostForSelect(),'key'=>true))
       ));
    }
    
   function getSiteSource()
   {
       return new Site($this['site_id']->getValue());
   }
    
}