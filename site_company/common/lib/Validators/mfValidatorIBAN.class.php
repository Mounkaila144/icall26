<?php

// http://www.ibanbic.be/IBANBIC.asmx?WSDL
// http://www.ibanbic.be/IBANBIC.asmx?op=controleIBAN
class mfValidatorIBAN extends mfValidatorBase {
    
    protected static $parameters=array();
    
    protected function configure($options = array(), $messages = array())
    {
     $this->addOption('country');
     $this->addMessage('country', $this->translateMessages('country [{country}] is not supported.'));      
     $this->addMessage('lenght', $this->translateMessages('invalid length.'));         
     $this->addMessage('checksum', $this->translateMessages('invalid checksum.'));     
    }
    
    protected function doIsValid($value) {
        $iban = ltrim(strtoupper($value));
        $iban = preg_replace('/[^A-Z0-9]/','',$iban); // Remove space ...
        if ($this->hasOption('country'))
            $country=strtolower($this->getOption('country'));
        else
            $country=$this->getCountry($iban);               
        if (!in_array(strtoupper($country), mfCountryInfo::getCountries()))
           throw new mfValidatorError($this, 'invalid');       
        if (!in_array($country, mfCultureBank::getCountrySupported()))
           throw new mfValidatorError($this, 'country', array('country' => $country));          
        if (!$this->loadIBANParameters($country))
           throw new mfValidatorError($this, 'country', array('country' => $country));   
        if (strlen($iban)!=$this->getParameter('iban_length'))
           throw new mfValidatorError($this, 'lenght', array());
        $checksum = $this->getChecksum($iban);
        $regex ='/'.$this->getParameter('iban_format_regex').'/';
        if(!preg_match($regex,$iban)) 
           throw new mfValidatorError($this, 'invalid', array());  
        if(!$this->verifyChecksum($iban)) 
            throw new mfValidatorError($this, 'checksum', array());   
        return $iban;       
    }
    
    protected function getParameter($name,$default=null)
    {
        return isset($this->parameters[$name])?$this->parameters[$name]:$default;
    }
    
    protected function loadIBANParameters($country)
    {
        $this->parameters=mfCultureBank::getInstance($country)->getInformation('iban');
        return ($this->parameters!=null);
    }
    
    protected function getCountry($iban) {
        return strtolower(substr($iban,0,2));
    }
    
    protected function getChecksum($iban) {
          return substr($iban,2,2);
    }
    
    protected function verifyChecksum($iban) {
         # move first 4 chars (countrycode and checksum) to the end of the string
        $tempiban = substr($iban, 4).substr($iban, 0, 4);
        # subsitutute chars
        $tempiban = $this->checksumStringReplace($tempiban);
        # mod97-10
        $result = $this->mod97_10($tempiban);
        # checkvalue of 1 indicates correct IBAN checksum
        if ($result != 1) 
            return false;
        return true;
     }
    
    protected function checksumStringReplace($s) {
        $chars = range('A','Z');
        foreach (range(10,35) as $tempvalue) 
        { 
             $values[]=strval($tempvalue); 
        }
        return str_replace($chars,$values,$s);
    }
    
    protected function mod97_10($s) {
        $checksum = intval(substr($s, 0, 1));
        for ($pos = 1; $pos < strlen($s); $pos++) {
            $checksum *= 10;
            $checksum += intval(substr($s, $pos, 1));
            $checksum %= 97;
        }
        return $checksum;
    }
    
}

