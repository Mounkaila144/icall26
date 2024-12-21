<?php

class CustomerMeetingExportKMLFilter extends CustomerMeetingExportKMLFilterBase {
    
    

    function execute()
    {                
     
         $db=new mfSiteDatabase();         
        $db->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')))                              
            ->setObjects(array('Customer','CustomerMeeting','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".  
                                " AND ".CustomerMeeting::getTableField('status')."='ACTIVE' ".
                                $this->getFilter()->getWhere('AND').
                               $this->getFilter()->getConditions()->getWhere("AND").  
                           " ORDER BY in_at ASC".
                           ";")
             ->makeSqlQuery();
        $this->number_of_items=$db->getNumRows();                      
      //  trigger_error($db->getQuery());
        $this->getItemsFromDatabase($db);    
    }
}