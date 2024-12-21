<?php


  require_once dirname(__FILE__)."/../locales/Forms/DomoprimeEnergyAffectationForm.class.php";
 
class  app_domoprime_ajaxSaveEnergyAffectationAction extends mfAction {
 
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new DomoprimeEnergyAffectationForm($this->getUser(),$request->getPostParameter('DomoprimeEnergy'));                    
        try
        {            
           
            $this->form->bind($request->getPostParameter('DomoprimeEnergy'));                            
            if ($this->form->isValid())
               
            {   
                if($this->form['current_energy_id']->getValue()==$this->form['energy_id']->getValue())
                {    
                    $messages->addInfo(__('Energy is aleardy affected.'));    
                    
                }
                else{
                $customer_resquest= new DomoprimeCustomerRequest($current_energy_id);
                $customer_resquest->affectNewEnergy($this->form['current_energy_id']->getValue(),$this->form['energy_id']->getValue());
                }
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
              
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

