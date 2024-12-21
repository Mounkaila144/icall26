<?php


class CustomerFormatter extends mfFormatter {
     

     function getMobile1()
     {
         return new PhoneE164Formatter($this->getValue()->get('mobile'));
     }
     
     function getBirthday()
     {
         return new DateFormatter($this->getValue()->get('birthday'));
     }
     
     function getPhone()
    {
        return mfString::splitter($this->getValue()->get('phone'));
    }
    
    function getMobile()
    {
        return mfString::splitter($this->getValue()->get('mobile'));
    }
    
    function getFirstname()
    {
         return new mfString($this->getValue()->get('firstname'));
    }
    
    function getLastname()
    {
         return new mfString($this->getValue()->get('lastname'));
    }
    

    
}
