<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerViewForm.class.php";
 

class partners_ajaxSavePartnerAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->item = new Partner($request->getPostParameter('Partner'),$this->site); // new object       
        $this->form = new PartnerViewForm($request->getPostParameter('Partner'));  
        $this->form->bind($request->getPostParameter('Partner'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues()); // repopulate     
                if ($this->item->isExist())
                    throw new mfException(__("Partner already exists."));
                
                $messages->addInfo(__("Partner [%s] has been saved",$this->item->get('name')));                   
                $this->forward("partners","ajaxListPartialPartner");
            }    
            else
            {
                 $messages->addError(__("Form has some errors."));   
                 $this->item->add($request->getPostParameter('Partner')); // repopulate               
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
