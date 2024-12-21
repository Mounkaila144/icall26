<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerWithContactNewForm.class.php";
 

class partners_ajaxNewPartnerAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->item = new PartnerContact(); // new object
        $this->item->set('company_id',new Partner());
        $this->form = new PartnerWithContactNewForm($request->getPostParameter('Partner'));      
        if ($request->getPostParameter('Partner'))
        {
            try {
                $this->form->bind($request->getPostParameter('Partner'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form['contact']->getValues());
                    $this->item->getPartner()->add($this->form->getValuesForCompany());
                    if ($this->item->getPartner()->isExist())
                        throw new mfException (__("Partner already exists")); 
                    if ($this->item->isExist())
                        throw new mfException (__("Contact already exists")); 
                    $this->item->getPartner()->save();
                    $this->item->set('company_id',$this->item->getPartner());                                        
                    $this->item->save();
                    $messages->addInfo(__("Partner [%s] (%s) has been saved",array($this->item->getPartner()->get('name'),(string)$this->item)));                   
                    $this->forward("partners","ajaxListPartialPartner");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($this->form['contact']->getValues()); // repopulate
                   $this->item->getPartner()->add($this->form['company']->getValues()); // repopulate
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }

}
