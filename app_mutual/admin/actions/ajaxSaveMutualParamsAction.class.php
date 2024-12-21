<?php

require_once dirname(__FILE__)."/../locales/Forms/MutualPartnerParamsViewForm.class.php";

class app_mutual_ajaxSaveMutualParamsAction extends mfAction {
 
    function execute(mfWebRequest $request) {        
        
        $messages = mfMessages::getInstance();   
        $this->mutual = new MutualPartner($request->getPostParameter('MutualPartner'));  
        
        if ($this->mutual->isNotLoaded())
        {
            $messages->addError(__('Mutual is invalid.'));
            $this->forward ('app_mutual','ajaxListPartialMutualPartner');
        }        
        $this->item = new MutualPartnerParams($request->getPostParameter('MutualPartnerParams'));               
        $this->form = new MutualPartnerParamsViewForm($request->getPostParameter('MutualPartnerParams'));  
        try
        {           
            $this->form->bind($request->getPostParameter('MutualPartnerParams'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                $this->item->save();
                $messages->addInfo(__("Params [%s] has been saved.",$this->item->get('taxe')));  
                $request->addRequestParameter('MutualPartner', $this->item->getMutualPartner());
                $this->forward("app_mutual","ajaxListMutualPartner");
            }    
            else
            {
                $messages->addError(__("Form has some errors."));   
                $this->item->add($request->getPostParameter('MutualPartnerParams'));
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
