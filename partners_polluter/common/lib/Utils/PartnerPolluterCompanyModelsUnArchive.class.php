<?php

class PartnerPolluterCompanyModelsUnArchive extends ZipArchive {
    
    protected $polluter=null,$path = null,$site=null,$errors=null,$number_of_documents=0,$number_of_models=0,$documents=null;

    function __construct($file,PartnerPolluterCompany $polluter,$site=null) {
        $this->site=$site;
        $this->polluter=$polluter;
        $this->file=is_string($file)?$file:$file->getTempName();          
        mfFileSystem::mkdirs($this->getPath());
        $this->site=$polluter->getSite();
        $this->settings=new DomoprimeIsoSettings(null,$this->getSite());
        $this->errors=new mfArray();
        $this->documents=new mfArray();
        $this->configure();
    }
    
    
    function getSettings()
    {
        return $this->settings;
    }

    function getSite()
    {
        return $this->site;
    }

    function configure()
    {
        mfFileSystem::mkdirs($this->getPath());
        $res = $this->open($this->getFile());
        if($res === true){
            $this->extractTo($this->getPath());
            $this->close();
        }
        unlink($this->getFile());
        return $this;
    }
    
    function getPolluter()
    {
        return $this->polluter;
    }        

    function getFile()
    {
        return $this->file;
    }

    function getErrors()
    {
        return $this->errors;
    }

    function getPath()
    {
        return  $this->path===null ? mfConfig::get('mf_site_app_cache_dir')."/imports/".$this->getPolluter()->get('id')."/archives/".session_id() : $this->path;
    }

     function hasErrors()
     {
         return !$this->getErrors()->isEmpty();
     }

    function process()
    {       
        $this->number_of_documents=0;
        $this->number_of_models=0;        
        $files=new mfArray();       
        $collection=new PartnerPolluterModelCollection(null,$this->getSite());       
        foreach(glob($this->getPath()."/*.pdf") as $file) {     
            $file=new File($file);     
            $files[]=$file;      
            $item=new PartnerPolluterModel(null,$this->getSite());
            $item->set('name',$file->getName('pdf'));
            $item->set('polluter_id',$this->getPolluter());
            $collection[]=$item;
        }       
        $collection->save();
        $this->number_of_models=$collection->count();        
        $collection_i18n=new PartnerPolluterModelI18nCollection(null,$this->getSite());
        foreach ($collection as $index=>$item)
        {                               
            $item_i18n=new PartnerPolluterModelI18n();
            $item_i18n->set('file','model.pdf');
            $item_i18n->set('model_id',$item);                                               
            $item_i18n->fromXMLFile(new File($files[$index]->getDirectory()."/".$files[$index]->getName("pdf").".xml"));               
            $collection_i18n[]=$item_i18n;
        }
        $collection_i18n->save();                      
        // Files
        foreach ($collection_i18n as $index=>$item_i18n)
        {                             
            $item_i18n->loadVariablesFromFile();
            $files[$index]->copy($item_i18n->getFile()->getPath(),$item_i18n->get('file')) ;
            $item_i18n->loadVariablesFromFile();
        }   
        $collection_i18n->save();
        
         // MAJ les documents (model - settings)
        $collection_document=new PartnerPolluterDocumentCollection(null,$this->getSite());         
        foreach ($collection as $item)
        {                     
            $method = "get".strtoupper(str_replace("_", "", $item->get('name')))."Model";            
            if (!method_exists($this->getSettings(), $method))
            {               
                $this->errors[]=__("Document %s is invalid",$item->get('name'));   
                continue;
            }
            $this->documents[]=$item->get('name');
            $document= new PartnerPolluterDocument(array('document'=>$this->getSettings()->$method(),'polluter'=>$this->getPolluter()));
            $document->set('model_id',$item);
            $collection_document[]= $document;
        }    
        $collection_document->save();
        $this->number_of_documents=$collection_document->count();
        mfFileSystem::net_rmdir($this->getPath());
        $this->close();
    }

    function getNumberOfDocuments()
    {
        return $this->number_of_documents;
    }
    
    function getNumberOfModels()
    {
        return $this->number_of_models;
    }

    function getDocuments()
    {
        return $this->documents;
    }
}

