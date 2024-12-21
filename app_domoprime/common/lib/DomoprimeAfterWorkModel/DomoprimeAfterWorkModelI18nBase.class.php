<?php

class DomoprimeAfterWorkModelI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','model_id','lang','file','variables','initiator_signature','signature','content','created_at','updated_at');
    const table="t_domoprime_after_work_model_i18n"; 
    protected static $foreignKeys=array('model_id'=>'DomoprimeAfterWorkModel'); // By default
    
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['model_id']))
              return $this->loadByLangAndModelId((string)$parameters['lang'],(string)$parameters['model_id']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         return $this->loadByEmail((string)$parameters);
      }   
    }
    
  /*  protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
     protected function loadByLangAndModelId($lang,$model_id)
    {
       $this->set('model_id',$model_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('model_id'=>$model_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND model_id='{model_id}';")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");      
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeIsExistQuery($db)    
    {
      
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('value'=>$this->get('value'),'lang'=>$this->get('lang'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE value='{value}' AND lang='{lang}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
    }
    
     protected function hasSibbling()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("model_id"=>$this->get('model_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE model_id={model_id};")
            ->makeSiteSqlQuery($this->site);  
        $row=$db->fetchRow();
        return ($row[0]!=0);      
    }      
    
    
     function delete()
    {
        parent::delete();              
        if (!$this->hasSibbling())
            $this->getModel()->delete();
        return $this;
    }  
   
     function getModel()
    {
       if (!$this->_model_id)
       {
          $this->_model_id=new DomoprimeAfterWorkModel($this->get('model_id'),$this->getSite());          
       }   
       return $this->_model_id;
    }    
    
    static function getName($name)
    {     
        return preg_replace('/[^abcdefghijklmnopqrstuvwxyz0123456789\.\-]/i', '-', str_replace(" ","-",mfTools::I18N_noaccent(strtolower($name))));
    }   
    
    function getValueForUrl()
    {
        return self::getName($this->get('value'));
    }
   
    function __toString() {
        return (string)$this->get('value');
    }
   
    
     public function getDirectory()
    {       
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/models/documents/domoprime/aftermodels/".$this->get('id');
    }        
    
    function setFile(mfValidatedFile $file)
    {                
        $this->set('file',"model.pdf"); 
        $file->setFilename("model");
        return $this;
    }
    
    function hasFile()
    {
        return (boolean)$this->get('file');
    }    
    
    function getFile()
    {       
        if ($this->_file===null)
        {
            $this->_file=new fileObject2(array(
                 "path"=>$this->getDirectory(),
                 "file"=>$this->get('file'),                                                             
              /*   "url"=>url_to('products_documents_file',array('file'=>$this->getFilename(),
                                                               'contract'=>$this->get('contract_id'),
                                                               'model'=>$this->get('product_model_id')
                                                              )),   */                        
             ));
        }   
        return $this->_file;
    }
    
    function getVariablesOfFile()
    {
        return new mfArray(explode("|",$this->get('variables')));
    }
    
    function loadVariablesFromFile()
    {         
        $pdf=new SystemPdftk(array('dump_data_fields'));
        $pdf->addFile($this->getFile()->getFile());
        $pdf->execute();
        $this->set('variables',$pdf->getFieldNames()->implode('|'));        
        return $this;
    }
    
    function toXML()
    {  
        $values = $this->toArray(array('value','variables','file','content','lang','created_at','updated_at','id')); 
        $values['body']="<![CDATA[".$this->get('content')."]]>";
        return  $values;
    }
       
    
       function hasSignatures()
    {
        return (boolean)$this->get('signature');
    }
    
    function getSignatures()
    {
        if ($this->_signature===null)
        {
            $this->_signature=new DomoprimeAfterWorkModelSignatureCollection($this->get('signature'));
        }
        return $this->_signature;
    }
    
    function hasInitiatorSignature()
    {
        return (boolean)$this->get('initiator_signature');
    }
    
    function getInitiatorSignature()
    {
        if ($this->_initiator_signature===null)
        {
            $this->_initiator_signature=new DomoprimeAfterWorkModelSignature($this->get('initiator_signature'));
        }
        return $this->_initiator_signature;
    }
    
    function getInitiatorSignatures()
    {
         if ($this->_initiator_signatures===null)
        {
            $this->_initiator_signatures=new DomoprimeAfterWorkModelSignatureCollection($this->get('initiator_signature'));
        }
        return $this->_initiator_signatures;
    }
    
     function toArrayForApi()
   {
        return $this->toArray(array('value','lang','initiator_signature','signature','created_at','updated_at'));                
    }
}
