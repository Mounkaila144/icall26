<?php

class PartnerPolluterCompanyArchive extends ZipArchive {
    
    protected $polluter=null;
    
    function __construct(DomoprimePollutingCompany $polluter) {
        $this->polluter=$polluter;
         mfFileSystem::mkdirs($this->getPath());      
    }
       
    function getPolluter()
    {
        return $this->polluter;
    }
    
    function getTempPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/exports/".$this->getPolluter()->get('id')."/items";
    }
    
    function getPath()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/exports/".$this->getPolluter()->get('id')."/archive";
    }
    
    function getName()
    {
        return "archive.zip";//$this->getPolluter()->getNameAlphaNum("-").".zip";
    }
    
    function getFilename()
    {
        return $this->getPath()."/".$this->getName();
    }
    
    function process()
    {     
        // Objects  Class/Pricing/Recipient/devis/facture
        $xml= new XMLObject($this->getPolluter(),array('path'=>$this->getTempPath(),'name'=>'polluter'));
        $xml->save();             
        if ($res=$this->open($this->getFilename(), ZipArchive::CREATE|ZipArchive::OVERWRITE)===false)                
            return false;        
        $this->addFile($xml->getFilename(),$xml->getName());
        if ($this->getPolluter()->hasLogo())
            $this->addFile($this->getPolluter()->getLogo()->getFile(),'img/polluter/'.$this->getPolluter()->get('logo'));  
        if ($this->getPolluter()->hasPicture())
            $this->addFile($this->getPolluter()->getPicture()->getFile(),'img/polluter/'.$this->getPolluter()->get('picture'));  
        if ($this->getPolluter()->hasSignature())
            $this->addFile($this->getPolluter()->getSignature()->getFile(),'img/polluter/'.$this->getPolluter()->get('signature'));  
        if ($this->getPolluter()->hasRecipient())
        {    
            if ($this->getPolluter()->getRecipient()->hasLogo())
                $this->addFile($this->getPolluter()->getRecipient()->getLogo()->getFile(),'img/recipient/'.$this->getPolluter()->getRecipient()->get('logo'));  
            if ($this->getPolluter()->getRecipient()->hasSignature())
                $this->addFile($this->getPolluter()->getRecipient()->getSignature()->getFile(),'img/recipient/'.$this->getPolluter()->getRecipient()->get('signature')); 
        }            
        $pricings_xml= new XMLObjectCollection('pricing',$this->getPolluter()->getPricings(),array('path'=>$this->getTempPath(),'name'=>'pricings'));        
        $pricings_xml->save();  
        $this->addFile($pricings_xml->getFilename(),$pricings_xml->getName());
        // model pdf
        $models_xml= new XMLObjectCollection('model',PartnerPolluterModelUtils::getModelsForPolluter($this->getPolluter()),array('path'=>$this->getTempPath(),'name'=>'models'));
        $models_xml->save();       
        $this->addFile($models_xml->getFilename(),$models_xml->getName());
        foreach ($models_xml->getValue()->getFiles() as $item)                                  
           $this->addFile($item->getFile()->getFile(),'models/'.$item->get('id')."/".(string)$item->getFile());    
        // documents
        $documents_xml= new XMLObjectCollection('document',$this->getPolluter()->getDocuments(),array('path'=>$this->getTempPath(),'name'=>'documents'));
        $documents_xml->save();            
        $this->addFile($documents_xml->getFilename(),$documents_xml->getName());
        
       // premeeting pdf file
        $premeeting_document=new DomoprimePolluterPreMeeting($this->getPolluter());
        if ($premeeting_document->isLoaded())
        {
            if ($premeeting_document->getModel()->getI18n()->isLoaded())
            {    
                if ($premeeting_document->getModel()->getI18n()->getFile()->isExist())
                     $this->addFile($premeeting_document->getModel()->getI18n()->getFile()->getFile(),'premeetings/'.$premeeting_document->getModel()->getI18n()->get('id')."/".(string)$premeeting_document->getModel()->getI18n()->getFile());                                  
            }
        }
        $after_document=new DomoprimePolluterAfterWork($this->getPolluter());
        if ($after_document->isLoaded())
        {
            if ($after_document->getModel()->getI18n()->isLoaded())
            {
                if ($after_document->getModel()->getI18n()->getFile()->isExist())
                    $this->addFile($after_document->getModel()->getI18n()->getFile()->getFile(),'afterworks/'.$after_document->getModel()->getI18n()->get('id')."/".(string)$after_document->getModel()->getI18n()->getFile());                                  
            }
        }
        
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'app.domoprime.polluter.export')); 
        $this->close();
        return $this;
    }
 
    
    function delete()
    {
        unlink($this->getFilename());
        return $this;
    }
}
