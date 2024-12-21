<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterClassPricingViewForm.class.php';

class app_domoprime_ajaxSavePricingForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
       
       $this->item = new DomoprimePolluterClassPricing($request->getPostParameter('PolluterClassPricing'));         
       if ($this->item->isNotLoaded())
           return ;
        $this->form = new DomoprimePolluterClassPricingViewForm($this->getUser(),$request->getPostParameter('PolluterClassPricing'));    
        try
        {
            if (!$request->isMethod('POST') || !$request->getPostParameter('PolluterClassPricing'))
              return ; 
                $this->form->bind($request->getPostParameter('PolluterClassPricing'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());                
                    if ($this->item->isExist())
                        throw new mfException(__("Pricing already exists."));
                    $this->item->save();
                    $messages->addInfo(__("Price for class [%s] and pulluter [%s] has been saved",array((string)$this->item->getClass()->getI18n(),$this->item->getPolluter()->get('name'))));  
                    $request->addRequestParameter('polluter',$this->item->getPolluter());
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
