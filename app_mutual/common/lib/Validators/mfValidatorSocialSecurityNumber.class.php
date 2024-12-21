<?php

class mfValidatorSocialSecurityNumber extends mfValidatorRegex {
    
    /* 1681176540295 */
    /* 1-68-11-76-540-295 */
    /*
     * '/^([1-4]|[7-8]) #gender
                        ([00-99])       #last 2 digits in the year of birthday
                        ([01-12]|[62-63]) #monthe of the birthday
                        ((([01-19]|[21-95]|[96-99]|(2A|2B))[001-989]) #casA LN
                        |([970-989][01-89]|[90]) #casB LN
                        |([99]([001-989]|[990])) #casC LN
                        )
                        ([001-999])              #Numéro d"ordre de naissance
                        (\d{2})?)$/x'
    */
    const REGEX_SOCIAL_SECURITY_NUMBER ='/^([1-4]|[7-8]) #gender
                        ([00-99])       #last 2 digits in the year of birthday
                        ([01-12]|[62-63]) #monthe of the birthday
                        ((([01-19]|[21-95]|[96-99]|(2A|2B))[001-989]) #casA LN
                        |([970-989][01-89]|[90]) #casB LN
                        |([99]([001-989]|[990])) #casC LN
                        )
                        ([001-999])              #Numéro d"ordre de naissance
                        (\d{2})?)$/x';

    protected function configure($options = array(), $messages = array()) { 
        $this->setOption('upper', false);
        parent::configure($options, $messages);
        $this->setValidatorName(strtolower(str_replace("mfValidator","",get_class())));
        $this->setOption('pattern', self::REGEX_SOCIAL_SECURITY_NUMBER);
        $this->setOption('remove_space',true);
    }

    protected function doIsValid($value) {
        $clean = parent::doIsValid($value);       
        if ($this->getOption('remove_space'))
            $clean=str_replace(" ","",$clean);
        if ($this->getOption('upper'))
            $clean=strtoupper($clean);          
        return $clean;
    }

}