<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerWithContactNewForm.class.php";
 

class partners_ajaxNewPartnerAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item = new PartnerContact(null,$this->site); // new object
        $this->item->set('company_id',new Partner(null,$this->site));
        $this->form = new PartnerWithContactNewForm($request->getPostParameter('Partner'));      
        if ($request->getPostParameter('Partner'))
        {
            try {
                $this->form->bind($request->getPostParameter('Partner'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form['contact']->getValues());
                    $this->item->getPartner()->add($this->form['company']->getValues());
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
