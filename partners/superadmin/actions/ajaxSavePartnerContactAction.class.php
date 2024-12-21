<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerContactViewForm.class.php";
 

class partners_ajaxSavePartnerContactAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item = new PartnerContact($request->getPostParameter('PartnerContact'),$this->site); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('partners','ajaxListPartialPartner');
        }
        $this->form = new PartnerContactViewForm($request->getPostParameter('PartnerContact'));  
        try
        {           
            $this->form->bind($request->getPostParameter('PartnerContact'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Contact already exists."));
                $this->item->save();
                $messages->addInfo(__("Contact [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('Partner', $this->item->getPartner());
                $this->forward("partners","ajaxListPartnerContact");
            }    
            else
            {
                 $messages->addError(__("Form has some errors."));   
                 $this->item->add($request->getPostParameter('PartnerContact')); // repopulate        
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
