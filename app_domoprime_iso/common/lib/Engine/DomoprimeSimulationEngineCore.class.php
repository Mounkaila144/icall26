<?php


abstract class DomoprimeSimulationEngineCore {
     
    protected $simulation=null,$calculation=null,$user=null,$prime=0,$number_of_people=0,
              $tax_credit_used=0,$request=null,$number_of_children=0,
              $rest_in_charge=0.0,$tax_credit_limit=0.0,$rest_in_charge_after_credit=0.0;    
    
    abstract function process();
    
    function __construct(DomoprimeSimulation $simulation) {       
        $this->simulation=$simulation;
        $this->user=$simulation->getCreator();
        $this->configure();
    }
    
     function getSimulation()
    {
        return $this->simulation;
    }
   
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
        
    }
        
    function getQuotation()
    {
        return $this->quotation;
    }
    
    
     function getPrime()
    {
        return $this->prime;
    }
    
    function hasPrimeOneEuro()
    {
        return $this->has_prime_one_euro;
    }
    
    function getTaxCredit()
    {
        return $this->tax_credit;
    }
    
    function getNumberOfPeople()
    {
        return $this->number_of_people;
    }
    
     function getNumberOfChildren()
    {
        return $this->number_of_children;
    }
    
    
     function getRestInCharge()
    {
        return $this->rest_in_charge;
    }
    
    function getTaxCreditUsed()
    {
        return $this->tax_credit_used;
    }
    
    function getCalculation()
    {
        return $this->calculation;
    }
    
    
     function getRestInChargeAfterCredit()
    {
        return $this->rest_in_charge_after_credit;
    }
    
    function getTaxCreditLimit()
    {
        return $this->tax_credit_limit;
    }
}
