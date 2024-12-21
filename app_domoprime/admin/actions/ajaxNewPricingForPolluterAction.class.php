<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterClassPricingNewForm.class.php';

class app_domoprime_ajaxNewPricingForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->polluter = new PartnerPolluterCompany($request->getPostParameter('Polluter')); // new object 
        if ($this->polluter->isNotLoaded())
        {
            $messages->addError(__('Polluter is invalid.'));
            $this->forward ('app_domoprime','ajaxListPartialPollutingCompany');
        }    
        $this->item = new DomoprimePolluterClassPricing();         
        $this->form = new DomoprimePolluterClassPricingNewForm($this->getUser(),$request->getPostParameter('PolluterClassPricing'));    
        try
        {
            if (!$request->isMethod('POST') || !$request->getPostParameter('PolluterClassPricing'))
              return ; 
                $this->form->bind($request->getPostParameter('PolluterClassPricing'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    $this->item->set('polluter_id',$this->polluter);
                    if ($this->item->isExist())
                        throw new mfException(__("Pricing already exists."));
                    $this->item->save();
                    $messages->addInfo(__("Price for class [%s] and pulluter [%s] has been saved",array((string)$this->item->getClass()->getI18n(),$this->polluter->get('name'))));  
                    $request->addRequestParameter('polluter',$this->polluter);
                    $this->forward("app_domoprime","ajaxListPartialPricingForPolluter");
                }    
                else
                {
                     $messages->addError(__("Form has some errors."));   
                     $this->item->add($this->form->getDefaults()); // repopulate        
                }                 
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }
}
