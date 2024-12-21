<?php


class CustomerMeetingCommentsPager extends Pager {

    
   
    protected function fetchObjects($db)
    {          
       $super_admin_users=array();             
       while ($items = $db->fetchObjects()) 
       {                        
           $items->getCustomerMeetingCommentHistory()->set('comment_id',$items->getCustomerMeetingComment());
           if ($items->hasUser())
               $items->getCustomerMeetingCommentHistory()->set('user_id',$items->getUser());
           $this->items[]=$items->getCustomerMeetingCommentHistory();
           if ($items->getCustomerMeetingCommentHistory()->get('user_application')=='superadmin')
           {               
               $super_admin_users[]=$items->getCustomerMeetingCommentHistory()->get('user_id');        
              // $super_admin_users[]=$items->getUser()->get('id');        
           }    
       }          
       if (empty($super_admin_users))
           return ;
       // Get superadmin users
       $db=mfSiteDatabase::getInstance()                    
                ->setQuery("SELECT * FROM ".User::getTable().                                                      
                           " WHERE id IN(".implode(",",$super_admin_users).")".
                           ";")               
                ->makeSqlQuerySuperAdmin(); 
        $users=array();
        while ($user=$db->fetchObject('User'))
        {
          $users[$user->get('id')]=$user;          
        }  
        foreach ($this->items as $history)
        {
            if ($history->get('user_application')=='superadmin')
            {
                $history->set('user_id',$users[$history->get('user_id')]);
            }    
        }    
    }
   
    
}

