<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingCommentNewForm.class.php";



class customers_meetings_comments_ajaxNewCommentAction extends mfAction {
    

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                     
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));
        if ($this->meeting->isNotLoaded())
            return ;
        $this->form= new CustomerMeetingCommentNewForm($request->getPostParameter('Comment'));
        $this->item=new CustomerMeetingComment();         
        if ($request->isMethod('POST') && $request->getPostParameter('Comment'))
        {          
             $this->form->bind($request->getPostParameter('Comment'));
             if ($this->form->isValid())
             {
                  // Comment
                  $this->item->add($this->form->getValues());
                  $this->item->set('meeting_id',$this->meeting);
                  $this->item->save();
                  // History
                  $this->item->setHistory($this->getUser()->getGuardUser());                  
                //  var_dump($this->form['products']->getValues());
                  $messages->addInfo(__("Comment has been added."));
                  $this->forward('customers_meetings_comments', 'ajaxListPartialComment');
             }   
             else
             {  // Repopulate
             //    var_dump($this->form->getErrorSchema()->getErrorsMessage());             
                $messages->addError(__("Form has some errors."));                    
                $this->item->add($this->form->getDefaults());                                            
             }    
        }
        $this->token=mfTools::generateUniqueId();
    }

}
