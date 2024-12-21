<?php

class CustomerMeetingExportCsvFilter extends CustomerMeetingExportCsvFilterBase {
    
     function execute()
    {                             
        if ($this->getUser()->hasCredential(array('superadmin','meeting_export_csv_deleted_status')))   
            $active_query="";
        else        
            $active_query=" AND ".CustomerMeeting::getTableField('status')."='ACTIVE' ";      
        
        $this->getmfQuery()->select("{fields}")
                           ->select("(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerMeetingProduct::getTableField('meeting_id')."=".CustomerMeeting::getTableField('id').
                                  ") as products ")
                           ->select("GROUP_CONCAT(".UserTeam::getTableField('name')." SEPARATOR ',') as team")
                           ->from(CustomerMeeting::getTable())
                           ->inner(CustomerMeeting::getOuterForJoin('customer_id'))
                           ->left(CustomerAddress::getInnerForJoin('customer_id'))
                           ->left(CustomerMeeting::getOuterForJoin('state_id'))
                           ->left(CustomerMeeting::getOuterForJoin('telepro_id','telepro'))
                           ->left(CustomerMeeting::getOuterForJoin('assistant_id','assistant'))
                           ->left(CustomerMeeting::getOuterForJoin('sales_id','sale1'))
                           ->left(CustomerMeeting::getOuterForJoin('sale2_id','sale2'))
                           ->left(CustomerMeeting::getOuterForJoin('created_by_id','creator'))
                           ->left(CustomerMeetingProduct::getInnerForJoin('meeting_id'))
                           ->left(CustomerMeeting::getOuterForJoin('callcenter_id'))
                           ->left(CustomerMeeting::getOuterForJoin('status_call_id'))
                           ->left(CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'")
                           ->left(CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'")
                           ->left(UserTeamUsers::getTable()." ON ".UserTeamUsers::getTableField('user_id')."=".CustomerMeeting::getTableField('telepro_id'))
                           ->left(UserTeamUsers::getOuterForJoin('team_id'))
                           ->where( $this->getFilter()->getWhere().                   
                                $this->getFilter()->getConditions()->getWhere('AND').  
                                $active_query)
                           ->groupBy(CustomerMeeting::getTableField('id'))
                           ->orderBy("in_at ASC");
        
         mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meeting.export.filter.config'));                      
        $db=new mfSiteDatabase();  // Mandatory if other queries requested on filter
                $db->setParameters(array('lang'=>$this->getOption('lang')))
                ->setObjects($this->getObjects()->toArray())                                
                ->setAlias($this->getAlias()->toArray())
                ->setQuery((string)$this->getMfQuery())
              /*  ->setQuery("SELECT {fields} ".
                                ",(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerMeetingProduct::getTableField('meeting_id')."=".CustomerMeeting::getTableField('id').
                                  ") as products ". 
                                  ", GROUP_CONCAT(".UserTeam::getTableField('name')." SEPARATOR ',') as team ".
                           " FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').  
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale1'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id','sale2').  
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('created_by_id','creator').     
                           " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').    
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                           " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                           " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'".  
                           " LEFT JOIN ".UserTeamUsers::getTable()." ON ".UserTeamUsers::getTableField('user_id')."=".CustomerMeeting::getTableField('telepro_id').
                           " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').
                           " WHERE ".                                 
                                $this->getFilter()->getWhere().                   
                                $this->getFilter()->getConditions()->getWhere('AND').  
                                $active_query.
                           " GROUP BY ".CustomerMeeting::getTableField('id').
                           " ORDER BY in_at ASC".
                           ";")  */
                 ->makeSqlQuery();  
                 //echo $db->getQuery()."<br/>"; die(__METHOD__);
    //   trigger_error($db->getQuery());
     //   echo "<pre>"; var_dump($this->getFilter()->getValues()); echo "</pre>"; 
     //   echo $db->getQuery()."<br/>"; die(__METHOD__);die(__METHOD__);        
        $this->open(); 
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();     
    }
    
    
    
}