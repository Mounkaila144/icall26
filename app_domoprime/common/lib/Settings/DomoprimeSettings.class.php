<?php

class DomoprimeSettings extends mfSettingsBase {
    
     protected static $instance=null;    
     
     function __construct($data=null,$site=null)
     {
         parent::__construct($data,null,'frontend',$site);        
     } 
      
     function getDefaults()
     {             
         $this->add(array(
                              "surface_wall_formfield"=>'',   
                              "surface_floor_formfield"=>'',   
                              "surface_top_formfield"=>'',  
                              
                              "energy_formfield"=>'',  
                              "number_of_people_formfield"=>'',
                              "revenue_formfield"=>'',
                              "owner_formfield"=>'',
                              "energy_combustible_formfield_value"=>null,
                              "energy_electricity_formfield_value"=>null,
                              "owner_occupant_owner_formfield_value"=>null,
                              "owner_tenant_formfield_value"=>null,   
                              "owner_no_occupant_owner_formfield_value"=>null,
                              "owner_free_formfield_value"=>null,
                              "owner_wall_formfield_value"=>null,
                              "owner_floor_formfield_value"=>null,
             
                              "energy_combustible"=>null,
                              "energy_electricity"=>null,
             
                              "surface_wall_product"=>null,
                              "surface_floor_product"=>null,
                              "surface_top_product"=>null,
             
                              "classic_class"=>null,

                              // limit
                              "sales_limit"=>0,
                              "energy_filter"=>array(),
                              "class_filter"=>array(),
             
                              "quotation_model_id"=>null,
                              "billing_model_id"=>null,
                              "asset_model_id"=>null,
             
                              "rest_in_charge"=>1.0,
                              "install_in_progess_status_id"=>null,
                                   
                              "quotation_reference_format"=>"",
                              "billing_reference_format"=>"",
                              "asset_reference_format"=>"",
                               
                              "quotation_shift_for_dated_at"=>0,
                              
                              "multiple_billings_max"=>30,
             
                              "ah_archivage"=>"NO",
                              "quotation_archivage"=>"NO",
                              "billing_archivage"=>"NO",
                              "multi_documents_archivage"=>"NO",
                              "billing_email_model_id"=>null,
             
                              "tax_credit"=>"NO",
                              'quotation_engine'=>'',
             
                              'calculation_on_contrat_save'=>'YES',
                              'calculation_on_meeting_save'=>'YES',
             
                              'premeeting_model_id'=>null,
             
                              'fee_file'=>0.0,
                              'tax_fee_file'=>0.2,
             
                              'coef_multiples'=>false,
             
                               "premeeting_archivage"=>'NO',
             
                               "verif_archivage"=>'NO',
             
                               "signed_verif_archivage"=>'NO',
             
                               "pourcentage_advance"=>0.3,
                               "ana_tax"=>0,         
                               "ana_pack_tax"=>0,
                               "cumac_engine"=>null,
             
                               "quotation_multi_pdf"=>"NO",
                               "quotation_multi_engine"=>null,
                          ));
        
     } 
     
     
     function getSurfaceWallFormField()
     {
        if ($this->_surface_wall_formfield===null)
        {    
            $this->_surface_wall_formfield=new CustomerMeetingFormField($this->get('surface_wall_formfield'),$this->getSite());
        }
         return $this->_surface_wall_formfield;
     }
     
     function getSurfaceFloorFormField()
     {
        if ($this->_surface_floor_formfield===null)
        {    
            $this->_surface_floor_formfield=new CustomerMeetingFormField($this->get('surface_floor_formfield'),$this->getSite());
        }
         return $this->_surface_floor_formfield;
     }
     
      function getSurfaceTopFormField()
     {
        if ($this->_surface_top_formfield===null)
        {    
            $this->_surface_top_formfield=new CustomerMeetingFormField($this->get('surface_top_formfield'),$this->getSite());
        }
         return $this->_surface_top_formfield;
     }
     
     function getEnergyFormField()
     {
        if ($this->_energy_formfield===null)
        {    
            $this->_energy_formfield=new CustomerMeetingFormField($this->get('energy_formfield'),$this->getSite());
        }
        return $this->_energy_formfield;         
     }
     
     function getNumberOfPeopleFormField()
     {
          if ($this->_number_of_people_formfield===null)
        {    
            $this->_number_of_people_formfield=new CustomerMeetingFormField($this->get('number_of_people_formfield'),$this->getSite());
        }
        return $this->_number_of_people_formfield;          
     }
     
     function getRevenueFormField()
     {
           if ($this->_revenue_formfield===null)
        {    
            $this->_revenue_formfield=new CustomerMeetingFormField($this->get('revenue_formfield'),$this->getSite());
        }
        return $this->_revenue_formfield;               
     }
     
     function getOwnerFormField()
     {
           if ($this->_owner_formfield===null)
        {    
            $this->_owner_formfield=new CustomerMeetingFormField($this->get('owner_formfield'),$this->getSite());
        }
        return $this->_owner_formfield;               
     }
     
     
     function getEnergyChoices()
     {
         $choices=array();
         foreach (DomoprimeEnergy::getEnergyIDs($this->getSite()) as $energy_id)
         {
             $choices[$this->get("energy_".$energy_id)]=$energy_id;
         }        
      // echo "<pre>"; var_dump($choices); echo "</pre>";         
         return $choices;        
     }
     
     function getEnergyFromChoice($choice,$default=null)
     {
         $choices=$this->getEnergyChoices();
         $value=isset($choices[$choice])?new DomoprimeEnergy($choices[$choice]):$default;         
         return $value;
     }
     
     function getEnergyFromForms($forms)
     {        
         $choice=$forms->getDataFromFieldname($this->getEnergyFormField()->getForm()->get('name'),$this->getEnergyFormField()->get('name'));                          
         return $this->getEnergyFromChoice($choice);
     }
     
     
     function getSurfaceForFieldByProducts()
     {
         return array(
             $this->get('surface_wall_product')=>$this->getSurfaceWallFormField(),
             $this->get('surface_floor_product')=>$this->getSurfaceFloorFormField(),
             $this->get('surface_top_product')=>$this->getSurfaceTopFormField(),
         );
     }
     
     function loadSurfacesFromFields()
     {                               
        $this->surfaces= array(
            'surface_wall'=>$this->getSurfaceWallFormField(),
            'surface_floor'=>$this->getSurfaceFloorFormField(),
            'surface_top'=>$this->getSurfaceTopFormField(),
        );
        foreach ($this->surfaces as $value)
                $value->getForm();
        return $this;
     }
     
     function getSurfacesFromFields()
     {                  
         if ($this->surfaces===null)
         {    
            $this->loadSurfacesFromFields();            
         }
         return $this->surfaces;
     }
     
      function getSurfaceNamesForProducts()
     {
         return array(
             $this->get('surface_wall_product')=>'surface_wall_product',
             $this->get('surface_floor_product')=>'surface_floor_product',
             $this->get('surface_top_product')=>'surface_top_product',
         );
     }
     
      function getProductsBySurfaces()
     {
         return array(
             'surface_wall'=>$this->get('surface_wall_product'),
             'surface_floor'=>$this->get('surface_floor_product'),
             'surface_top'=> $this->get('surface_top_product')
         );
     }
     
     
      function getProductsByTypes()
     {
         return array(
            $this->get('surface_wall_product')=> '102',
            $this->get('surface_floor_product') => '103',
            $this->get('surface_top_product') =>  '101'
         );
     }
          
    
     function getClassicClass()
     {
        if ($this->_classic_class===null)
        {    
            $this->_classic_class=new DomoprimeClass($this->get('classic_class'),$this->getSite());
        }
         return $this->_classic_class;
     }
     
     function hasSalesLimit()
     {
         return (boolean)$this->get('sales_limit');
     }
     
     function getSalesLimit()
     {
         return $this->get('sales_limit');
     }
     
     function getModelForQuotation()
     {
         return new DomoprimeQuotationModel($this->get('quotation_model_id'),$this->getSite());
     }
     
      function getModelForBilling()
     {
         return new DomoprimeBillingModel($this->get('billing_model_id'),$this->getSite());
     }
     
       function getModelForAsset()
     {
         return new DomoprimeAssetModel($this->get('asset_model_id'),$this->getSite());
     }
     
     function getRestInCharge()
     {
         return $this->get('rest_in_charge');
     }
     
      function getInstallInProgressStatus()
     {
         return new CustomerContractStatus($this->get('install_in_progess_status_id'),$this->getSite());
     }
     
    function hasClassesAuthorized()
    {                
        if (!$this->get("class_filter",array()))
           return false;
        $value=$this->get("class_filter");
        if ($value[0]=='')
            return false; 
        return true;
    }
    
     function hasEnergiesAuthorized()
    {        
        if (!$this->get("energy_filter",array()))
           return false;
        $value=$this->get("energy_filter");
        if ($value[0]=='')
            return false; 
        return true;
    }
    
    function getClassesAuthorized()
    {
        return new mfArray($this->get("class_filter",array()));
    }
    
     function getEnergiesAuthorized()
    {
         return new mfArray($this->get("energy_filter",array()));        
    }
    
    
     function getTypeNamesForProducts()
     {
         return array(
             $this->get('surface_wall_product')=>'wall',
             $this->get('surface_floor_product')=>'floor',
             $this->get('surface_top_product')=>'top',
         );
     }
       
     function getDatedAtByDefault()
     {
         $settings=new SystemSettings(null,$this->getSite());
         $day= new Day();                
         $day=$day->getDaySub($this->get('quotation_shift_for_dated_at',0));            
         $index=$settings->getNumberOfDaysOff();                   
         while ((!$settings->getOpenDays()->isEmpty() && (!$settings->getOpenDays()->in($day->getDayInWeek())) || $settings->getHolidays()->in($day->getDate())) && $index-- !=0 )
         {           
             $day = $day->getPreviousDay();
         }             
         return $day->getDate();
     }
     
      function hasEmailBillingModel()
     {
         return (boolean)$this->get('billing_email_model_id');
     }
     
     function getEmailBillingModel()
     {
         return new CustomerModelEmail($this->get('billing_email_model_id'),$this->getSite());
     }
     
     
      function getFormattedRestInCharge()
     {
         return new CurrencyFormatter($this->get('rest_in_charge'),'EUR');
     }
     
      function getSurfaceNamingsForProducts()
     {
         return array(
             $this->get('surface_wall_product')=>'surface_wall',
             $this->get('surface_floor_product')=>'surface_floor',
             $this->get('surface_top_product')=>'surface_top',
         );
     }
     
     function getNamingsForProducts()
     {
         return array(
             $this->get('surface_wall_product')=>'wall',
             $this->get('surface_floor_product')=>'floor',
             $this->get('surface_top_product')=>'top',
         );
     }
     
     
     function hasQuotationEngine()
     {
         return (boolean)$this->get('quotation_engine');
     }
     
     function getQuotationEngine()
     {
         return $this->get('quotation_engine')."Engine";
     }
     
      function getModelForPreMeetingDocument()
     {
         return new DomoprimePreMeetingModel($this->get('premeeting_model_id'),$this->getSite());
     }
     
     function getDeclarantsFormField()
     {
         return new CustomerMeetingFormField(array('ns'=>'iso','name'=>'noms_prenoms_declarants'),$this->getSite());  
     }
     
     function getParcelReferenceFormField()
     {
         return new CustomerMeetingFormField(array('ns'=>'cadastre','name'=>'number'),$this->getSite());
     }
     
     function getParcelSurfaceFormField()
     {
         return new CustomerMeetingFormField(array('ns'=>'cadastre','name'=>'surface'),$this->getSite());
     }
     
     function getFormFieldsSchema()
     {
         return array(
            'surface_wall'=>$this->getSurfaceWallFormField(),
            'surface_floor'=>$this->getSurfaceFloorFormField(),
            'surface_top'=>$this->getSurfaceTopFormField(),
            'revenue'=>$this->getRevenueFormField(),
            'number_of_people'=>$this->getNumberOfPeopleFormField(),
            'energy'=>$this->getEnergyFormField(),
            'declarants'=>$this->getDeclarantsFormField(),                                                                         
             'parcel_reference'=>$this->getParcelReferenceFormField(),
             'parcel_surface'=>$this->getParcelSurfaceFormField(),
             // 'NUMEROSFISCAL1'
                     // 'REFERENCEDELAVIS1'
                     // 'NUMEROSFISCAL2'
                     // 'REFERENCEDELAVIS2'    
             );                           
     }
     
     
     function getTopProduct()
     {
         return new Product($this->get('surface_top_product'),$this->getSite());
     }
     
      function getWallProduct()
     {
         return new Product($this->get('surface_wall_product'),$this->getSite());
     }
     
      function getFloorProduct()
     {
         return new Product($this->get('surface_floor_product'),$this->getSite());
     }
     
      function getPourcentageAdvance()
    {
        return floatval($this->get('pourcentage_advance',0.3));
    }
    
     function getAnaTax()
    {
        return floatval($this->get('ana_tax',0));
    }
    
     function getAnaPackTax()
    {
        return floatval($this->get('ana_pack_tax',0));
    }
    
    function getCumacEngine()
    {
        return 'Domoprime'.$this->get('cumac_engine','Engine');
    }
    
     function getQuotationMultiEngine()
    {
        return 'DomoprimeQuotation'.$this->get("quotation_multi_engine",'MultiPdf').'Engine'; 
    }
    
     function getBillingMultiEngine()
    {
        return 'DomoprimeBilling'.$this->get("billing_multi_engine",'MultiPdf').'Engine'; 
    }
    
        function getEnergyClasses()
    {
        return new mfArray(array('A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E','F'=>'F','G'=>'G'));
    } 
    
     function getModelForAfterWorkDocument()
     {
         return new DomoprimeAfterWorkModel($this->get('after_work_model_id'),$this->getSite());
     } 
}
