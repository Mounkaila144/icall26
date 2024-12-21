<?php

class ConnectedAsActiveUserByFunctionForm extends mfForm {

    protected $functions=array(),$users=null;
    
    function configure()
    {
        $this->functions=UserUtils::getActiveUsersSortedByLastnameAndFunctionForSelect();
        $this->setValidators(array(
            'user_id'=>new mfValidatorChoice(array('choices'=>$this->getUsersForChoices()))
        ));
    }
    
    function getActiveUsersSortedByLastnameAndFunctionForSelect()
    {
        return $this->functions;
    }
    
    function getUsersForChoices()
    {
        if ($this->users===null)
        {    
            $this->users=array();
            foreach ($this->functions as $function)
            {                
               foreach ($function as $id=>$user)              
                   $this->users[]=$id;                                
            }
        }       
        return $this->users;
    }
    
}