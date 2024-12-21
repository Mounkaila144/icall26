<?php

class CustomerMeetingCommentBase extends mfObject2 {
     
    protected static $fields=array('meeting_id','comment','type',
                                   'updated_at','created_at');    
    const table="t_customers_meetings_comments"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting'); // By default
         
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
        // return $this->loadBySms((string)$parameters);
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
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
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
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function getCustomerMeeting()
    {
        if (!$this->_meeting_id)
        {
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());
        }    
        return $this->_meeting_id;
    }
    
    function setHistory($user)
    {
        $history=new CustomerMeetingCommentHistory(null,$this->getSite());
        $history->setUser($user);
        $history->setComment($this);
        $history->save();
    }

    static function getCommentsAndHistoryByMeetings($meetings)
    {
        $site=$meetings->getSite();
        $ids=array();      
        foreach ($meetings as $meeting)
            $ids[]=$meeting->get('id');
       $collection=new CustomerMeetingCommentHistoryCollection(null,$site);
        foreach ($meetings as $meeting)
            $ids[]=$meeting->get('id');
        $db=mfSiteDatabase::getInstance()            
            ->setObjects(array('CustomerMeetingComment','CustomerMeetingCommentHistory'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeetingComment::getTable().
                       " INNER JOIN ".  CustomerMeetingCommentHistory::getInnerForJoin('comment_id').
                       " WHERE meeting_id IN('".implode("','",$ids)."');")
            ->makeSiteSqlQuery($site);
         if (!$db->getNumRows())
             return $collection;                  
        while ($items=$db->fetchObjects())
        {
            $item=$items->getCustomerMeetingCommentHistory();
            $item->set('comment_id',$items->getCustomerMeetingComment());
            $collection[]=$item;
        }        
        return $collection;
    }
    
    
    static function initializeSite($site=null)
    {
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("DELETE FROM ".CustomerMeetingComment::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("DELETE FROM ".  CustomerMeetingCommentHistory::getTable().";")               
                ->makeSiteSqlQuery($site);  
           $db->setQuery("TRUNCATE ".CustomerMeetingComment::getTable().";")               
                ->makeSiteSqlQuery($site); 
           $db->setQuery("TRUNCATE ".  CustomerMeetingCommentHistory::getTable().";")               
                ->makeSiteSqlQuery($site); 
    }
    
    function getSettings(){
        
        if(!$this->settings){
            
            $this->settings=new CustomerCommentSettings (null, $this->getSite());
        }
        return $this->settings;
        
    }
    
    function getCensoredText()
    {
        return $this->getSettings()->escapeText($this->get('comment'));
    }
}
