<?php

class DomoprimeQuotationDocBase  {
    
    protected $model=null,$quotation=null,$action=null,$site=null;
    public       $data=null;
    
    function __construct(DomoprimeQuotation $quotation,PartnerPolluterModel $model)
    {        
       $this->model=$model;
       $this->quotation=$quotation;
       $this->data=new mfArray();
       $this->site=$quotation->getSite();      
    }
    
    function getSite()
    {
        return $this->site;
    }
     
    
    function getModel()
    {
        return $this->model;
    }
    
    function getQuotation()
    {
        return $this->quotation;
    }
    
    function getContract()
    {
        return $this->getQuotation()->getContract();
    }
    
    function getTempDirectory()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/data/docx/quotations/".$this->getQuotation()->get('id')."/models/".$this->getModel()->get('id');
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
    
    function getPictures()
    {
        return $this->pictures;
    }
    
    function injectPictures()
    {
        foreach ($this->getPictures() as $name=>$picture)
        {
            $path=explode('.',$picture);   
            if ($path[0]=='company')
            {              
              $company=$this->getQuotation()->getContract()->hasCompany()?$this->getQuotation()->getContract():SiteCompanyUtils::getSiteCompany($this->getSite());                                       
              foreach (array('stamp','header','footer','picture','signature') as $field)
              {
                  $method='has'.ucfirst($field);
                  if ($path[1]==$field && $company->$method())
                  {
                        $method='get'.ucfirst($field);
                       $file=new File($company->$method()->getFile());                 
                       $file->copy($this->getDocxDirectory()."/word/media/",$name);
                  }    
              }                           
            }             
        }            
        return $this;
    }
    
    function save()
    {                     
        // Copy model
        mfFileSystem::xcopy($this->getModel()->getI18n()->getDocxFile()->getFile(),$this->getDocxDirectory());  
        // Get data / mapping
        $this->action= mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();        
        $this->action->quotation_base=$this->getQuotation();   
        $this->action->setParameter('quotation',$this->getQuotation());
        DomoprimeQuotationModelParameters::loadParametersForQuotation($this->getQuotation(),$this->action);                         
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->action, 'app_domoprime.quotation.build'));               
        if (mfContext::getInstance()->getRequest()->getGetParameter('debug')=='true')
        {               
            echo "<pre>"; var_dump($this->action->getVariables()->flatten());            
            die();
        }      
        $values=new mfArray();
        $this->pictures=new mfArray();
        foreach ($this->getModel()->getI18n()->getMapping() as $field=>$name)
        {    
            $values[$field]=(string)$this->action->getVariables()->flatten()->getItemByKey($name);              
            if (in_array(pathinfo($field,PATHINFO_EXTENSION),array('png','jpeg')))
                  $this->pictures[$field]=$name;
        }
        $this->injectPictures();               
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
        $this->office->setOutput(new File(mfConfig::get('mf_site_app_cache_dir')."/data/pdf/libreoffice/models/".$this->getModel()->get('id')."/".mfTools::generatePassword()."/model.pdf"));
        $this->office->execute();                            
        return $this;
    }
    
  
    
}

