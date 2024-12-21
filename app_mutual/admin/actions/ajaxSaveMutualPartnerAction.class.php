<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerViewForm.class.php";

class app_mutual_ajaxSaveMutualPartnerAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        
        $messages = mfMessages::getInstance();      
        $this->item = new MutualPartner($request->getPostParameter('MutualPartner'));   
        $this->form = new MutualPartnerViewForm($request->getPostParameter('MutualPartner'));  
        $this->form->bind($request->getPostParameter('MutualPartner'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("MutualPartner already exists."));
                $this->item->save();
                $messages->addInfo(__("MutualPartner [%s] has been saved",$this->item->get('name')));                   
                $this->forward("app_mutual","ajaxListPartialMutualPartner");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualPartner'));      
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
