<?php

class CustomerMeetingImportForm extends mfForm {

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
        $this->setDefaults(array(
            'mode'=>'normal',
            'has_header'=>'YES')
                );          
        $settings=CustomerMeetingSettings::load();
        $this->setValidators(array(              
            'file'=>new mfValidatorFile(array('max_size'=>5 * 1024 *1024,'mime_types'=>array( 'text/plain','text/csv','text/x-c', 'text/comma-separated-values', /* 'application/zip' */))),                                
            'format_id'=>new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerMeetingImportFormat::getFormatForSelect())),
            'has_header'=>new mfValidatorBoolean(array('empty_value'=>'YES','true'=>'YES','false'=>'NO')),
            'mode'=>new mfValidatorChoice(array('key'=>true,'choices'=>array('debug'=>__('Debug'),'normal'=>__('Normal')))),//,'empty_value'=>'normal'
            ));      
        if ($settings->hasCampaign())
            $this->setValidator('campaign_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No campaign"))+CustomerMeetingUtils::getCampaignForSelect())));
        if ($settings->hasCallcenter() && $this->getUser()->hasCredential(array(array('superadmin','admin','meeting_import_callcenter'))))
            $this->setValidator('callcenter_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No callcenter"))+Callcenter::getCallcenterForSelect())));
    }
    
    function hasFormats()
    {
        return (count($this->format_id->getOption('choices'))!=0);
    }
    
    
}
