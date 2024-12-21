<?php

/*
 * nombre total : max_length
 * nombre speciaux
 * nombre chiffre
 * 
*/

class mfValidatorSecurePassword extends mfValidatorString {
    
    protected $number_of_digit=0,$number_of_upper=0,$number_of_special=0;
	
    protected function configure($options = array(),$messages=array()) { 
        $this->addOption('number_of_special',$options['number_of_special']?$options['number_of_special']:1);
        $this->addOption('number_of_digit',$options['number_of_digit']?$options['number_of_digit']:2);
        $this->addOption('number_of_upper',$options['number_of_upper']?$options['number_of_upper']:1);
        $this->addOption('special_list',$options['special_list']?$options['special_list']:"#'()@[]{}=+*/.!;?,:$&");        
        $this->addOption('must_match', true);       
        parent::configure($options,$messages);
        $this->setMessage('invalid', $this->getInvalidMessage());  
        $this->addMessage('default',"The password must contain %s, %s, %s from list [%s]");          
    }
    
    protected function process($clean)
    {		
        for($i=0;$i<strlen($clean);$i++)
        {
            if (!$this->isNotRange($clean[$i],'0','9'))				
                $this->number_of_digit++;
            if (!$this->isNotRange($clean[$i],'A','Z'))
                $this->number_of_upper++;		
            if (strpos($this->getOption('special_list'),$clean[$i])!==false)
                $this->number_of_special++;        
        }
        return $this;
    }
    
    function isNumberOfDigitsValid()
    {
        return $this->getNumberOfDigits() >= $this->getOption('number_of_digit');
    }
    
    function isNumberOfUpperCaseValid()
    {
        return $this->getNumberOfUpperCase() >= $this->getOption('number_of_upper');
    }
    
    function isNumberOfSpecialCharsValid()
    {
        return $this->getNumberOfSpecialChars() >= $this->getOption('number_of_special');
    }
	
    function isChecked()
    {
        if(!$this->isNumberOfDigitsValid()) 
            return false;
        if(!$this->isNumberOfUpperCaseValid())
            return false;
        if(!$this->isNumberOfSpecialCharsValid())
            return false;
        return true;
    }   
    
    protected function isNotRange($val,$from,$to)
    {
        return $val < $from || $val > $to;
    }

    function getNumberOfDigits()
    {
        return $this->number_of_digit;
    }
	
    function getNumberOfUpperCase()
    {
        return $this->number_of_upper;
    }
    
    function getNumberOfSpecialChars()
    {       
        return $this->number_of_special;
    }
    
    function getInvalidMessage()
    {
        $message=__("The password must contain ");
        if(!$this->isNumberOfDigitsValid()) 
            $message.=" ".format_number_choice('[0]no number|[1]one number|(1,Inf]%s numbers',$this->getOption('number_of_digit'),$this->getOption('number_of_digit'));
        if(!$this->isNumberOfUpperCaseValid()) 
            $message.=" ".format_number_choice('[0]no uppercase|[1]one uppercase|(1,Inf]%s uppercases',$this->getOption('number_of_upper'),$this->getOption('number_of_upper'));
        if(!$this->isNumberOfSpecialCharsValid()) 
            $message.=" ".format_number_choice('[0]no special char|[1]one special char|(1,Inf]%s special chars',$this->getOption('number_of_special'),$this->getOption('number_of_special')).__(" from list [{special_list}]");                    
        return $message;
    }
    
    function getDefaultMessage()
    {       
        $message=__($this->getMessage('default'),
                array(
                format_number_choice('[0]no number|[1]one number|(1,Inf]%s numbers',$this->getOption('number_of_digit'),$this->getOption('number_of_digit')),
                format_number_choice('[0]no uppercase|[1]one uppercase|(1,Inf]%s uppercases',$this->getOption('number_of_upper'),$this->getOption('number_of_upper')),
                format_number_choice('[0]no special char|[1]one special char|(1,Inf]%s special chars',$this->getOption('number_of_special'),$this->getOption('number_of_special')),
                $this->getOption('special_list')));
        return $message;
    }
    
    protected function doIsValid($value) {
        $clean = parent::doIsValid($value);
        $this->process($clean);
        if(!$this->isChecked())
        {
            $this->setMessage('invalid', $this->getInvalidMessage());                          
            throw new mfValidatorError($this, 'invalid', array('number_of_special'=> $this->getOption('number_of_special'),
                                                               'number_of_digit'=> $this->getOption('number_of_digit'),
                                                               'number_of_upper'=> $this->getOption('number_of_upper'),
                                                               'special_list'=> $this->getOption('special_list'), 
                                                               'value'=>$clean
                                                            ));
        }
        return $clean;
    }
}
