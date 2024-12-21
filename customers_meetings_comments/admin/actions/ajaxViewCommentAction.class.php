<?php

//require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCommentViewForm.class.php";



class customers_meetings_comments_ajaxViewCommentAction extends mfAction {
    

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                     
     //   $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));
      //  if ($this->meeting->isNotLoaded())
      //      return ;
     //   $this->form= new CustomerMeetingCommentNewForm($request->getPostParameter('Comment'));
        $this->item=new CustomerMeetingComment($request->getPostParameter('Comment'));                   
    }

}
