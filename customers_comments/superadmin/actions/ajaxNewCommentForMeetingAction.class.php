<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerCommentNewForm.class.php";



class customers_comments_ajaxNewCommentForMeetingAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");          
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);
        if ($this->meeting->isNotLoaded())
            return ;
        $this->form= new CustomerCommentNewForm($request->getPostParameter('Comment'),$this->site);
        $this->item=new CustomerComment(null,$this->site);         
        if ($request->isMethod('POST') && $request->getPostParameter('Comment'))
        {          
             $this->form->bind($request->getPostParameter('Comment'));
             if ($this->form->isValid())
             {
                  // Comment
                  $this->item->add($this->form->getValues());
                  $this->item->set('customer_id',$this->meeting->getCustomer());
                  $this->item->save();
                  // History
                  $this->item->setHistory($this->getUser()->getGuardUser());                  
                //  var_dump($this->form['products']->getValues());
                  $messages->addInfo(__("Comment has been added."));
                  $this->forward('customers_comments', 'ajaxListPartialCommentForMeeting');
             }   
             else
             {  // Repopulate
             //    var_dump($this->form->getErrorSchema()->getErrorsMessage());             
                $messages->addError(__("Form has some errors."));                    
                $this->item->add($this->form->getDefaults());                                            
             }    
        }           
    }

}
