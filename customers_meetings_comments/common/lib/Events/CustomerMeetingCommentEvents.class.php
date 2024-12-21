<?php

class CustomerMeetingCommentEvents {
     
 
    static function importMeetings(mfEvent $event)
    {         
        $meetings=$event->getSubject();
        if (!mfModule::isModuleInstalled('customers_meetings_comments', $meetings->getSite()))
             return ;             
        $dst_meetings=$meetings->getDestinationCollection();
        if (!$dst_meetings || $dst_meetings->isEmpty())
            return ;      
       // Get Comment & history
       $collection_comment=new CustomerMeetingCommentCollection(null,$meetings->getDestinationCollection()->getSite());
       $comments=CustomerMeetingComment::getCommentsAndHistoryByMeetings($meetings);
       foreach ($comments as $key=>$src_comment_history)
        {
            $dst_comment=new CustomerMeetingComment(null,$meetings->getDestinationCollection()->getSite());
            $dst_comment->copyFrom($src_comment_history->getComment());
            $dst_comment->set('meeting_id',$meetings->getMeetingTranslate($src_comment_history->getComment()->get('meeting_id')));
            $collection_comment[$key]=$dst_comment;
        }    
        $collection_comment->save();        
        $collection_history=new CustomerMeetingCommentHistoryCollection(null,$meetings->getDestinationCollection()->getSite());
        foreach ($comments as $key=>$src_comment_history)
        {
            $dst_comment_history=new CustomerMeetingCommentHistory(null,$meetings->getDestinationCollection()->getSite());
            $dst_comment_history->copyFrom($src_comment_history);
            $dst_comment_history->set('comment_id',$collection_comment[$key]);
            $dst_comment_history->set('user_id',$meetings->getUserTranslate($src_comment_history->get('user_id')));
            $collection_history[$key]=$dst_comment_history;
        }    
        $collection_history->save();         
    }
    
      static function initializationExecute(mfEvent $event)
    {
          $form=$event->getSubject();
         if (!mfModule::isModuleInstalled('customers_meetings_comments',$form->getSite()))
             return ;         
        if ($form->getValue('meetings_clean'))
        {    
            CustomerMeetingComment::initializeSite($form->getSite());
        }
    }
}

