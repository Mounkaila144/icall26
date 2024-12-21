<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerAttributionsForm.class.php";



class customers_contracts_ajaxSaveAttributionsAction extends mfAction {
      
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->contract=new CustomerContract($request->getPostParameter('Contract')); 
        if ($this->contract->isNotLoaded())
            return ;
        $this->form= new CustomerAttributionsForm($this->contract,$this->user);    
        if (!$request->isMethod('POST') || !$request->getPostParameter('Attributions'))
           return ;
        try
        {
            $this->form->bind($request->getPostParameter('Attributions'));
            if ($this->form->isValid())
            {              
                foreach ($this->contract->getContributors() as $contributor)
                {                   
                    if ($this->form->contributors->hasValidator($contributor->get('type')))
                    {    
                        $contributor->add($this->form->getContributor($contributor->get('type')));                                    
                        $contributor->save();                  
                        $this->contract->set($contributor->get('type')."_id",(int)$contributor->get('user_id'));
                    }
                }                                 
                if ($this->form->hasValidator('team_id'))
                {                  
                    $this->contract->set('team_id',(string)$this->form['team_id']);
                }                
                $this->contract->setComments($this->getUser());   
                $this->getEventDispather()->notify(new mfEvent($this->contract, 'contract.change.attribution.before.save',array('action'=>'attribution')));                                  
                $this->contract->save();
                $messages->addInfo(__("Attributions have been updated."));                
                $this->forward('customers_contracts', 'ajaxListAttributions');
            }   
            else
            {
                  echo "<!--";  var_dump($this->form->getErrorSchema()-> getErrorsMessage());  echo "-->";
                  $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
           $messages->addError($e);  
        }
    }

}