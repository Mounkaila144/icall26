<?php


class DomoprimeSimulationEngine extends DomoprimeSimulationEngineCore {
     
   
    function configure()
    {        
        $this->has_prime_one_euro=false;
        if ($this->getSimulation()->hasContract())
        {    
           $this->request=new DomoprimeCustomerRequest($this->getSimulation()->getContract());         
           // detect changement surfaces            
           if ($this->request->getSurfacesChanged($this->getSimulation()->getProductsSurfaces())->isEmpty())
           {
               $this->calculation=new DomoprimeCalculation($this->getSimulation()->getContract());
           }    
           else
           {
               $this->request->setSurfacesChanges($this->getSimulation()->getProductsSurfaces());
               $this->request->save();
               // Message warning 
                $engine=new DomoprimeIsoEngine($this->getSimulation()->getContract());
                $engine->process();  
                $this->calculation=new DomoprimeCalculation($engine);
                $this->calculation->process($this->getUser());  
           }              
        }   
        elseif ($this->getSimulation()->hasMeeting())
        {    
           $this->request=new DomoprimeCustomerRequest($this->getSimulation()->getMeeting());    
           if ($this->request->getSurfacesChanged($this->getSimulation()->getProductsSurfaces())->isEmpty())
           {
               $this->calculation=new DomoprimeCalculation($this->getSimulation()->getMeeting());
           }    
           else
           {
               $this->request->setSurfacesChanges($this->getSimulation()->getProductsSurfaces());
               $this->request->save();
               // Message warning 
                $engine=new DomoprimeIsoEngine($this->getSimulation()->getMeeting());
                $engine->process();  
                $this->calculation=new DomoprimeCalculation($engine);
                $this->calculation->process($this->getUser());  
           } 
        }
        if ($this->request->isNotLoaded())
            throw new DomoprimeSimulationEngineException(DomoprimeSimulationEngineException::ENGINE_ERROR_REQUEST_INVALID);
        if ($this->calculation->isNotLoaded())
            throw new DomoprimeSimulationEngineException(DomoprimeSimulationEngineException::ENGINE_ERROR_CALCULATION_INVALID);
    }
        
        
    function process()
    {             
        // 	
        $this->number_of_people=$this->request->get('number_of_people'); 
        $this->number_of_children=$this->request->get('number_of_children');
        $this->tax_credit_used=$this->request->get('tax_credit_used');
        $this->rest_in_charge= $this->getSimulation()->get('total_sale_with_tax') - $this->getCalculation()->get('qmac_value'); 
        if ($this->rest_in_charge > 0)
        {             
           $this->has_prime_one_euro=false;
           $this->rest_in_charge_after_credit=0.0;
           $this->prime=$this->getCalculation()->get('qmac_value');
           $settings= ServiceImpotSettings::load();
           $limit=0.0;
           if ($this->getNumberOfPeople() == 1)
               $limit= $settings->get('limit_one_person');
           elseif ($this->getNumberOfPeople() == 2)
               $limit= $settings->get('limit_two_person');   
           else
               $limit=$settings->get('limit_one_person') * 2; //$this->getNumberOfPeople();
           $limit+=  $this->getNumberOfChildren() * $settings->get('limit_added_person');  
           // tax_credit_available = 30% limit - utilisation
           
           $this->tax_credit_limit=$limit ;           
           $limit=$this->tax_credit_limit * $settings->get('rate')  - $this->tax_credit_used;
           $this->rest_in_charge= $this->getSimulation()->get('total_sale_with_tax') - $this->getCalculation()->get('qmac_value'); 
           $tax_work= $settings->get('rate') * $this->rest_in_charge ;           
           $this->tax_credit= $tax_work > $limit ? $limit:$tax_work;                      
           $this->rest_in_charge_after_credit= $this->rest_in_charge - $this->tax_credit;
        }
        else
        {
            $settings=DomoprimeSettings::load();
            $this->rest_in_charge=$settings->getRestInCharge();    
            $this->prime= $this->getSimulation()->get('total_sale_with_tax') - $settings->getRestInCharge();
            $this->has_prime_one_euro=true;
            $this->rest_in_charge_after_credit=0.0;
        }         
        $this->getSimulation()->set('qmac_value',$this->getCalculation()->get('qmac_value'));
        $this->getSimulation()->set('prime',$this->getPrime());
        $this->getSimulation()->set('one_euro',$this->hasPrimeOneEuro()?"YES":"NO");
        $this->getSimulation()->set('tax_credit_used',$this->getTaxCreditUsed());
        $this->getSimulation()->set('tax_credit',$this->getTaxCredit());
        $this->getSimulation()->set('number_of_people',$this->getNumberOfPeople());
        $this->getSimulation()->set('number_of_children',$this->getNumberOfChildren());
        $this->getSimulation()->set('rest_in_charge',$this->getRestInCharge());
        $this->getSimulation()->set('rest_in_charge_after_credit',$this->getRestInChargeAfterCredit());
        $this->getSimulation()->set('tax_credit_limit',$this->getTaxCreditLimit());                
        return $this;
    }
    
    
   
    
}
