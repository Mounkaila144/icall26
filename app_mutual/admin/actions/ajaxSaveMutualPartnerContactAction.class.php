<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerContactViewForm.class.php";

class app_mutual_ajaxSaveMutualPartnerContactAction extends mfAction {
 
    function execute(mfWebRequest $request) {        
        
        $messages = mfMessages::getInstance();   
        $this->item = new MutualPartnerContact($request->getPostParameter('MutualPartnerContact'));  
        
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }
        
        $this->form = new MutualPartnerContactViewForm($request->getPostParameter('MutualPartnerContact'));  
        try
        {           
            $this->form->bind($request->getPostParameter('MutualPartnerContact'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Contact already exists."));
                $this->item->save();
                $messages->addInfo(__("Contact [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('MutualPartner', $this->item->getPartner());
                $this->forward("app_mutual","ajaxListMutualPartnerContact");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualPartnerContact'));     
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
