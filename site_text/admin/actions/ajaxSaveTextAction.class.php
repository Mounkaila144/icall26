<?php

require_once dirname(__FILE__)."/../locales/Forms/SiteTextViewForm.class.php";

class site_text_ajaxSaveTextAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();
        $this->form= new SiteTextViewForm($this->getUser(),$request->getPostParameter('SiteText'));
        $this->item=new SiteText($request->getPostParameter('SiteText'));
        $this->form->bind($request->getPostParameter('SiteText'));
        try
        {
            if ($this->form->isValid())
            {
               $this->item->add($this->form->getValues());             
                if ($this->item->isExist())
                    throw new mfException(__('Text already exists.'));
                $this->item->save();
                $messages->addInfo(__('Text has been updated.'));
                $this->forward('site_text', 'ajaxListPartialText');
            }   
            else
            {    
                $messages->addError(__('Form has some errors.'));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
