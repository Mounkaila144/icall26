<?php

class mfOutputApi {
   protected $item=null;
   
   function __construct($item) {
       
       $this->item=$item;
   }
   
   
   function getItem(){
       
       return $this->item;
   }
           
    function getOutput($tpl=""){
       
        $output="";
        preg_match( "#\{(.*)\}#", $tpl,$matches);
        $tpl = new mfArray($matches[1]);  
        if ($tpl->glob('customer.address*')){
            $output=$this->getItem()->getCustomer()->getAddress()->getFormatter()->getOutput($tpl); 
        }                        
        if ($tpl[0]=='user.sales'){
             $output=$this->getItem()->getSale()->getFormatter()->getOutput($tpl); 
        }
        if ($tpl[0]=='user.sale2'){
            $output=$this->getItem()->getsale2()->getFormatter()->getOutput($tpl); 
        }                
        if ($tpl[0]=='user.telepro'){
            $output=$this->getItem()->getTelepro()->getFormatter()->getOutput($tpl);
        }          
        if ($tpl[0]=='user.assistant'){
            $output=$this->getItem()->getAssistant()->getFormatter()->getOutput($tpl);
        }          
        if ($tpl[0]=='user.team'){
            $output=$this->getItem()->getTeam();
        }          
        if ($tpl[0]=='user.campaign'){
            $output=$this->getItem()->getCampaign()->getFormatter()->getOutput($tpl);
        }          
        return $output;
   }
   
   
}
