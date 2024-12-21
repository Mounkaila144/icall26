<?php


class PartnerPolluterDocumentCollectionXmlExtractor extends  XmlFileToObject {
   
    function __construct($object,$translation,$path, $options = null,$site=null) {                
        $this->translation=$translation;
        parent::__construct($object,$path, $options,$site);               
    }
    
    
    function getXmlFile()
    {
        return "documents.xml";
    }
    
    function getPolluter()
    {
        return $this->object;
    }
    
     function setValuesFromXML($xml)
    {        
        $this->values=$xml->document;
        return $this;
    }
    
    function getTranslation()
    {
        return $this->translation;
    }
        
    
    function extract()
    {         
     $names=new mfArray();          
     foreach ($this->toArray()  as $model)       
         $names[]=(string)$model->document->name;                  
     $documents=CustomerMeetingFormDocument::getDocumentsByNames($names);    
     $collection = new PartnerPolluterDocumentCollection(null,$this->getSite());
     foreach ($this->toArray()  as $document)   
     {
         $item=new PartnerPolluterDocument(null,$this->getSite());         
         $item->add(array('model_id'=>$this->translation[(int)$document->model],
                        'document_id'=>$documents[(string)$document->document->name],
                        'polluter_id'=>$this->getPolluter()));
        $collection[]=$item; 
     }   
     $collection->save();     
     return $this;                        
    }
}
