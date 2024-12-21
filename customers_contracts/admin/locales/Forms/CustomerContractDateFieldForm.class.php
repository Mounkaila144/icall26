<?php

 require_once __DIR__."/CustomerContractEditDateFieldForm.class.php";
 
class CustomerContractDateFieldForm extends CustomerContractEditDateFieldForm {
    
    
    function configure() {
        parent::configure();
        $this->setValidator('value',new mfValidatorI18nDate(array('date_format'=>"a")));
        $this->validatorSchema->setPostValidator(new mfValidatorCallbacks(new mfArray(array(array($this, 'check')))));
    }
    
     function getValuesForView()
     {
         $values=parent::getValues();
         unset($values['value']);    
         $values['id']=$this->getContract()->get('id');
         $values['token']=mfForm::getToken('CustomerContractEditDateFieldForm');
         return $values;
     }
     
     function check($validator,$values)
     {
         if ($this->hasErrors())
             return $values;
         $this->contract=$values['id'];        
         $this->contract->set($values['field'],$values['value']);         
         if (!$this->getEngine()->isValid())
            throw new mfValidatorErrorSchema($validator,array('value'=>new mfValidatorError($validator,$this->getEngine()->getErrors()->implode())));     
         $this->contract->set('dates_is_valid',$this->getEngine()->getDates()->isValid()?"YES":"NO");         
         return $values;
     }
     
      function getContract() {
         if ($this->contract===null)
         {    
            $this->contract=$this['id']->getValue();
            $this->contract->set($this['field']->getValue(),$this->getValue('value'));                
         }
         return $this->contract;
     }
     
     function getEngine()
     {
         return $this->engine=$this->engine===null?new CustomerContractDatesCheckerEngine($this->getContract()):$this->engine;
     }
          
 
}

