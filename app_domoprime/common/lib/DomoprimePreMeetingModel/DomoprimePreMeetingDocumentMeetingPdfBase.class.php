<?php

class DomoprimePreMeetingDocumentMeetingPdfBase extends SystemPdftk {
    
    protected $model=null,$meeting=null,$action=null,$site=null;
    public        $data=null;
    
    function __construct(CustomerMeeting $meeting,DomoprimePreMeetingModel $model)
    {        
       $this->model=$model;
       $this->meeting=$meeting;
       $this->data=new mfArray();
       $this->site=$meeting->getSite();
       parent::__construct(array('fill_form'),array('flatten'));    
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getPath()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->meeting->getSiteName()."/frontend/data/meetings/".$this->meeting->get('id');
    }
    
    function getFilename()
    {
        
        return $this->getPath()."/".$this->model->getNameWithExtension();
    }
    
     function getFile()
    {
        return new File($this->getFilename());
    }
    
    
    function getModel()
    {
        return $this->model;
    }
    
    function getMeeting()
    {
        return $this->meeting;
    }
    
    function getData()
    {
        return $this->data;
    }
    
    function getAction()
    {
        return $this->action;
    }
    
    function save()
    {        
        $this->setOutput($this->getFilename());        
        $this->addFile($this->getModel()->getI18n()->getFile()->getFile());
        $this->action= mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
        CustomerMeetingFormDocumentParameters::loadParametersForDocumentForMeetingPdf($this->getMeeting(),$this->action);                 
        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'customers.meeting.premeeting.document.build.pdf'));   
        
        $this->setDataForForm($this->action->getVariables()->flatten($this->getModel()->getI18n()->getVariablesOfFile()));                
                
        if (mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true' && mfcontext::getInstance()->getUser()->hasCredential(array('superadmin_debug')))
        {
           echo "<pre>"; var_dump($this->action->getVariables()->flatten()); echo "</pre>"; die(__METHOD__); 
        }           
        $this->execute();    
        return $this;
    }
    
 /*   function getSignatures()
    {
        return $this->getDocument()->getModel()->getI18n()->getSignatures();
    }
    
     function getSignature()
    {
        return $this->getDocument()->getModel()->getI18n()->getSignatures()->getFirst();
    }*/
    
}

