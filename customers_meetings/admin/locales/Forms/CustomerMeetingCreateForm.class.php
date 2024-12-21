<?php



class CustomerMeetingCreateForm extends mfForm {
         
   
    
    function configure()
    {            
       $this->setValidators(array(
            'address'=>new mfValidatorString(),           
            'postcode'=>new mfValidatorString(),
            'city'=>new mfValidatorString(),
            'firstname' => new mfValidatorName(), 
            'lastname' => new mfValidatorName(), 
            'email' => new mfValidatorEmail(array('required'=>false)),                                  
            'phone'=>new mfValidatorIntegerString(array('min_length'=>10,'max_length'=>10)),
            'mobile'=>new mfValidatorIntegerString(array('min_length'=>10,'max_length'=>10,'required'=>false)),   
        ));
       
    }
    
    function getValues() 
    {
       if ($this->isValid())
          $values=parent::getValues(); 
       else
            $values=$this->getDefaults();              
       $params=array();
       foreach (array('address1'=>'address','postcode','city') as $key=>$name)
       {        
           $key=is_numeric($key)?$name:$key;
           $params['address'][$key]=$values[$name];             
       }    
       foreach (array('firstname' ,'lastname','email' ,'phone','mobile') as $name)
           $params['customer'][$name]=$values[$name];       
       return $params;
    }
}

