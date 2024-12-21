<?php


class PartnerPolluterModelCollectionXmlExtractor extends  XmlFileToObject {
   
    
     function getPicturePath()
    {
        return $this->getPath()."/models/img";
    }    
    
     function getModelPath()
    {
        return $this->getPath()."/models";
    } 
    
    function getXmlFile()
    {
        return "models.xml";
    }
    
    function getPolluter()
    {
        return $this->object;
    }      
    
    function extract()
    {               
       if (!$this->toArray())
          return $this;  
       $collection=new PartnerPolluterModelCollection(null,$this->getSite());       
       if (count($this->toArray()->getValue('model'))==1)
       {               
           $item=new PartnerPolluterModel(null,$this->getSite());
           $item->set('polluter_id',$this->getPolluter());
           $item->add($this->toArray()->getValue('model'));
           $collection[0]=$item;         
       }
       else
       {               
            foreach ($this->toArray()->getValue('model') as $index=>$model)
            {               
               $item=new PartnerPolluterModel(null,$this->getSite());
               $item->set('polluter_id',$this->getPolluter());
               $item->add($model);
               $collection[$index]=$item;
            }
       }
     // echo "<pre>"; var_dump($collection);     die(__METHOD__);
       $collection->save();
        
       $translation=new mfArray();
       if (count($this->toArray()->getValue('model'))==1)
       {  
             $translation[(string)$this->toArray()->getValue('model')->id]=$collection[0]->get('id');
       }
       else 
       {    
          foreach ($this->toArray()->getValue('model') as $index=>$model)            
                $translation[(string)$model->id]=$collection[$index]->get('id');
       }
       
       $collection_i18n=new PartnerPolluterModelI18nCollection(null,$this->getSite());
       if (count($this->toArray()->getValue('model'))==1)
       {  
           $item=new PartnerPolluterModelI18n(null,$this->getSite());
           $item->set('model_id',$collection[0]->get('id'));
           $item->add((array)$this->toArray()->getValue('model')->i18n);
           $collection_i18n[]=$item;    
       }
       else
       {    
            foreach ($this->toArray()->getValue('model') as $index=>$model)
            {         
               $item=new PartnerPolluterModelI18n(null,$this->getSite());
               $item->set('model_id',$collection[$index]->get('id'));
               $item->add((array)$model->i18n);         
               $collection_i18n[$index]=$item;
            }
       }
       $collection_i18n->save(); 
    
       if (count($this->toArray()->getValue('model'))==1)
       {
                $model=new File($this->getModelPath()."/".(string)$this->toArray()->getValue('model')->i18n->id."/model.pdf");
                $model->copy($collection_i18n[0]->getDirectory());  
       }
       else
       {
            foreach ($this->toArray()->getValue('model') as $index=>$model)
            {           
                $model=new File($this->getModelPath()."/".(string)$model->i18n->id."/model.pdf");
                $model->copy($collection_i18n[$index]->getDirectory());
            }   
       }
      // Documents
       $documents_xml=new PartnerPolluterDocumentCollectionXmlExtractor($this->getPolluter(),$translation,$this->getPath());
       $documents_xml->extract();     
       return $this;                        
    }
}
