<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerContactNewForm.class.php";

class app_mutual_ajaxNewMutualPartnerContactAction extends mfAction {
    
    function execute(mfWebRequest $request) {       
        
        $messages = mfMessages::getInstance(); 
        $item = new MutualPartner($request->getPostParameter('MutualPartner')); 
        if ($item->isNotLoaded())
        {
            $messages->addError(__('Mutual is invalid.'));
            $this->forward('app_mutual','ajaxListPartialMutualPartner');
        }    
        $this->item = new MutualPartnerContact();
        $this->item->set('company_id',$item);
        $this->form = new MutualPartnerContactNewForm();    
        try
        {
            if ($request->isMethod('POST') && $request->getPostParameter('MutualPartnerContact'))
            {
                $this->form->bind($request->getPostParameter('MutualPartnerContact'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Contact already exists."));
                    $this->item->save();
                    $messages->addInfo(__("Contact [%s] has been saved",(string)$this->item));                   
                    $this->forward("app_mutual","ajaxListMutualPartnerContact");
                }    
                else
                {
                    $messages->addError(__("Form has some errors."));   
                    $this->item->add($request->getPostParameter('MutualPartnerContact'));      
                }    
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
