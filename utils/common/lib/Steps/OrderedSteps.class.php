<?php

class OrderedSteps extends steps  {
    
    const stepClass="Step";
    
    protected $current="",$steps_authorized=array(),$next_authorized=null,$previous_authorized=null;
    
    function __construct($steps)
    {
        $class=static::stepClass;
        foreach ($steps as $name=>$step)
        {    
           $this->steps[$name]=new $class($name,$step);                       
        }   
    }    
     
    function nextFromStep($step)
    {             
       $this->moveToStep($step);
       return $this->findNext();
    }
    
     protected function findNextAuthorized()
    {        
        // Find enabled next
        while (key($this->steps))
        {                   
            $next_step=next($this->steps);
            if ($next_step && $next_step->isEnabled() && $next_step->isAuthorized())
                return $next_step;            
        }   
        return null;
    }  
    
    protected function findNext()
    {        
        // Find enabled next
        while (key($this->steps))
        {                   
            $next_step=next($this->steps);
            if ($next_step && $next_step->isEnabled())
                return $next_step;            
        }   
        return null;
    }   
    
    protected function findPreviousAuthorized()
     {                 
        // get Enabled Previous           
        while (key($this->steps))
        {          
            prev($this->steps);  
            $step=current($this->steps);
            if ($step && $step->isEnabled() && $step->isAuthorized())
                return $step;
        }  
        return null;
     }
     
    protected function findPrevious()
     {                 
        // get Enabled Previous           
        while (key($this->steps))
        {          
            prev($this->steps);  
            $step=current($this->steps);
            if ($step && $step->isEnabled())
                return $step;
        }  
        return null;
     }
     
    protected function moveToStep($step)
    {
       // deplace le pointeur sur le step
        reset($this->steps);
        while (key($this->steps))
        {
            $current=current($this->steps);           
            if ($step->get('name')==$current->get('name'))
                break; 
            next($this->steps);               
        }  
    }    
    
     protected function findNextStep()
     {
         // deplace le pointeur sur le current
        $this->moveToStep($this->current);
        $this->next=$this->findNext();
        return $this;
     }        
     
     protected function findPreviousStep()
     {  
         $this->moveToStep($this->current);
         $this->previous=$this->findPrevious();
         return $this;
     }    
     
     protected function findNextStepAuthorized()
     {
         // deplace le pointeur sur le current
        $this->moveToStep($this->current);
        $this->next_authorized=$this->findNextAuthorized();
        return $this;
     }   
     
      protected function findPreviousStepAuthorized()
     {  
         $this->moveToStep($this->current);
         $this->previous_authorized=$this->findPreviousAuthorized();
         return $this;
     }   
     
     function getPreviousAuthorized()
     {
         return $this->previous_authorized;
     }
     
      function getNextAuthorized()
     {
         return $this->next_authorized;
     }
     
     function getStepFromRoute($route)
     {
         foreach ($this->steps as $step)
         {    
              if (in_array($route,(array)$step->get('routes')))
                  return $step;               
         }
         return null;
     }            
     
     function setCurrent($route)
     {    
         $this->current=null;      
         if (($this->current=$this->getStepFromRoute($route)))
         {            
             $this->findPreviousStep();
             $this->findNextStep();
             $this->findPreviousStepAuthorized();
             $this->findNextStepAuthorized();
             $this->setCurrentStep();
             $this->reNumbering();
         }        
         return $this;
     }       
     
     function update()
     {
        $this->findPreviousStep();
        $this->findNextStep();
        $this->findPreviousStepAuthorized();
        $this->findNextStepAuthorized();
        $this->setCurrentStep();
        $this->reNumbering();   
     }
     
     protected function setCurrentStep()
     {        
        foreach ($this->steps as $step)
        {                             
            $step->set('isCurrent',($this->getCurrent()->get('name')==$step->get('name')));            
        }       
     }    
     
     function reNumbering()
     {
        $index=1;       
        foreach ($this->steps as $step)
        {
            if ($step->isEnabled())
            {    
                $step->set('position',$index++); 
                $end_step=$step;                 
            }
        }              
        $end_step->set('isLast',true);
        return $this;
     }   
     
  /*   function isCurrentStep($step)
     {        
         return ($this->getCurrent()->get('name')==$step->get('name'));
     }*/
     
     function getCurrent()
     {
         return $this->current;
     }
     
     function getFirst()
     {
         reset($this->steps);
         return current($this->steps);
     }
     
     function getComponents()
     {
        $components=array();
        foreach ($this->steps as $name=>$step)
        {
            if ($step->get('component'))
            {    
                $components[$name]=$step->get('component');                                    
            }    
        }  
        return $components;
     }
     
     function unAuthorizedAfter($step)
     {         
         $this->moveToStep($step);
         while (key($this->steps))
         {
            $currentStep=current($this->steps);                       
            $currentStep->notAuthorized();
            next($this->steps);               
         }    
     }
}

