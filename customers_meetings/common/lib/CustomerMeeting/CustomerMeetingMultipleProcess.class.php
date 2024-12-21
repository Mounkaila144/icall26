<?php

class CustomerMeetingMultipleProcess extends MultipleProcessCore {
   
    
    function process()
    {
        $query=array();
        $params=array('is_hold'=>'NO');      
        if (in_array('hold',$this->getActions()))
        {            
            $query[]=CustomerMeeting::getTableField("is_hold")."='YES'";
            $params['is_hold']='NO';
            $this->messages[]=__("Selection has been hold.");
        } 
         if (in_array('unhold',$this->getActions()))
        {            
            $query[]=CustomerMeeting::getTableField("is_hold")."='NO'";
            $params['is_hold']='YES';
            $this->messages[]=__("Selection has been unhold.");
        } 
       /*  if (in_array('status_delete',$this->getActions()))
        {                      
            $query[]=CustomerMeeting::getTableField("status")."='DELETE'";
            $this->messages[]=__("Status delete has been updated.");
        }*/
          if (in_array('status_active',$this->getActions()))
        {                      
            $query[]=CustomerMeeting::getTableField("status")."='ACTIVE'";
            $this->messages[]=__("Status active has been updated.");
        }
        if (in_array('create_contract',$this->getActions()))
        {        
            $this->messages[]=CustomerMeetingUtils::createContracts($this->getSelection(),$this->getUser(),$this->getSite());  
            mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this, 'meetings.multiple.process.done')); 
        }
        //  echo "<pre>"; var_dump($query,$params,$selection); echo "</pre>";
        if ($query)
        {           
           $db=mfSiteDatabase::getInstance()
                ->setParameters($params)                
                ->setQuery("UPDATE ".CustomerMeeting::getTable().
                           " SET ".implode(",",$query).
                           " WHERE id IN('".$this->getSelection()->implode("','")."')".
                           " AND is_hold='{is_hold}'".
                           ";")                        
                ->makeSiteSqlQuery($this->getSite()); 
       //    echo $db->getQuery();
        }  
        return $this;
    }
    
    
}

