<?php


class DomoprimeEngine {
     
    protected $forms=null,$site=null,$errors=null,$meeting=null,$has_error=false,$class_polluter_pricing=null,$contract=null,$causes=null,$customer=null;
    
    function __construct($data) {       
       if ($data instanceof CustomerMeetingForms) 
       {          
            $this->forms=$data;          
            if ($this->forms->hasContract())   
            {    
                $this->contract=$this->forms->getContract();
                $this->customer=$this->forms->getContract()->getCustomer();
            }    
            if ($this->forms->getMeeting()->isLoaded())          
            {    
                $this->meeting=$this->forms->getMeeting();  
                $this->customer=$this->forms->getMeeting()->getCustomer();
            }    
       } 
       elseif ($data instanceof CustomerMeeting)       
       {                    
          $this->forms=new CustomerMeetingForms($data,$data->getSite());         
          $this->contract=new CustomerContract($data,$data->getSite());
          $this->customer=$data->getCustomer();
          $this->meeting=$data;
       } 
       elseif ($data instanceof CustomerContract) 
       {        
          $this->forms=new CustomerMeetingForms($data,$data->getSite());          
          $this->contract=$data;
          $this->customer=$data->getCustomer();
          if ($this->contract->getMeeting()->isLoaded())
          {              
              $this->meeting=$this->contract->getMeeting();
          }    
       } 
       else
           throw new mfException(__("Contract/Meeting are invalid."));
       $this->site=$this->forms->getSite();
       $this->configure();       
    }
    
    function configure()
    {      
       $this->settings=new DomoprimeSettings(null,$this->site);
       $this->meeting_settings=new CustomerMeetingSettings(null,$this->site);
       $this->contract_settings=new CustomerContractSettings(null,$this->site);     
    }
    
     function getName()
    {
        return "BaseCumacEngine";
    }
    
    function hasPolluter()
    {   
       if ($this->hasContract() && $this->contract_settings->hasPolluter())
       {           
                    return $this->getContract()->hasPolluter();                             
       }      
       if ($this->hasMeeting() && $this->meeting_settings->hasPolluter())
       {                                        
                  return $this->getMeeting()->hasPolluter();            
       }
       return false;
    }
    
    function getPolluterSource()
    {
        if ($this->hasContract() && $this->contract_settings->hasPolluter())
            return "contract";
        if ($this->hasMeeting() && $this->meeting_settings->hasPolluter())
             return "meeting";
        return false;
    }
    
    function getPolluterSourceI18n()
    {
        if ($this->hasContract() && $this->contract_settings->hasPolluter())
            return __("Contract");
        if ($this->hasMeeting() && $this->meeting_settings->hasPolluter())
             return __("Meeting");
        return false;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getForms()
    {
        return $this->forms;
    }
    
    function getMeeting()
    {
        return  $this->meeting;
    } 
    
    
    function getProductsFromContract()
    {             
        if ($this->products===null)
        {       
            $this->products=new DomoprimeProductSectorEnergyCollection(null,$this->getSite());
            $db=mfSiteDatabase::getInstance()
                ->setObjects(array('DomoprimeProductSectorEnergy','DomoprimeProduct'))
                ->setParameters(array('energy_id'=>$this->getEnergy()->get('id'),
                                      'contract_id'=>$this->getContract()->get('id'),
                                      'sector_id'=>$this->getZone()->get('sector_id')))
                ->setQuery("SELECT {fields} FROM ".DomoprimeProductSectorEnergy::getTable().
                           " INNER JOIN ".DomoprimeProductSectorEnergy::getOuterForJoin('product_id').
                           " INNER JOIN ".CustomerContractProduct::getInnerForJoin('product_id').
                           " WHERE energy_id='{energy_id}' AND sector_id='{sector_id}' AND contract_id='{contract_id}'".
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
          // echo $db->getQuery();
             if (!$db->getNumRows())
                throw new mfException(__('No price list for energy [%s] and sector [%s]',array((string)$this->getEnergy()->getI18n(),$this->getZone()->get('code'))));
            //echo $db->getQuery();    
            while ($items=$db->fetchObjects())
            {
               $item=$items->getDomoprimeProductSectorEnergy();
               $this->products[$item->get('id')]= $item;
            }        
        }         
        return $this->products;        
    }
    
    function getProductsFromMeeting()
    {        
        if ($this->products===null)
        {       
            $this->products=new DomoprimeProductSectorEnergyCollection(null,$this->getSite());
            $db=mfSiteDatabase::getInstance()
                ->setObjects(array('DomoprimeProductSectorEnergy','DomoprimeProduct'))
                ->setParameters(array('energy_id'=>$this->getEnergy()->get('id'),
                                      'meeting_id'=>$this->getMeeting()->get('id'),
                                      'sector_id'=>$this->getZone()->get('sector_id')))
                ->setQuery("SELECT {fields} FROM ".DomoprimeProductSectorEnergy::getTable().
                           " INNER JOIN ".DomoprimeProductSectorEnergy::getOuterForJoin('product_id').
                           " INNER JOIN ".CustomerMeetingProduct::getInnerForJoin('product_id').
                           " WHERE energy_id='{energy_id}' AND sector_id='{sector_id}' AND meeting_id='{meeting_id}'".
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
          // echo $db->getQuery();
             if (!$db->getNumRows())
                throw new mfException(__('No price list for energy [%s] and sector [%s]',array((string)$this->getEnergy()->getI18n(),$this->getZone()->get('code'))));
            //echo $db->getQuery();    
            while ($items=$db->fetchObjects())
            {
               $item=$items->getDomoprimeProductSectorEnergy();
               $this->products[$item->get('id')]= $item;
            }        
        }         
        return $this->products;
    }
       
    
    function getZone()
    {
        return $this->zone;
    }
    
   
    
    function loadSurfacesFromForms()
    {
         $this->surfaces_forms=array();
         foreach ($this->getSettings()->getSurfaceForFieldByProducts() as $product_id=>$surface)
         {          
             $this->surfaces_forms[$product_id]=$this->getForms()->getDataFromFieldname($surface->getForm()->get('name'),$surface->get('name'));
         }                  
         return $this->surfaces_forms;
    }
    
    function loadSurfacesFromContractProducts()
    {
        $this->surfaces_contract=array();
        foreach ($this->getContract()->getContractProducts() as $contract_products)
        {
          $this->surfaces_contract[$contract_products->get('product_id')]=$contract_products->get('quantity')  ;
        }      
      //  var_dump();
        return $this->surfaces_contract; 
    }
    
    function getSurfaceFromProduct($product,$default=0.0)
    {
        return isset($this->surfaces[$product->get('id')])?$this->surfaces[$product->get('id')]:$default;
    }
    
     function getSurfaceFromForms($product,$default=0.0)
    {
        return isset($this->surfaces_forms[$product->get('id')])?$this->surfaces_forms[$product->get('id')]:$default;
    }
    
     function hasSurfaceFromContractProduct($product)
    {
        return isset($this->surfaces_contract[$product->get('id')])?$this->surfaces_contract[$product->get('id')] != 0:$false;
    }
    
    
     function getSurfaceFromContractProduct($product,$default=0.0)
    {
        return isset($this->surfaces_contract[$product->get('id')])?$this->surfaces_contract[$product->get('id')]:$default;
    }
    
    function getClassicClass()
    {
        return $this->classic_class;
    }
    
    function getClassRegionPrice()
    {
       return $this->class_region_price; 
    }
     
    function hasContract()
    {        
       return ($this->contract && $this->contract->isLoaded());        
    }
    
    function getContract()
    {
        return $this->contract;
    }
    
    function checkIfAtLeastOneSurface()
    {
        foreach ($this->surfaces as $surface)
        {
            if ($surface != 0)
                return true;
        }   
        return false;
    }
    
    function loadContractProductQuantities()
    {
        $this->loadSurfacesFromForms();
        $this->surfaces=$this->surfaces_forms;
        if (!$this->hasContract())
            return $this;   
        foreach ($this->loadSurfacesFromContractProducts() as $product_id=>$surface)
        {           
            if ($surface != 0)
            {
                $this->surfaces[$product_id]=$surface;
            }    
        }            
        return $this;
    }
    
    
    function getClass()
    {       
        if ($this->getClassRegionPrice()->isLoaded())
            return $this->getClassRegionPrice()->getClass();
        return $this->getClassicClass();
    }
    
    function getEnergy()
    {
       return $this->energy; 
    }
    
    function loadEnergyFromForms()
    {                
        $this->energy=$this->getSettings()->getEnergyFromForms($this->getForms());                  
        return $this->energy;
    }
    
    function loadRevenueFromForms()
    {
       $this->revenue=$this->getForms()->getDataFromFieldname($this->getSettings()->getRevenueFormField()->getForm()->get('name'),$this->getSettings()->getRevenueFormField()->get('name'));
       return $this->revenue;
    }
    
    function loadNumberOfPeopleFromForms()
    {
        $this->number_of_people=$this->getForms()->getDataFromFieldname($this->getSettings()->getNumberOfPeopleFormField()->getForm()->get('name'),$this->getSettings()->getNumberOfPeopleFormField()->get('name'));   
        return $this->number_of_people;
    }
    
    
    function process()
    {
        $this->is_accepted=true;
        $this->is_refused=false;
        $this->has_error=false;
        $this->causes=new DomoprimeCauses();                 
        try
        {          
            // Check if all data is collected      
             $this->zone=new DomoprimeZone(array('code'=>$this->getCustomer()->getAddress()->getDept()),$this->getSite()); 
             if ($this->zone->isNotLoaded())
                  throw new mfException(__("Zone is invalid."));     
            // echo "<pre>"; var_dump($this->zone,$this->zone->getRegion()); echo "</pre>"; 

           //  $this->energy=$this->getSettings()->getEnergyFromForms($this->getForms());                             
             if ($this->loadEnergyFromForms()==null)
                 throw new mfException(__("Energy is invalid."));                
             $this->classic_class=$this->getSettings()->getClassicClass();                              
             $this->loadContractProductQuantities();  
             if (!$this->checkIfAtLeastOneSurface())            
                 throw new mfException(__("No surface exists."));                 
             $this->loadRevenueFromForms();             
             $this->loadNumberOfPeopleFromForms();
             if ($this->number_of_people <= 0)
                throw new mfException(__("Number of people is invalid."));
            // if ($this->revenue <= 0)
           //     throw new mfException(__("Revenue is invalid."));
             $this->class_region_price=new DomoprimeClassRegionPrice(array('region'=>$this->zone->getRegion(),'revenue'=>$this->revenue,'number_of_people'=>$this->number_of_people),$this->getSite());                                                            
            // if ($this->class_region_price->isNotLoaded())
            //     throw new mfException(__("Pricing is invalid."));     
                 
             if ($this->hasPolluter() && ($this->meeting_settings->hasPolluter() || $this->contract_settings->hasPolluter()))
             {                 
                 $this->class_polluter_pricing=new DomoprimePolluterClassPricing(array('class'=>$this->getClass(),'polluter'=>$this->getPolluter()),$this->getSite());                                                          
                 if ($this->class_polluter_pricing->isNotLoaded())
                 {                              
                    if ($this->hasMeeting() && !$this->hasContract())
                    {    
                        if (!$this->getMeeting()->hasPolluter())
                            throw new mfException(__("No polluter in meeting for pricing."));      
                    }
                    if ($this->hasContract())
                    {    
                        if (!$this->getContract()->hasPolluter())                            
                            throw new mfException(__("No polluter in contract for pricing."));      
                    }                 
                 }   
                 else
                 {
                     
                 }    
             }             
          // var_dump($this->class_region_price);
            //  if ($this->class_region_price->isNotLoaded())
           //      throw new mfException(__('Revenus trop important'));           
             //$this->getProducts()->process($this->class_region_price->getClass(),$this);
             $this->getProducts()->process($this);
             $this->total_qmac=$this->getProducts()->getTotalQmac();
             $this->total_value_qmac=$this->getProducts()->getTotalValueQmac();
             $this->total_pose=$this->getProducts()->getTotalPose();
             $this->total_margin=$this->getProducts()->getTotalMargin();  
        /*     if ($this->getSettings()->hasSalesLimit())
             {                 
                 $this->is_accepted=$this->total_margin >=  $this->getSettings()->getSalesLimit();
                 $this->is_refused=$this->total_margin <= 0;
                 $this->causes[]='LIMIT_MARGIN';
             }  
             else
             {
                $this->is_refused=$this->total_margin < 0; 
                $this->is_accepted=$this->total_margin >= 0;
                if ($this->is_refused)
                    $this->causes[]='NEGATIVE_MARGIN';
             }    
             if ($this->getSettings()->hasClassesAuthorized() && $this->getClass()->isLoaded())
             {                 
                // var_dump($this->getSettings()->getClassesAuthorized(),$this->getClass()->get('id'));
                 if (!$this->getSettings()->getClassesAuthorized()->inArray($this->getClass()->get('id')))
                 {        
                  $this->causes[]='CLASS_REFUSED';
                  $this->is_refused=true;
                  $this->is_accepted=false;
                 }
             }  
              if ($this->getSettings()->hasEnergiesAuthorized() && $this->energy->isLoaded())
             {
                if (!$this->getSettings()->getEnergiesAuthorized()->inArray($this->energy->get('id')))
                 {        
                  $this->causes[]='ENERGY_REFUSED';
                  $this->is_refused=true;
                  $this->is_accepted=false;
                 }
             }  */
             $this->processLimits();
        }
        catch (mfException $ex)
        {
           // echo "ERROR:=".$ex->getCode();
            $this->has_error=true;
            throw $ex;
        }
    }
    
    function hasError()
    {
        return $this->has_error;
    }
    
    function isAccepted()
    {
        return $this->is_accepted;
    }
    
    function isRefused()
    {
        return $this->is_refused;
    }
   
    function getTotalQmac()
    {
        return $this->total_qmac;
    }
    
     function getTotalValueQmac()
    {
        return $this->total_value_qmac;
    }
    
     function getTotalPose()
    {
        return $this->total_pose;
    }
    
     function getTotalMargin()
    {
        return $this->total_margin;
    }
    
     function getRevenue()
     {
         return $this->revenue;
     }
     
     function getNumberOfPeople()
     {
         return $this->number_of_people;
     }
     
     function getClassPolluterPricing()
     {
         return $this->class_polluter_pricing;
     }
     
     function getFormattedRevenue()
     {
         return format_number($this->revenue,"#.00");
     }
     
      function getFormattedNumberOfPeople()
     {
         return format_number($this->number_of_people,"#");
     }
             
     function getCauses()
     {
         return $this->causes;
     }
    
     function getPolluter()
     {
         if ($this->hasContract())
            return $this->getContract()->getPolluter();
         return $this->getMeeting()->getPolluter();
     }
     
     function getCustomer()
     {
         return $this->customer;
     }
     
     function calculationFromMeeting()
     {
         return (boolean)$this->meeting;
     }
     
     function hasMeeting()
     {
         return (boolean)$this->meeting;
     }
     
     function getProducts()
    {
        if ($this->hasMeeting())
        {                
            return $this->getProductsFromMeeting();
        }    
        return $this->getProductsFromContract();
    }
    
    function getNameFromProduct($product)
    {
        if ($this->names===null)
           $this->names=$this->getSettings ()->getNamingsForProducts();
        return isset($this->names[$product->get('id')])?$this->names[$product->get('id')]:null;
    }
    
    
    function processLimits()
    {
        if ($this->getSettings()->hasSalesLimit())
        {                 
            $this->is_accepted=$this->total_margin >=  $this->getSettings()->getSalesLimit();
            $this->is_refused=$this->total_margin <= 0;
            $this->causes[]='LIMIT_MARGIN';
        }  
        else
        {
           $this->is_refused=$this->total_margin < 0; 
           $this->is_accepted=$this->total_margin >= 0;
           if ($this->is_refused)
               $this->causes[]='NEGATIVE_MARGIN';
        }    
        if ($this->getSettings()->hasClassesAuthorized() && $this->getClass()->isLoaded())
        {                                 
            if (!$this->getSettings()->getClassesAuthorized()->inArray($this->getClass()->get('id')))
            {        
             $this->causes[]='CLASS_REFUSED';
             $this->is_refused=true;
             $this->is_accepted=false;
            }
        }  
         if ($this->getSettings()->hasEnergiesAuthorized() && $this->energy->isLoaded())
        {
           if (!$this->getSettings()->getEnergiesAuthorized()->inArray($this->energy->get('id')))
            {        
             $this->causes[]='ENERGY_REFUSED';
             $this->is_refused=true;
             $this->is_accepted=false;
            }
        }      
        return $this;
    }
}
