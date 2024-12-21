<?php


class mfValidatorTextDateI18nSchema extends mfValidatorString {
    
    protected $form=null;
    
    protected function configure($options = array(), $messages = array()) 
    { 
        $this->setOption("separator",";");
        $this->addMessage('bad_dates', $this->translateMessages('{dates} are invalid.'));
        parent::configure($options, $messages);       
    }

    protected function doIsValid($value) 
    {          
        $values = explode($this->getOption("separator",";"), $value);        
        $this->form = new mfTextDateI18nForm(array("dates"=>$values));        
        $this->form->bind(array("dates"=>$values));
        if($this->form->isValid())
        {
            return $this->form->getValue("dates");
        }
        $errors=new mfArray();
        foreach ($this->form->dates->getErrorSchema()->getErrors() as $error)
             $errors[]=(string)$error;          
        throw new mfValidatorError($this, 'bad_dates', array('dates'=>$errors->implode()));      
    }
    
    function getDates()
    {
        return $this->form['dates'];
    }   
      
    function getErrorsAsString()
    {
        $errors=new mfArray();
        foreach ($this->getDates() as $date)
        {
            if ($date->hasError())
               $errors[]="[".(string)$date."]";
            else
              $errors[]=(string)$date;  
        }   
        return $errors->implode(";");
    }
    
}