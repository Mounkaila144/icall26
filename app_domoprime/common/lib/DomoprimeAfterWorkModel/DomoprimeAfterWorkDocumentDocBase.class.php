<?php

class DomoprimeAfterWorkDocumentDocBase  {
    
    protected $model=null,$contract=null,$action=null,$site=null;
    public       $data=null;
    
    function __construct(CustomerContract $contract,PartnerPolluterModel $model)
    {        
       $this->model=$model;
       $this->contract=$contract;
       $this->data=new mfArray();
       $this->site=$contract->getSite();      
    }
    
    function getSite()
    {
        return $this->site;
    }
    
   /* function getPath()
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
    }*/
    
    
    function getModel()
    {
        return $this->model;
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
    function getTempDirectory()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/data/docx/".$this->contract->get('id')."/models/".$this->getModel()->get('id');
    }
     
    function getDocxDirectory()
    {
        return $this->getTempDirectory()."/docx";
    }
    
    function getDocx()
    {
        return $this->docx=$this->docx===null?new File($this->getTempDirectory()."/model.docx"):$this->docx;
    }
    
    function getPdf()
    {
        return $this->office->getOutput();
    }
    
    function save()
    {                     
        // Copy model
        mfFileSystem::xcopy($this->getModel()->getI18n()->getDocxFile()->getFile(),$this->getDocxDirectory());  
        // Get data / mapping
        $this->action= mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
        CustomerMeetingFormDocumentParameters::loadParametersForDocumentPdf($this->getContract(),$this->action);        
        if (mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true')
        {    
            echo "<pre> PRE MEETING ";        var_dump($this->action->getVariables()->flatten()); echo "</pre>"; die();                    
        }
        $values=new mfArray();
        foreach ($this->getModel()->getI18n()->getMapping() as $field=>$name)
            $values[$field]=$this->action->getVariables()->flatten()->getItemByKey($name);           
        // Create Word
        $injector=new MicrosoftDocxInjector(new File($this->getDocxDirectory()),$values);
        $injector->save();
        
        $this->zip = new MicrosoftArchiveDocx($this->getTempDirectory()."/model.docx");
        if ($this->zip->open() !== true)
             return $this;        
        foreach (glob($this->getDocxDirectory()."/*") as $file)
        {            
            if (is_dir($file))
            {                                            
                  $this->zip->addDir($file,$this->getTempDirectory()."/docx/");
            }   
            else
            {
                 $this->zip->addFile($file,str_replace($this->getTempDirectory()."/docx/",'',$file));                
            }     
        }        
        $this->zip->save();
        // pdf
        $this->office = new SystemLibreOffice(array('--headless','--convert-to','pdf'));
        $this->office->setFile(new File($this->getTempDirectory()."/model.docx"));
        $this->office->setOutput(new File(mfConfig::get('mf_site_app_cache_dir')."/data/pdf/libreoffice/models/".$this->getModel()->get('id')."_".session_id()."/model.pdf"));
        $this->office->execute();                  
        return $this;
    }
    
  
    
}

