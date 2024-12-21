<?php

class PartnerPolluterDocumentBase extends mfObject2 {
     
    protected static $fields=array('model_id','polluter_id','document_id','created_at','updated_at');
    
    const table="t_partner_polluter_document"; 
       protected static $foreignKeys=array('model_id'=>'PartnerPolluterModel',
                                           'document_id'=>'CustomerMeetingFormDocument',
                                           'polluter_id'=>'PartnerPolluterCompany'
                                        ); // By default   
      protected static $fieldsNull=array('model_id','document_id','polluter_id');
      
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['document']) && $parameters['document'] instanceof CustomerMeetingFormDocument &&
              isset($parameters['polluter']) && $parameters['polluter'] instanceof PartnerPolluterCompany
             )
             return $this->loadbyDocumentAndPolluter($parameters['document'],$parameters['polluter']); 
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
        // return $this->loadBySms((string)$parameters);
      }   
    }
    
    protected function loadbyDocumentAndPolluter($document,$polluter)
    {
         $this->set('document_id',$document);
         $this->set('polluter_id',$polluter);                 
         $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('polluter_id'=>$polluter->get('id'),
                                          'document_id'=>$document->get('id')))
                    ->setQuery("SELECT * FROM ".self::getTable()." WHERE polluter_id='{polluter_id}' AND document_id='{document_id}';")
                    ->makeSiteSqlQuery($this->site);                           
          $this->rowtoObject($db);        
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
    
   /* protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),'polluter_id'=>$this->get('polluter_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE polluter_id='{polluter_id}' AND name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
   
           
    function getModel()
    {
       if (!$this->_model_id)
       {
          $this->_model_id=new PartnerPolluterModel($this->get('model_id'),$this->getSite());          
       }   
       return $this->_model_id;
    }   
    
    function hasModel()
    {
        return (boolean)$this->get('model_id');
    }
    
    function hasDocument()
    {
        return (boolean)$this->get('document_id');
    }
    
    function getDocument()
    {
       if (!$this->_document_id)
       {
          $this->_document_id=new CustomerMeetingFormDocument($this->get('document_id'),$this->getSite());          
       }   
       return $this->_document_id;
    }   
    
      function getPolluter()
    {
       if (!$this->_polluter_id)
       {
          $this->_polluter_id=new PartnerPolluterCompany($this->get('polluter_id'),$this->getSite());          
       }   
       return $this->_polluter_id;
    }   
    
    
    function getNameWithExtension()
    {
        return $this->getPolluter()->getNameAlphaNum()."_".$this->getDocument()->getNameWithExtension();
    }
   
    
     static function getDocumentsForContract(CustomerContract $contract,$user)
    {             
        $form_data=new CustomerMeetingForms($contract,$contract->getSite());
        // get all documents with conditions
        $documents=new CustomerMeetingFormDocumentCollection(null,$contract->getSite());
        $db=mfSiteDatabase::getInstance()
                  ->setObjects(array('CustomerMeetingFormDocument','CustomerMeetingFormDocumentFormfield',
                                     'CustomerMeetingForm',
                                     'CustomerMeetingFormfield'))
                 ->setQuery("SELECT {fields} FROM ".CustomerMeetingFormDocument::getTable().
                            " INNER JOIN ".CustomerMeetingFormDocumentFormfield::getInnerForJoin('document_id').
                            " INNER JOIN ".CustomerMeetingFormDocumentFormfield::getOuterForJoin('formfield_id').
                            " INNER JOIN ".CustomerMeetingFormfield::getOuterForJoin('form_id').  
                            " WHERE ".CustomerMeetingFormDocument::getTableField('type')."=0".
                            ";")
                    ->makeSiteSqlQuery($contract->getSite()); 
       // echo $db->getQuery();
        if ($db->getNumRows())
        {
            while ($items=$db->fetchObjects())
            {                                
                if (!isset($documents[$items->getCustomerMeetingFormDocument()->get('id')]))
                    $documents[$items->getCustomerMeetingFormDocument()->get('id')]=$items->getCustomerMeetingFormDocument(); 
                $item=$items->getCustomerMeetingFormDocumentFormfield();
                $item->set('form_id',$items->getCustomerMeetingForm());
                $documents[$items->getCustomerMeetingFormDocument()->get('id')]->addFormField($item);
            }        
        }    
        // loop des docs => forms dans le document si OK => liste si non KO         
        foreach ($documents->getKeys() as $key)
        {
            $document=$documents[$key];
            $ret=$document->isExist($form_data);
            if (!$ret)
              unset($documents[$key]) ;
        }              
        
        $polluter_documents=new PartnerPolluterDocumentCollection(null,$contract->getSite());        
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('polluter_id'=>$contract->getPolluter()->get('id')))
                ->setObjects(array('CustomerMeetingFormDocument','PartnerPolluterDocument'))                       
                ->setQuery("SELECT {fields} FROM ".PartnerPolluterDocument::getTable().
                           " INNER JOIN ".PartnerPolluterDocument::getOuterForJoin('document_id').
                            " WHERE polluter_id='{polluter_id}' AND document_id IN('".implode("','",$documents->getKeys())."')".
                            ";")
                    ->makeSiteSqlQuery($contract->getSite());  
        //echo $db->getQuery();
        if ($db->getNumRows())
        {
            while ($items=$db->fetchObjects())
            {                                
               $item=$items->getPartnerPolluterDocument();
               $item->set('document_id',$items->getCustomerMeetingFormDocument());               
               $polluter_documents[$item->get('id')]=$item;   
            }        
        }                
        return $polluter_documents;     
    }        
    
    
    
    function isAuthorized($contract)
    {       
        if ($this->isNotLoaded())
            return false;
        if ($this->getDocument()->isNotLoaded())
            return false;
        return $this->getDocument()->isAuthorized($contract);          
    }
    
    
    function toXml()
    {
        $values=$this->toArray();
        $values['model']=$this->get('model_id');
        $values['document']=$this->getDocument()->toXML();        
        return $values;
    }
    
    
     function getEscapedValue()
    {     
        return preg_replace('/[^abcdefghijklmnopqrstuvwxyz0123456789\.\-]/i', "_", str_replace(" ","_",mfTools::I18N_noaccent($this->get('model_name'))));
    }
}
