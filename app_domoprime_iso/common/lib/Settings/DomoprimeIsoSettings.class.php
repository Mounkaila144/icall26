<?php

class DomoprimeIsoSettings extends DomoprimeSettings {
    
     protected static $instance=null;    
    
     function configure() {
         $this->name='DomoprimeSettings';
     }
     
     
     function getDefaults() {       
         parent::getDefaults();
         $this->add(array(
                    'mode'=>'FORM',
                    'simulation_reference_format'=>'',
                    'model_101_R1_id'=>null,
                    'model_102_R1_id'=>null,
                    'model_103_R1_id'=>null,
             
                    'model_101_R2_id'=>null,
                    'model_102_R2_id'=>null,
                    'model_103_R2_id'=>null,
             
                    'model_101_102_R1_id'=>null,
                    'model_101_102_R2_id'=>null,
             
                    'model_101_103_R1_id'=>null,
                    'model_101_103_R2_id'=>null,
             
                    'model_102_103_R1_id'=>null,
                    'model_102_103_R2_id'=>null,
             
                    'model_101_102_103_R1_id'=>null,
                    'model_101_102_103_R2_id'=>null, 
             
                    'model_101_R1_classic_id'=>null,
                    'model_102_R1_classic_id'=>null,
                    'model_103_R1_classic_id'=>null,
             
                    'model_101_R1_classic_id'=>null,
                    'model_102_R2_classic_id'=>null,
                    'model_103_R2_classic_id'=>null,
             
                    'model_101_102_R1_classic_id'=>null,
                    'model_101_102_R2_classic_id'=>null,
             
                    'model_101_103_R1_classic_id'=>null,
                    'model_101_103_R2_classic_id'=>null,
             
                    'model_102_103_R1_classic_id'=>null,
                    'model_102_103_R2_classic_id'=>null,
             
                    'model_101_102_103_R1_classic_id'=>null,
                    'model_101_102_103_R2_classic_id'=>null, 
             
                    'quotation_engine'=>'DomoprimeQuotation',
                    'simulation_engine'=>'DomoprimeSimulation',
                    'transfer_number_of_items'=>1000,
             
                    'calculation_on_contrat_save'=>'NO',
                    'calculation_on_meeting_save'=>'NO',
             
                    'default_occupation_id'=>null,
                    "cumac_engine"=>"IsoEngine",

                    ));
     }
     
     function get101R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_R1_id'),$this->getSite());
     }
     
     function get102R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_R1_id'),$this->getSite());
     }
     
     function get103R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_103_R1_id'),$this->getSite());
     }
     
      function get101R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_R2_id'),$this->getSite());
     }
     
     function get102R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_R2_id'),$this->getSite());
     }
     
     function get103R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_103_R2_id'),$this->getSite());
     }
     
     function get101102R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_R1_id'),$this->getSite());
     }
     
     function get101103R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_103_R1_id'),$this->getSite());
     }
     
      function get102103R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_103_R1_id'),$this->getSite());
     }
     
     function get101102R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_R2_id'),$this->getSite());
     }
     
     function get101103R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_103_R2_id'),$this->getSite());
     }
     
     function get102103R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_103_R2_id'),$this->getSite());
     }
     
      function get101102103R1Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_103_R1_id'),$this->getSite());
     }
     
     function get101102103R2Model()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_103_R2_id'),$this->getSite());
     }
          
     
     function get101R1ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_R1_classic_id'),$this->getSite());
     }
     
     function get102R1ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_R1_classic_id'),$this->getSite());
     }
     
     function get103R1ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_103_R1_classic_id'),$this->getSite());
     }
     
      function get101R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_R2_classic_id'),$this->getSite());
     }
     
     function get102R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_R2_classic_id'),$this->getSite());
     }
     
     function get103R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_103_R2_classic_id'),$this->getSite());
     }
     
     function get101102R1ClassicModel()
     {   
         return new CustomerMeetingFormDocument($this->get('model_101_102_R1_classic_id'),$this->getSite());
     }
     
     function get101103R1ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_103_R1_classic_id'),$this->getSite());
     }
     
      function get102103R1ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_103_R1_classic_id'),$this->getSite());
     }
     
     function get101102R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_R2_classic_id'),$this->getSite());
     }
     
     function get101103R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_103_R2_classic_id'),$this->getSite());
     }
     
     function get102103R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_102_103_R2_classic_id'),$this->getSite());
     }
     
      function get101102103R1ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_103_R1_classic_id'),$this->getSite());
     }
     
     function get101102103R2ClassicModel()
     {
         return new CustomerMeetingFormDocument($this->get('model_101_102_103_R2_classic_id'),$this->getSite());
     }
     
      function getSimulationEngine()
     {
         return $this->get('simulation_engine')."Engine";
     }
     
       function hasSimulationEngine()
     {
         return (boolean)$this->get('simulation_engine');
     }
     
     function hasOccupation()
     {
         return (boolean)$this->get('default_occupation_id');
     }
     
     function getDefaultOccupation()
     {
         return $this->get('default_occupation_id');
     }
     
     
     function getProductItemsForForm()
     {
         $values=array();
         foreach (array('wall','top','floor') as $type)
         {                   
            if (!$this->get('surface_'.$type.'_product'))
                continue; 
            $values[$this->get('surface_'.$type.'_product')]='item_'.$type;          
         }
         return $values;
     }
     
     function getProductsForForm()
     {
         $values=array();
         foreach (array('wall','top','floor') as $type)
         {                   
            if (!$this->get('surface_'.$type.'_product'))
                continue; 
            $values[$this->get('surface_'.$type.'_product')]=$type;          
         }
         return $values;
     }
     
     function getDocuments()
     {
         $documents = new CustomerMeetingFormDocumentCollection(null,$this->getSite());
         foreach (array('','Classic') as $class)
         {
             foreach (array('101','102','103','101_102','101_103','102_103','101_102_103') as $surface)
             {
                 foreach (array('R1','R2') as $type)
                 {
                     $method='get'.str_replace("_","",$surface).$type.$class.'Model';
                     if (method_exists($this, $method))
                     {
                         if ($this->$method()->isLoaded())
                             $documents[$surface."_".$type.($class?"_".strtoupper($class):"")]=$this->$method();
                     }       
                 }        
             }        
         }        
         return $documents;
     }
     
   
}
