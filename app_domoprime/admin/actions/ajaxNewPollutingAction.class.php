<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractPollutingCompanyWithContactNewFom.class.php";


class app_domoprime_ajaxNewPollutingAction extends mfAction{
    
    function execute(mfWebRequest $request){              
        $messages = mfMessages::getInstance();      
        $this->item = new PartnerPolluterContact(); // new object
        $this->item->set('company_id',new PartnerPolluterCompany());
        $this->form = new CustomerContractPollutingCompanyWithContactNewFom($this->getUser(),$request->getPostParameter('Polluting'));   
        $this->getEventDispather()->notify(new mfEvent($this->form, 'polluter.new.form'));     
        if ($request->getPostParameter('Polluting'))
        {
            try {
                $this->form->bind($request->getPostParameter('Polluting'));
                if ($this->form->isValid()){
                    $this->item->add($this->form['contact']->getValues());
                    $this->item->getCompany()->add($this->form['company']->getValues());
                    if ($this->item->getCompany()->isExist())
                        throw new mfException (__("Polluting already exists")); 
                    if ($this->item->isExist())
                        throw new mfException (__("Contact already exists")); 
                    $this->item->getCompany()->save();
                    $this->item->set('company_id',$this->item->getCompany());                                        
                    $this->item->save();
                    $messages->addInfo(__("Polluting [%s] has been saved.",array($this->item->getCompany()->get('name'))));                   
                    $this->forward("app_domoprime","ajaxListPartialPollutingCompany");
                }
                else
                {
                 //  echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo'</pre>';
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($this->form['contact']->getValues()); // repopulate
                   $this->item->getCompany()->add($this->form['company']->getValues()); // repopulate
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }
}
