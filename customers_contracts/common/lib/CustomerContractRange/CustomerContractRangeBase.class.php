<?php

class CustomerContractRangeBase extends mfObject2 {
     
    protected static $fields=array('name','from','to','color');
    const table="t_customers_contracts_date_range"; 
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);         
      }   
    }
    
  
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
      
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
      
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
      $db->setParameters(array('name'=>$this->get('name'),'to'=>$this->get('to'),'from'=>$this->get('from'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE `to`='{to}' AND `from`='{from}' AND name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
   
     
    /* =================================== P I C T U R E =========================================== */
    function hasI18n($lang=null)
    {
        return $this->getI18n($lang);
    }
   
     function setI18n($i18n)
     {
         $this->i18n=$i18n;
         return $this;
     }
     
     public function getI18n($lang=null)
     {         
         if ($this->i18n===null)
         {
             if ($lang==null)
                  $lang=  mfcontext::getInstance()->getUser()->getCountry();
             $this->i18n=new CustomerContractRangeI18n(array('lang'=>$lang,"range_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
      
     
     static function getRangesForI18nSelect($site=null)
    {
        $values=array();      
        $lang=  mfcontext::getInstance()->getUser()->getCountry();
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array("lang"=>$lang))
                ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContractRangeI18n::getTable().
                           " INNER JOIN ".CustomerContractRangeI18n::getOuterForJoin('range_id').
                           " WHERE lang='{lang}' ".
                           " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerContractRangeI18n'))
        { 
            $values[$item->get('range_id')]= mb_strtoupper($item->get('value'));
        }      
        return $values;
    }
    
    static function getRangesI18n($site=null)
    {
        static $values=null;
        if ($values===null)
        {    
            $values=new mfArray();   
        /*    $item=new CustomerContractRangeI18n(null,$site);
            $item->set('value',__('Not affected'));
            $values->push($item);*/
            $lang=  mfcontext::getInstance()->getUser()->getCountry();
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array("lang"=>$lang))
                    ->setQuery("SELECT ".CustomerContractRangeI18n::getFieldsAndKeyWithTable()." FROM ".CustomerContractRangeI18n::getTable().
                               " INNER JOIN ".CustomerContractRangeI18n::getOuterForJoin('range_id').
                               " WHERE lang='{lang}'".
                               " ORDER BY ".CustomerContractRange::getTableField('from')." ASC".
                               ";")               
                    ->makeSiteSqlQuery($site); 
            if (!$db->getNumRows())
                return $values;
            while ($item=$db->fetchObject('CustomerContractRangeI18n'))
            { 
                $values[$item->get('range_id')]= $item;
            }               
        }
        return $values; 
    }     
    
    static function getRanges($site=null)
    {      
            $values=new mfArray();           
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array())
                    ->setQuery("SELECT * FROM ".CustomerContractRange::getTable().                              
                               ";")               
                    ->makeSiteSqlQuery($site); 
            if (!$db->getNumRows())
                return $values;
            while ($item=$db->fetchObject('CustomerContractRange'))
            { 
                $values[$item->get('id')]= $item->setSite($site)->loaded();
            }                     
        return $values; 
    }     
    
    function hasColor()
    {
        return (boolean)$this->get('color');
    }
    
     function toArrayForTransfer()
     {
         $values=parent::toArray(array('name','from','to','color'));
         $values['value']=(string)$this->getI18n();         
         return $values;
     }
     
      function save()
     {
         parent::save();
         mfCacheFile::removeCache('range','admin',$this->getSite());         
         return $this;
     }
     
      function delete()
     {
         parent::delete();
         mfCacheFile::removeCache('range','admin',$this->getSite());   
         return $this;
     }
}
