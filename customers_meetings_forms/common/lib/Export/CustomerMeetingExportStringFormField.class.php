<?php


class CustomerMeetingExportStringFormField extends mfString {
    
    
  
    function split($length=1)
     {
         $values=new mfArray(str_split($this->value,$length));
         //$values['exist']=$this->value?"1":"0";
         return $values;
     }  
}
