<?php

class DomoprimeAhDocumentEngine {
    
    
     protected static $instance=null,$engines=array(),$contract=null;    
     
     function __construct(CustomerContract $contract,$type) {
         $this->type=$type;
         $this->contract=$contract;
         $this->site=$contract->getSite();
     }
     
     function getCOntract()
     {
         return $this->contract;
     }
     
     function getSite()
     {
         return $this->site;
     }
     
     function getType()
     {
         return $this->type;
     }
     
     function getSettings()
     {
         return $this->settings=$this->settings===null?new DomoprimeSettings(null,$this->getSite()):$this->settings;
     }
          
     function getClass()
     {
          if ($this->getType()=='ITE')
                 $class="Domoprime".($this->getSettings()->get('ite_ah_document_engine')?$this->getSettings()->get('ite_ah_document_engine'):"ITEDocument")."Engine";
            elseif ($this->getType()=='PAC')
                 $class="Domoprime".($this->getSettings()->get('pack_ah_document_engine')?$this->getSettings()->get('pack_ah_document_engine'):"PackDocument")."Engine";
            elseif ($this->getType()=='BOILER')
                $class="Domoprime".($this->getSettings()->get('boiler_ah_document_engine')?$this->getSettings()->get('boiler_ah_document_engine'):"BoilerDocument")."Engine";
            elseif ($this->getType()=='ISO')
               $class="Domoprime".($this->getSettings()->get('iso_ah_document_engine')?$this->getSettings()->get('iso_ah_document_engine'):"IsoDocument")."Engine";
            elseif ($this->getType()=='TYPE1')
               $class="Domoprime".($this->getSettings()->get('type1_ah_document_engine')?$this->getSettings()->get('type1_ah_document_engine'):"Type1Document")."Engine";
            return $class;
     }
    
     function getEngine()
     {
         if ($this->engines[$this->getType()]===null)
         {
             $class=$this->getClass();
             if (!class_exists($class))
                 throw new mfException(__('Engine [%s] is invalid.',$this->getType()));
             $this->engines[$this->getType()]=new $class($this->getContract());            
         }   
         return $this->engines[$this->getType()];
     }
}
