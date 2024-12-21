<?php
require_once dirname(__FILE__).'/../locales/Forms/CustomerContractPollutingViewForm.class.php';

class app_domoprime_ajaxSavePollutingAction extends mfAction{
    
    function execute(mfWebRequest $request){
       
        
        $messages = mfMessages::getInstance();     
        $this->item = new PartnerPolluterCompany($request->getPostParameter('Polluting')); // new object       
        $this->form = new CustomerContractPollutingViewForm($this->getUser(),$request->getPostParameter('Polluting'));  
        $this->getEventDispather()->notify(new mfEvent($this->form, 'polluter.view.form'));     
        $this->form->bind($request->getPostParameter('Polluting'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues()); // repopulate     
                if ($this->item->isExist())
                    throw new mfException(__("Polluting already exists."));
                $this->item->save();
                $messages->addInfo(__("Polluting [%s] has been saved",$this->item->get('name')));                   
                $this->forward("app_domoprime","ajaxListPartialPollutingCompany");
            }    
            else
            {
                 $messages->addError(__("Form has some errors."));   
                 $this->item->add($request->getPostParameter('Polluting')); // repopulate      
               //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }
    
}
