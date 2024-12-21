<?php

class PartnerPolluterModelI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','comments','model_id','file','mapping','initiator_signature','signature','variables','lang','content','created_at','updated_at');
    const table="t_partner_polluter_model_i18n"; 
    protected static $foreignKeys=array('model_id'=>'PartnerPolluterModel'); // By default
    
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['lang']) && isset($parameters['model_id']))
              return $this->loadByLangAndModelId((string)$parameters['lang'],(string)$parameters['model_id']); 
        //  if (isset($parameters['lang']) && isset($parameters['polluter_id']))
       //       return $this->loadByLangAndPolluterId((string)$parameters['lang'],(string)$parameters['polluter_id']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
        // if ($parameters instanceof PartnerPolluterCompany) 
        //    return $this->loadbyCompany(parameters);
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);        
      }   
    }
    
    
      protected function loadByLangAndModelId($lang,$model_id)
    {
       $this->set('model_id',$model_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('model_id'=>$model_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND model_id={model_id};")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }
    
   /* protected function loadByCompany(PartnerPolluterCompany $polluter)
    {
         $this->set('polluter_id',$polluter);
         $db=mfSiteDatabase::getInstance()->setParameters(array('polluter_id'=>$polluter->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE polluter_id='{polluter_id}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
  /*   protected function loadByLangAndPolluterId($lang,$polluter_id)
    {
       $this->set('polluter_id',$polluter_id);
       $this->set('lang',$lang);
       $db=mfSiteDatabase::getInstance()           
            ->setParameters(array('polluter_id'=>$polluter_id,"lang"=>$lang))              
            ->setQuery("SELECT * FROM ".self::getTable().                      
                       " WHERE lang='{lang}' AND polluter_id='{polluter_id}';")
            ->makeSiteSqlQuery($this->site);  
        return $this->rowtoObject($db);
    }*/
    
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
      
        $key_condition=($this->getKey())?" AND ".self::getTableField('id')."!='%s';":"";
      $db->setParameters(array('value'=>$this->get('value'),'lang'=>$this->get('lang'),'polluter_id'=>$this->getModel()->get('polluter_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getTableField('id')." FROM ".self::getTable().
                    " INNER JOIN ".self::getOuterForJoin('model_id').
                    " WHERE value='{value}' AND lang='{lang}' AND polluter_id='{polluter_id}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);   
      //echo $db->getQuery();
    }
    
     protected function hasSibbling()
    {
        $db=mfSiteDatabase::getInstance()           
            ->setParameters(array("polluter_id"=>$this->getModel()->get('polluter_id')))              
            ->setQuery("SELECT count(id) FROM ".self::getTable().                      
                       " WHERE polluter_id={polluter_id};")
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
       
    
  
   
   /*  function getVariables($dictionnary='dictionary')
    {
        return array(
            'user.name'=>__('user','',$dictionnary),
            'user.firstname'=>__('user firstname','',$dictionnary),
            'user.lastname'=>__('user lastname','',$dictionnary),
            'user.mobile'=>__('user mobile','',$dictionnary),
            'user.phone'=>__('user phone','',$dictionnary),
            'user.courtesy'=>__('user courtesy','',$dictionnary),
            'user.gender'=>__('user gender','',$dictionnary),
            'customer.name'=>__('customer name','',$dictionnary),
            'customer.firstname'=>__('customer firstname','',$dictionnary),
            'customer.lastname'=>__('customer lastname','',$dictionnary),
            'customer.mobile'=>__('customer mobile','',$dictionnary),            
            'customer.phone'=>__('customer phone','',$dictionnary),
            'customer.courtesy'=>__('customer courtesy','',$dictionnary),
            'customer.gender'=>__('customer gender','',$dictionnary),
            'customer.address.full'=>__('customer address','',$dictionnary),
            'meeting.remarks'=>__('meeting remarks','',$dictionnary),
            'meeting.see_with'=>__('see with','',$dictionnary),         
        );
    } 
    
    function getVariablesSorted($dictionnary='dictionary')
    {
        $values=$this->getVariables($dictionnary);
        asort($values,SORT_FLAG_CASE|SORT_STRING);
        return $values;
    }*/
    
    function getVariables()
    {
        return $this->_variables=$this->_variables===null?new mfArray(explode("|",$this->get('variables'))):$this->_variables;
    }
    
   function getModel()
    {
       if (!$this->_model_id)
       {
          $this->_model_id=new PartnerPolluterModel($this->get('model_id'),$this->getSite());          
       }   
       return $this->_model_id;
    }    
    
    static function getName($name,$separator="-")
    {     
        return preg_replace('/[^abcdefghijklmnopqrstuvwxyz0123456789\.\-]/i', $separator, str_replace(" ","-",mfTools::I18N_noaccent(strtolower($name))));
    }   
    
    function getValueForUrl($separator="-")
    {
        return self::getName($this->get('value'),$separator);
    }
    
    function getValue()
    {
        return new mfString($this->get('value'));
    }
    
    function getEscapedValue()
    {     
        return preg_replace('/[^abcdefghijklmnopqrstuvwxyz0123456789\.\-]/i', "_", str_replace(" ","_",mfTools::I18N_noaccent($this->get('value'))));
    }
   
    function __toString() {
        return (string)$this->get('value');
    }
    
    
    public function getDirectory()
    {
       // return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/contracts/models/documents/products/".$this->get('id');
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/frontend/data/models/documents/polluters/".$this->get('id');
    }        
    
    function setFile(mfValidatedFile $file)
    {                        
        $this->set('file',"model.".($file->getExtension()=='pdf'?"pdf":"docx")); 
        $file->setFilename("model");
        return $this;
    }
    
    function hasFile()
    {
        return (boolean)$this->get('file');
    }    
    
    
    function getDocxFile()
    {
        return $this->doc_file=$this->doc_file===null?new File($this->getDirectory()."/docx"):$this->doc_file;
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
    
    
    function hasSignatures()
    {
        return (boolean)$this->get('signature');
    }
    
    function getSignatures()
    {
        if ($this->_signature===null)
        {
            $this->_signature=new PartnerPolluterModelSignatureCollection($this->get('signature'));
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
            $this->_initiator_signature=new PartnerPolluterModelSignature($this->get('initiator_signature'));
        }
        return $this->_initiator_signature;
    }
    
    function getInitiatorSignatures()
    {
         if ($this->_initiator_signatures===null)
        {
            $this->_initiator_signatures=new PartnerPolluterModelSignatureCollection($this->get('initiator_signature'));
        }
        return $this->_initiator_signatures;
    }
    
    
    function toXML()
    {
        return $this->toArray();              
    }
     
    
    function fromXMLFile(File $xml_file)
    {       
        $this->set('lang',"fr");
        if (!$xml_file->isExist())
        {
           $this->set('value',$this->getModel()->get('name'));           
        }
        elseif ($xml = simplexml_load_file($xml_file->getFile()))
        {                
            $data = $this->XmlToArray($xml);
            $this->set('value',$data['value']?$data['value']:$this->getModel()->get('name'));
            $this->set('initiator_signature',$data['initiator_signature']);
            $this->set('signature',$data['signature']);          
        }
        return $this;
    }



    function XmlToArray($xml)
    {
        $data = [];
        foreach ($xml->children() as $node) {
            $data[$node->getName()] = is_array($node) ? simplexml_to_array($node) : (string) $node;
        }
        return $data;
    }
    
     function isPdf()
    {
        return $this->getFile()->getExtension()=='pdf';
    }
    
    function isDocX()
    {
        return $this->getFile()->getExtension()=='docx';
    }
        
    
    function getEngine()
    {
        if ($this->engine===null)
        {
            if ($this->isDocX())
                $this->engine=new PartnerPolluterModelExtractor($this);
        }    
        return $this->engine;
    }
    
    function getMapping()
    {
        if ($this->_mapping===null)
        {
            $this->_mapping=new mfArray();
            preg_match_all("/([\w \.]*)\=([\w\.]*)/",$this->getModel()->getI18n()->get('mapping'),$matches);            
            foreach ($matches[1] as $index=>$value)
            {
               $this->_mapping[$value]=$matches[2][$index]; 
            } 
        }   
        return $this->_mapping;
    }
    
    function hasVariables()
    {
        return (boolean)$this->get('variables');
    }
}
