<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerAttributions2Form.class.php";



class customers_contracts_ajaxSaveAttributions2Action extends mfAction {
      
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract')); 
        if ($this->contract->isNotLoaded())
            return ;
        $this->form= new CustomerAttributions2Form($this->contract,$this->user,$request->getPostParameter('Attributions'));    
        if (!$request->isMethod('POST') || !$request->getPostParameter('Attributions'))
           return ;
        try
        {
            $this->form->bind($request->getPostParameter('Attributions'));
            if ($this->form->isValid())
            {              
                foreach ($this->contract->getAllContributors() as $contributor)
                {                   
                    if ($this->form->contributors->hasValidator($contributor->get('type')))
                    {                           
                        $contributor->add($this->form->getContributor($contributor->get('type')));                                    
                        $contributor->save();                                
                        $this->contract->set($contributor->get('type')."_id",(int)$contributor->get(($contributor->get('type')=='team'?'team_id':'user_id')));                                                    
                    }
                }             
                $this->contract->setComments($this->getUser());   
                $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.change.attribution.before.save',array('action'=>'attribution')));                   
                $this->contract->save();
                $messages->addInfo(__("Attributions have been updated."));                
                $this->forward('customers_contracts', 'ajaxListAttributions2');
            }   
            else
            {
                  // var_dump($this->form->getErrorSchema()-> getErrorsMessage());
                  $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
           $messages->addError($e);  
        }
    }

}
