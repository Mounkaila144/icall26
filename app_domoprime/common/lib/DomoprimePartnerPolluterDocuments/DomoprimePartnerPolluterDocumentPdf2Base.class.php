<?php

class DomoprimePartnerPolluterDocumentPdf2Base extends SystemPdftk {
    
    protected $document=null,$contract=null,$action=null,$site=null;
    public       $data=null;
    
    function __construct(CustomerContract $contract,PartnerPolluterDocument $document)
    {        
       $this->document=$document;
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
        
        return $this->getPath()."/".$this->document->getNameWithExtension();
    }
    
     function getFile()
    {
        return new File($this->getFilename());
    }
    
    
    function getDocument()
    {
        return $this->document;
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
        $this->addFile($this->getDocument()->getModel()->getI18n()->getFile()->getFile());
        $this->action= mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
        CustomerMeetingFormDocumentParameters::loadParametersForDocumentPdf($this->getContract(),$this->action);                 
        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'customers.contract.document.build.pdf'));   
        
        $this->setDataForForm($this->action->getVariables()->flatten($this->getDocument()->getModel()->getI18n()->getVariablesOfFile()));                
                
        if (mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true' && mfcontext::getInstance()->getUser()->hasCredential(array('superadmin_debug')))
        {
           echo "<pre> Polluter PDF2 "; var_dump($this->action->getVariables()->flatten()); echo "</pre>"; die(__METHOD__); 
        }    
//echo "<pre>";        var_dump($this->action->getVariables()->flatten()); echo "</pre>"; die(__METHOD__);
        
        $this->execute();    
        return $this;
    }
    
    function getSignatures()
    {
        return $this->getDocument()->getModel()->getI18n()->getSignatures();
    }
    
     function getSignature()
    {
        return $this->getDocument()->getModel()->getI18n()->getSignatures()->getFirst();
    }
    
}

