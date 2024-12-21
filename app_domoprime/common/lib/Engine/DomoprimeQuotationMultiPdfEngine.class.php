<?php

class DomoprimeQuotationMultiPdfEngine   {
    
    protected $quotation=null,$model=null,$polluter_quotation_model=null,$options=array(),$files=null,$engine=null;
    
    function __construct($model,$quotation,$polluter_quotation_model,$options=array())
    {        
       $this->quotation=$quotation;
       $this->model=$model;                  
       $this->options=$options;
       $this->polluter_quotation_model=$polluter_quotation_model;
       $this->files=new mfArray();
       $this->settings=new SystemPdfEngine($this->getSite());
       $this->engine=null;
    }
    
    function setEngine($engine)
    {
        $this->engine=$engine;
        return $this;
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
    function hasEngine()
    {
        return (boolean)$this->engine;
    }
    
     function getSettings()
     {
         return $this->settings;
     }
    
    function getSite()
    {
        return $this->getQuotation()->getSite();
    }
    
    function getQuotation()
    {
        return $this->quotation;
    }    
    
    function getModel()
    {
        return $this->model;
    }     
    
    function getPolluterModel()
    {
        return $this->polluter_quotation_model;
    }
    
    function save()
    {
       return $this->output(); 
    }
    
    function  output()
    {
        $this->process();
        $this->pdf->output();
        return $this;
    }
    
    function forceOutput()
    {
        $this->process();
        if ($this->pdf)
        {    
            $this->pdf->forceOutput();
            return $this;
        }                 
        $this->merge();
        $this->pdf=$this->getOutput();
        
        mfContext::getInstance()->getResponse()
             ->setHttpHeader('Cache-Control: no-cache, must-revalidate')
             ->setHttpHeader('Content-disposition',' inline; filename="'.$this->getOutput()->getName().'"')   
            
             ->sendFile($this->getOutput()->getFile());   
        die();
        return $this;
    }
    
    function getPdf()
    {
        return $this->pdf;
    }
        
    function getFile()
    {
        return $this->getPdf()->getFile();
    }
    
    function getFiles()
    {
        return $this->files;
    }
    
    function  process()
    {                      
        $class=$this->getSettings()->getPdfEngine()=='pdf2'?"DomoprimeQuotationPDF2":"DomoprimeQuotationPDF";           
        if (!class_exists($class))
            throw new mfException(__("PDF engine is invalid"));
        if ($this->getPolluterModel()->hasPreModel() || $this->getPolluterModel()->hasPostModel())
        {          
            if ($this->getPolluterModel()->hasPreModel())
            {    
               if ($this->getPolluterModel()->getPreModel()->getI18n()->isDocx())
               {
                     $doc=new DomoprimeQuotationDoc($this->getQuotation(),$this->getPolluterModel()->getPreModel());
                     $doc->save(); 
                     $this->files[]=$doc->getPdf()->getFile();
               }
               elseif ($this->getPolluterModel()->getPreModel()->getI18n()->isPdf())
               {
                   if ($this->getPolluterModel()->getPreModel()->getI18n()->hasVariables())
                   {
                        $pdf=new DomoprimeQuotationDocumentPolluterModelPdf( $this->getQuotation()->getContract(),$this->getPolluterModel()->getPreModel());
                        $pdf->save();                          
                        $this->files[]=$pdf->getFilename();
                   }
                   else
                   {
                       $this->files[]=$this->getPolluterModel()->getPreModel()->getI18n()->getFile()->getFile();
                   }
                   
               }   
               else
               {
                   die('PRE MODEL NOT SUPPORTED');
               } 
            }
            
            if ($this->hasEngine())
            {
                $this->getEngine()->save();
                $this->files[]= $this->getEngine()->getFile()->getFile();
            }   
            else
            {    
                $pdf = new $class($this->getModel(),$this->getQuotation());    
                $pdf->save();
                $this->files[]=$pdf->getFile()->getFile();
            }           
             
            if ($this->getPolluterModel()->hasPostModel())
            {                
                if ($this->getPolluterModel()->getPostModel()->getI18n()->isDocx())
               {
                     $doc=new DomoprimeQuotationDoc($this->getQuotation(),$this->getPolluterModel()->getPostModel());
                     $doc->save(); 
                     $this->files[]=$doc->getPdf()->getFile();
               }
               elseif ($this->getPolluterModel()->getPostModel()->getI18n()->isPdf())
               {
                   if ($this->getPolluterModel()->getPostModel()->getI18n()->hasVariables())
                   {
                        $pdf=new DomoprimeQuotationDocumentSiteModelPdf( $this->getQuotation()->getContract(),$this->getPolluterModel()->getPostModel());
                        $pdf->save();                          
                        $this->files[]=$pdf->getFilename();
                   }
                   else
                   {
                       $this->files[]=$this->getPolluterModel()->getPostModel()->getI18n()->getFile()->getFile();
                   }
                  // die(__METHOD__.__LINE__);                 
               }      
               else
               {
                   die('POST MODEL NOT SUPPORTED');
               }    
            }             
            return $this;
        }          
        $this->pdf = new $class($this->getModel(),$this->getQuotation());           
        return $this;
    }
    
    function getFilename()
    {                         
        return $this->getQuotation()->getFilenameForPdf();
    }
    
    function getOutputPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/data/contracts/quotations/".$this->getQuotation()->get('id');
    }       
    
    function getOutput()
    {
        return $this->output=$this->output===null?new File($this->getOutputPath()."/".$this->getQuotation()->getName()):$this->output;
    }
    
    function merge()
    {       
        if (!mfModule::isModuleInstalled('system_resources',$this->getSite()))
          throw new mfException(__("Resource module is missing."));
        if (!SystemResourceSettings::load($this->getSite())->hasResource('ghostsript'))
          throw new mfException(__("Resource 'ghostscript' is missing."));        
        mfFileSystem::mkdirs($this->getOutput()->getDirectory());
        $merger=new SystemGhostScript();        
        $merger->setOutput($this->getOutput()->getFile());
        $merger->setFiles($this->getFiles());
        $merger->execute();            
        if ($merger->hasErrors())
            throw new mfException(__("Merge has some errors."));                      
    }
}

