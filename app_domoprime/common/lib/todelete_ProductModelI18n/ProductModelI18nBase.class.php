<?php

class todelete_ProductModelI18nBase extends mfObjectI18n {
     
    protected static $fields=array('value','model_id','lang','content','created_at','updated_at');
    const table="t_products_documents_model_i18n"; 
    protected static $foreignKeys=array('model_id'=>'ProductModel'); // By default
    
    
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
         return $this->loadBySms((string)$parameters);
      }   
    }
    
  /*  protected function loadBySms($sms)
    {
         $this->set('sms',$sms);
         $db=mfSiteDatabase::getInstance()->setParameters(array($sms));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE sms='%s';")
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
                       " WHERE lang='{lang}' AND model_id={model_id};")
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
          $this->_model_id=new ProductModel($this->get('model_id'),$this->getSite());          
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
    
  /*  function getContentWithVariables()
    {
        return mfTools::textWithVariables($this->get('content'));
    }*/
    
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
            'see with mrs'=>'meeting.see_with_mrs',
            'see with mr'=>'meeting.see_with_mr',
        );
    }   */
    
    function getVariables($dictionary='dictionary')
    {
        return array(
            'user.name'=>__('user','',$dictionary),
            'user.firstname'=>__('user firstname','',$dictionary),
            'user.lastname'=>__('user lastname','',$dictionary),
            'user.mobile'=>__('user mobile','',$dictionary),
            'user.phone'=>__('user phone','',$dictionary),
            'user.courtesy'=>__('user courtesy','',$dictionary),
            'user.gender'=>__('user gender','',$dictionary),
            'customer.name'=>__('customer name','',$dictionary),
            'customer.firstname'=>__('customer firstname','',$dictionary),
            'customer.lastname'=>__('customer lastname','',$dictionary),
            'customer.mobile'=>__('customer mobile','',$dictionary),
            'customer.phone'=>__('customer phone','',$dictionary),
            'customer.courtesy'=>__('customer courtesy','',$dictionary),
            'customer.gender'=>__('customer gender','',$dictionary),
            'customer.address.full'=>__('customer address','',$dictionary),
            'meeting.remarks'=>__('meeting remarks','',$dictionary),
            'meeting.see_with_mrs'=>__('see with mrs','',$dictionary),
            'meeting.see_with_mr'=>__('see with mr','',$dictionary),
        );
    }   
    
     function getVariablesSorted($dictionnary='dictionary')
    {
        $values=$this->getVariables($dictionnary);
        asort($values,SORT_FLAG_CASE|SORT_STRING);
        return $values;
    }
}
