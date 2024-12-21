<?php

class DomoprimeBillingModelI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','model_id','lang','body','initiator_signature','signature','created_at','updated_at');
    const table="t_domoprime_billing_model_i18n"; 
    protected static $foreignKeys=array('model_id'=>'DomoprimeBillingModel'); // By default
    
    
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
          $this->_model_id=new DomoprimeBillingModel($this->get('model_id'),$this->getSite());          
       }   
       return $this->_model_id;
    }    
    
  /*  function getVariables()
    {
        return array(
            'user'=>'user.name',
            'user firstname'=>'user.firstname',
            'user lastname'=>'user.lastname',
            'user mobile'=>'user.mobile',
            'user phone'=>'user.phone',
            'user courtesy'=>'user.courtesy',
            'user gender'=>'user.gender',
            'customer name'=>'customer.name',
            'customer firstname'=>'customer.firstname',
            'customer lastname'=>'customer.lastname',
            'customer mobile'=>'customer.mobile',
            'customer phone'=>'customer.phone',
            'customer courtesy'=>'customer.courtesy',
            'customer gender'=>'customer.gender',
            'customer address'=>'customer.address.full',
            'meeting remarks'=>'meeting.remarks',
            'see with'=>'meeting.see_with',
          //    'see with mrs'=>'meeting.see_with_mrs',
          //  'see with mr'=>'meeting.see_with_mr',
        );
    }   */
   
     function getVariables($dictionnary='dictionary')
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
    }
    
    static function format_date($date)
    {
        $values=array();
        foreach (array("ddmmyyyy"=>"a","ddmmyy"=>'d',"ddmmmmyyyy"=>"D") as $name=>$format)
            $values[$name]=format_date($date,$format);    
        return $values;
    }  
    
       function hasSignatures()
    {
        return (boolean)$this->get('signature');
    }
    
    function getSignatures()
    {
        if ($this->_signature===null)
        {
            $this->_signature=new DomoprimeBillingModelSignatureCollection($this->get('signature'));
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
            $this->_initiator_signature=new DomoprimeBillingModelSignature($this->get('initiator_signature'));
        }
        return $this->_initiator_signature;
    }
    
    function getInitiatorSignatures()
    {
         if ($this->_initiator_signatures===null)
        {
            $this->_initiator_signatures=new DomoprimeBillingModelSignatureCollection($this->get('initiator_signature'));
        }
        return $this->_initiator_signatures;
    }
    
    function toXML()
    {
        $values = $this->toArray(array('value','lang','created_at','updated_at')); 
        $values['body']="<![CDATA[".$this->get('body')."]]>";
        return  $values;
    }
    
    function toArrayForApi()
   {
        return $this->toArray(array('value','lang','initiator_signature','signature','created_at','updated_at'));                
    }
}
