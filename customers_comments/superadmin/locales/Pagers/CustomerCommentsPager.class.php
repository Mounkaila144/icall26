<?php


class CustomerCommentsPager extends Pager {

    
   
    protected function fetchObjects($db)
    {          
       $super_admin_users=array();
       while ($items = $db->fetchObjects()) 
       {                       
           $items->getCustomerCommentHistory()->set('comment_id',$items->getCustomerComment());
           if ($items->hasUser())
               $items->getCustomerCommentHistory()->set('user_id',$items->getUser());
           $this->items[]=$items->getCustomerCommentHistory();
           if ($items->getCustomerCommentHistory()->get('user_application')=='superadmin')
               $super_admin_users[]=$items->getCustomerCommentHistory()->get('user_id');        
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

