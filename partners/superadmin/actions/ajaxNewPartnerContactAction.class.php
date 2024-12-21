<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerContactNewForm.class.php";
 

class partners_ajaxNewPartnerContactAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");       
        $item = new Partner($request->getPostParameter('Partner'),$this->site); // new object 
        if ($item->isNotLoaded())
        {
            $messages->addError(__('installer is invalid.'));
            $this->forward ('partners','ajaxListPartialPartner');
        }    
        $this->item = new PartnerContact(null,$this->site); // new object
        $this->item->set('company_id',$item);
        $this->form = new PartnerContactNewForm();    
        try
        {
            if ($request->isMethod('POST') && $request->getPostParameter('PartnerContact'))
            {
                $this->form->bind($request->getPostParameter('PartnerContact'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Contact already exists."));
                    $this->item->save();
                    $messages->addInfo(__("Contact [%s] has been saved",(string)$this->item));                   
                    $this->forward("partners","ajaxListPartnerContact");
                }    
                else
                {
                     $messages->addError(__("Form has some errors."));   
                     $this->item->add($request->getPostParameter('PartnerContact')); // repopulate        
                }    
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
