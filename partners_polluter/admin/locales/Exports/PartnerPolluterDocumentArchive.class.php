<?php

 
class PartnerPolluterDocumentArchive  extends ZipArchive {
  
    
protected $polluter=null,$selection=null;
    
    function __construct(DomoprimePollutingCompany $polluter,PartnerPolluterDocumentCollection $selection) {
        $this->polluter=$polluter;
        $this->selection=$selection;
         mfFileSystem::mkdirs($this->getPath());            
    }
    
    function getPolluter()
    {
        return $this->polluter;
    }
    
   /* function getTempPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/exports/".$this->getPolluter()->get('id')."/items";
    }*/
    
    function getPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/exports/polluters/".$this->getPolluter()->get('id')."/archive/documents";
    }
    
    function getName()
    {
        return $this->getPolluter()->getNameAlphaNum("-")."-".__("documents").".zip";//$this->getPolluter()->getNameAlphaNum("-").".zip";
    }
    
    function getFilename()
    {
        return $this->getPath()."/".$this->getName();
    }
    
    function getSelection()
    {
        return $this->selection;
    }
    
    function process()
    {     
         if ($res=$this->open($this->getFilename(), ZipArchive::CREATE|ZipArchive::OVERWRITE)===false)                
            return false;    
         $settings= new DomoprimeIsoSettings();
         $collection = new CustomerMeetingFormDocumentCollection();
         foreach (array('101_R1','101_R2',
                        '102_R1', '102_R2',
                        '103_R1', '103_R2',
                        '101_102_R1','101_102_R2',
                        '101_103_R1','101_103_R2',
                        '102_103_R1','102_103_R2',
                        '101_102_103_R1','101_102_103_R2',
             
                        '101_R1_classic', '101_R2_classic',
                        '102_R1_classic', '102_R2_classic',
                        '103_R1_classic', '103_R2_classic',
                        '101_102_R1_classic','101_102_R2_classic',
                        '101_103_R1_classic','101_103_R2_classic',
                        '102_103_R1_classic','102_103_R2_classic',
                        '101_102_103R1_classic','101_102_103_R2_classic',
                       ) as $model_name)
         {
             if (!$settings->get("model_".$model_name."_id"))
                 continue;             
             $method='get'.str_replace(" ","",ucwords(str_replace("_"," ",$model_name))).'Model';             
             if (!method_exists($settings,$method))
                     continue;
             $form_document=$settings->$method();
             if ($form_document->isNotLoaded())
                 continue;
             $form_document->set('model_name',$model_name);
             $collection[$form_document->get('id')]=$form_document;            
         }              
         foreach (PartnerPolluterDocumentUtils::getDocumentsForPolluterFromDocumentSelection($this->getPolluter(),$collection) as $document)
        {             
          if (!$document->getModel()->hasI18n())
                continue;
          if (!$document->getModel()->getI18n()->hasFile())
              continue;
           $xml=new PartnerPolluterDocumentXML($document);
           $xml->save();          
           $this->addFile($xml->getFilename(),$xml->getName());              
           $this->addFile($document->getModel()->getI18n()->getFile()->getFile(),$document->getEscapedValue().".".$document->getModel()->getI18n()->getFile()->getExtension());                        
        }             
        $this->close();
        return $this;
    }
 
    
   
}

