<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteTextNewForm.class.php";

class site_text_ajaxNewTextAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        $this->form= new SiteTextNewForm($this->getUser(),$request->getPostParameter('SiteText'));
        $this->item=new SiteText(); 
        if (!$request->isMethod('POST') || !$request->getPostParameter('SiteText'))
            return ;
        $this->form->bind($request->getPostParameter('SiteText'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());             
                if ($this->item->isExist())
                    throw new mfException(__('Text already exists.'));
                $this->item->save();
                $messages->addInfo(__('Text has been created.'));              
                $this->forward('site_text','ajaxListPartialText');
            }   
            else
            {
                $messages->addError(__('Form has some errors.'));
                $this->item->add($this->form->getDefaults());
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
