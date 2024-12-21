<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerCommentNewForm.class.php";



class customers_comments_ajaxNewCommentForContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");          
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site);
        if ($this->contract->isNotLoaded())
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
                  $this->item->set('customer_id',$this->contract->getCustomer());
                  $this->item->save();
                  // History
                  $this->item->setHistory($this->getUser()->getGuardUser());                  
                //  var_dump($this->form['products']->getValues());
                  $messages->addInfo(__("Comment has been added."));
                  $this->forward('customers_comments', 'ajaxListPartialCommentForContract');
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
