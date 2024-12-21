<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerWithContactNewForm.class.php";

class app_mutual_ajaxNewMutualPartnerAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        
        $messages = mfMessages::getInstance();
        $this->item = new MutualPartnerContact();
        $this->item->set('company_id',new MutualPartner());
        $this->form = new MutualPartnerWithContactNewForm($request->getPostParameter('MutualPartner'));      
        if ($request->getPostParameter('MutualPartner'))
        {
            try 
            {
                $this->form->bind($request->getPostParameter('MutualPartner'));
                if ($this->form->isValid()) 
                {
                    $this->item->add($this->form['contact']->getValues());
                    $this->item->getPartner()->add($this->form['company']->getValues());
                    if ($this->item->getPartner()->isExist())
                        throw new mfException (__("MutualPartner already exists")); 
                    if ($this->item->isExist())
                        throw new mfException (__("Contact already exists")); 
                    $this->item->getPartner()->save();
                    $this->item->set('company_id',$this->item->getPartner());                                        
                    $this->item->save();
                    $messages->addInfo(__("MutualPartner [%s] (%s) has been saved",array($this->item->getPartner()->get('name'),(string)$this->item)));                   
                    $this->forward("app_mutual","ajaxListPartialMutualPartner");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($this->form['contact']->getValues());
                   $this->item->getPartner()->add($this->form['company']->getValues());
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }

}
