<?php

class DomoprimePreMeetingDocumentPdfBase extends SystemPdftk {
    
    protected $model=null,$contract=null,$action=null,$site=null;
    public       $data=null;
    
    function __construct(CustomerContract $contract,DomoprimePreMeetingModel $model)
    {        
       $this->model=$model;
       $this->contract=$contract;
       $this->data=new mfArray();
       $this->site=$contract->getSite();
       parent::__construct(array('fill_form'),array('flatten'));    
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getPath()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->contract->getSiteName()."/frontend/data/contracts/".$this->contract->get('id');
    }
    
    function getFilename()
    {
        
        return $this->getPath()."/".$this->model->getNameWithExtension();
    }
    
     function getFile()
    {
        return new File($this->getFilename());
    }
    
    function getName()
    {
        return $this->model->getNameWithExtension();
    }
    
    
    function getModel()
    {
        return $this->model;
    }
    
    function getContract()
    {
        return $this->contract;
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
        CustomerMeetingFormDocumentParameters::loadParametersForDocumentPdf($this->getContract(),$this->action);                 
        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'customers.meeting.document.form.build.pdf'));   
        
        $this->setDataForForm($this->action->getVariables()->flatten($this->getModel()->getI18n()->getVariablesOfFile()));                
                
        if (mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true' && mfcontext::getInstance()->getUser()->hasCredential(array('superadmin_debug')))
        {
           echo "<pre> PRE MODEL "; var_dump($this->action->getVariables()->flatten()); echo "</pre>"; die(__METHOD__); 
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
    
    
    function hasPolluter()
    {
        return $this->getContract()->hasPolluter();
    }
    
    function getPolluter()
    {
        return $this->getContract()->getPolluter();
    }
    
}

