<?php

class DomoprimeCustomerRequestBase extends mfObject2 {
     
    protected static $fields=array('meeting_id','contract_id','customer_id','energy_id','occupation_id','layer_type_id',
                                   'revenue','number_of_people','parcel_surface','parcel_reference',
                                   'install_surface_wall','install_surface_top','install_surface_floor','tax_credit_used',
                                   'surface_wall','surface_top','surface_floor','number_of_fiscal','more_2_years',
                                   'src_surface_wall','src_surface_top','src_surface_floor',
                                   'number_of_children','declarants',
        
                                   'added_price_with_tax_wall',
                                   'added_price_without_tax_wall',
                                   'added_price_with_tax_floor',
                                   'added_price_without_tax_floor',
                                   'added_price_with_tax_top',
                                   'added_price_without_tax_top',
        
                                   'restincharge_price_with_tax_wall',
                                   'restincharge_price_without_tax_wall',
                                   'restincharge_price_with_tax_floor',
                                   'restincharge_price_without_tax_floor',
                                   'restincharge_price_with_tax_top',
                                   'restincharge_price_without_tax_top',
                                   'pricing_id','previous_energy_id','surface_home','engine_id',
                                   'number_of_parts','surface_ite','packboiler_quantity',
                                   'pack_quantity','boiler_quantity','ana_prime',
                                   'has_strainer','has_bbc',
                                   'energy_class','previous_energy_class',
                                   'cef','cef_project','cep','cep_project','power_consumption','economy',
                                   'counter_type_id','equipment_type_id','house_type_id','roof_type1_id','roof_type2_id','build_year',
                                   'created_at','updated_at'
                                );
    const table="t_domoprime_iso_customer_request"; 
     protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',
                                          'customer_id'=>'Customer',
                                          'contract_id'=>'CustomerContract',
                                          'energy_id'=>'DomoprimeEnergy',
                                          'pricing_id'=>'DomoprimeIsoCumacPrice',
                                        'layer_type_id'=>'DomoprimeTypeLayer',
                                        'previous_energy_id'=>'DomoprimePreviousEnergy',
                                        'occupation_id'=>'DomoprimeOccupation',
                                        'engine_id'=>'DomoprimeCumacEngineSetting',
                                         'counter_type_id'=>'CustomerContractCounterType',
                                        'equipment_type_id'=>'CustomerContractEquipmentType',
                                        'house_type_id'=>'CustomerContractHouseType',
                                        'roof_type1_id'=>'CustomerContractRoofType',
                                        'roof_type2_id'=>'CustomerContractRoofType',
                                    ); // By default
     
     protected static $fieldsNull=array('meeting_id','contract_id','previous_energy_id','engine_id',
                                    'energy_class','previous_energy_class',
                                    'cef','cef_project','cep','cep_project','power_consumption','economy',
                                    'counter_type_id','equipment_type_id','house_type_id','roof_type1_id','roof_type2_id',
                                ); // By default
     
     
    protected $settings=null;
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          if (isset($parameters['contract']) && $parameters['contract'] instanceof CustomerContract)
             return $this->loadByContract ($parameters['contract']);
           if (isset($parameters['meeting']) && $parameters['meeting'] instanceof CustomerMeeting)
             return $this->loadByMeeting($parameters['meeting']);
          return $this->add($parameters); 
      }   
      else
      {        
        if ($parameters instanceof CustomerMeeting)
            return $this->loadByMeeting($parameters);
         if ($parameters instanceof CustomerContract)
            return $this->loadByContractOrMeeting($parameters);
          if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters); 
      }   
    }
    
    protected function loadByContractOrMeeting(CustomerCOntract $contract)
    {
         $this->set('contract_id',$contract); 
         $this->set('customer_id',$contract->get('customer_id'));
         $db=mfSiteDatabase::getInstance()->setParameters(array('contract_id'=>$contract->get('id'),'meeting_id'=>$contract->get('meeting_id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id='{contract_id}' OR (meeting_id='{meeting_id}' AND meeting_id IS NOT NULL);")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
     protected function loadByContract(CustomerCOntract $contract)
    {
         $this->set('contract_id',$contract); 
         $this->set('customer_id',$contract->get('customer_id'));
         $db=mfSiteDatabase::getInstance()->setParameters(array('contract_id'=>$contract->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE contract_id='{contract_id}';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }
    
    protected function loadByMeeting($meeting)
    {
         $this->set('meeting_id',$meeting);
         $this->set('customer_id',$meeting->get('customer_id'));
         $db=mfSiteDatabase::getInstance()->setParameters(array('meeting_id'=>$meeting->get('id')));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE meeting_id='{meeting_id}';")
            ->makeSiteSqlQuery($this->site);      
         return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");   
       $this->more_2_years=isset($this->more_2_years)?$this->more_2_years:"YES";
       $this->revenue=isset($this->revenue)?$this->revenue:0.0;
       $this->added_price_with_tax_wall=isset($this->added_price_with_tax_wall)?$this->added_price_with_tax_wall:0.0;
       $this->added_price_without_tax_wall=isset($this->added_price_without_tax_wall)?$this->added_price_without_tax_wall:0.0;
       $this->added_price_with_tax_floor=isset($this->added_price_with_tax_floor)?$this->added_price_with_tax_floor:0.0;
       $this->added_price_without_tax_floor=isset($this->added_price_without_tax_floor)?$this->added_price_without_tax_floor:0.0;
       $this->added_price_with_tax_top=isset($this->added_price_with_tax_top)?$this->added_price_with_tax_top:0.0;
       $this->added_price_without_tax_top=isset($this->added_price_without_tax_top)?$this->added_price_without_tax_top:0.0;
       
       $this->restincharge_price_with_tax_wall=isset($this->restincharge_price_with_tax_wall)?$this->restincharge_price_with_tax_wall:0.0;
       $this->restincharge_price_without_tax_wall=isset($this->restincharge_price_without_tax_wall)?$this->restincharge_price_without_tax_wall:0.0;
       $this->restincharge_price_with_tax_floor=isset($this->restincharge_price_with_tax_floor)?$this->restincharge_price_with_tax_floor:0.0;
       $this->restincharge_price_without_tax_floor=isset($this->restincharge_price_without_tax_floor)?$this->restincharge_price_without_tax_floor:0.0;
       $this->restincharge_price_with_tax_top=isset($this->restincharge_price_with_tax_top)?$this->restincharge_price_with_tax_top:0.0;
       $this->restincharge_price_without_tax_top=isset($this->restincharge_price_without_tax_top)?$this->restincharge_price_without_tax_top:0.0;
       $this->packboiler_quantity=isset($this->packboiler_quantity)?$this->packboiler_quantity:1;
       $this->surface_home=isset($this->surface_home)?$this->surface_home:0;
       $this->has_strainer=isset($this->has_strainer)?$this->has_strainer:'N';
       $this->has_bbc=isset($this->has_bbc)?$this->has_bbc:'N';        
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSiteSqlQuery($this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
    
   /* protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
    
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    function hasContract()
    {
        return (boolean)$this->get('contract_id');
    }
                                                                             
     function getEnergy()
    {
       if (!$this->_energy_id)
       {
          $this->_energy_id=new DomoprimeEnergy($this->get('energy_id'),$this->getSite());          
       }   
       return $this->_energy_id;
    }    
    
       function getOccupation()
    {
       if (!$this->_occupation_id)
       {
          $this->_occupation_id=new DomoprimeOccupation($this->get('occupation_id'),$this->getSite());          
       }   
       return $this->_occupation_id;
    }   
    
     function getType()
    {
       if (!$this->_layer_type_id)
       {
          $this->_layer_type_id=new DomoprimeTypeLayer($this->get('layer_type_id'),$this->getSite());          
       }   
       return $this->_layer_type_id;
    }   
    
     function getMeeting()
    {
        if ($this->_meeting_id===null)
        {
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());            
        }   
        return $this->_meeting_id;
    }
    
    function getContract()
    {
        if ($this->_contract_id===null)
        {
            $this->_contract_id=new CustomerContract($this->get('contract_id'),$this->getSite());            
        }   
        return $this->_contract_id;
    }
    
    function getCustomer()
    {
        if ($this->_customer_id===null)
        {
            $this->_customer_id=new Customer($this->get('customer_id'),$this->getSite());            
        }   
        return $this->_customer_id;
    }
    
    function getFormatter()
    {
        return $this->formatter=$this->formatter===null?new DomoprimeRequestFormatter($this):$this->formatter;
    }
    
    function hasPricing()
    {
        return (boolean)$this->get('pricing_id');
    }
    
    function getPricing()
    {
        return $this->_pricing_id= $this->_pricing_id ===null?new DomoprimeIsoCumacPrice($this->get('pricing_id'),$this->getSite()):$this->_pricing_id;
    }
    
    
    function toArrayForEmail()
    {//'energy_id','occupation_id','layer_type_id',
        $values=array();
        foreach (array('revenue'=>'getRevenue',
                       'number_of_people'=>'getNumberOfPeople',
                       'surface_wall'=>'getSurfaceWall',
                       'surface_top'=>'getSurfaceTop',
                       'surface_floor'=>'getSurfaceFloor',   
                       'surface_ite'=>'getITESurface',
                       'boiler_quantity'=>'getBoilerQuantity',
                       'pack_quantity'=>'getPackQuantity',
                       'number_of_children'=>'getNumberOfChildren',
                       'ana_prime'=>'getAnaPrime',
                       'surface_home'=>'getSurfaceHome',
                      // 'cef'=>'getCEF',
                     //   'cef_project'=>'getCEFProject',
                     //   'cep'=>'getCEP',
                     //   'cep_project'=>'getCEPProject',
                        'power_consumption'=>'getPowerConsumption',
                        'economy'=>'getEconomy',
                       'number_of_fiscal'=>'getNumberOfFiscal') as $field=>$formatter)
        {
            if (method_exists($this->getFormatter(), $formatter))
                $values[$field]=(string)$this->getFormatter()->$formatter();
        }
        $values['cep_project']=$this->getFormatter()->getCEPProject()->getText("#.00");
        $values['cep']=$this->getFormatter()->getCEP()->getText("#.00");
        $values['cef_project']=$this->getFormatter()->getCEFProject()->getText("#.00");
        $values['cef']=$this->getFormatter()->getCEF()->getText("#.00");
        $values['energy']=(string)$this->getEnergy()->getI18n();
        $values['occupation']=(string)$this->getOccupation()->getI18n();
        $values['layer_type']=(string)$this->getType()->getI18n();
        if ($this->hasPreviousEnergy())
        {    
          $values['previous_energy']=array('value'=>(string)$this->getPreviousEnergy()->getI18n(),
                                'electricity'=>$this->getPreviousEnergy()->get('name')==0?"1":"0",
                                'combustible'=>$this->getPreviousEnergy()->get('name')==1?"1":"0",  
                               );
        }
        return $values;
    }
    
    function toArrayForDocument()
    {//'energy_id','occupation_id','layer_type_id',
        $values=array();
        foreach (array('revenue'=>'getRevenue',
                       'number_of_people'=>'getNumberOfPeople',
                       'surface_wall'=>'getSurfaceWall',
                       'surface_top'=>'getSurfaceTop',
                       'surface_floor'=>'getSurfaceFloor',
                       'surface_ite'=>'getITESurface',
                       'boiler_quantity'=>'getBoilerQuantity',
                       'pack_quantity'=>'getPackQuantity',
                       'parcel_surface'=>'getParcelSurface',
                       'parcel_number'=>'getParcelNumber',
                       'parcel_reference'=>' getParcelReference',
                       'install_surface_wall'=>'getInstallSurfaceWall',
                       'install_surface_top'=>'getInstallSurfaceTop',
                       'install_surface_floor'=>'getInstallSurfaceFloor',
                       'number_of_children'=>'getNumberOfChildren',
                       'ana_prime'=>'getAnaPrime',
                      //  'cef'=>'getCEF',
                      //  'cef_project'=>'getCEFProject',
                      //  'cep'=>'getCEP',
                      //  'cep_project'=>'getCEPProject',
                        'power_consumption'=>'getPowerConsumption',
                        'economy'=>'getEconomy',
                       'surface_home'=>'getSurfaceHome',
                       'number_of_fiscal'=>'getNumberOfFiscal') as $field=>$formatter)
        {
            if (method_exists($this->getFormatter(), $formatter))
                $values[$field]=(string)$this->getFormatter()->$formatter();
        }
        $values['cep_project']=$this->getFormatter()->getCEPProject()->getText("#.00");
        $values['cep']=$this->getFormatter()->getCEP()->getText("#.00");
        $values['cef_project']=$this->getFormatter()->getCEFProject()->getText("#.00");
        $values['cef']=$this->getFormatter()->getCEF()->getText("#.00");
        $values['energy']=(string)$this->getEnergy()->getI18n();
        $values['occupation']=(string)$this->getOccupation()->getI18n();
        $values['layer_type']=(string)$this->getType()->getI18n();
        $values['declarants']=$this->get('declarants');
        $values['more_2_years']=$this->get('more_2_years')=='YES'?"1":"0";  
        if ($this->hasPreviousEnergy())
        {    
          $values['previous_energy']=array('value'=>(string)$this->getPreviousEnergy()->getI18n(),
                                'electricity'=>$this->getPreviousEnergy()->get('name')==0?"1":"0",
                                'combustible'=>$this->getPreviousEnergy()->get('name')==1?"1":"0",  
                               );
        }
        return $values;
    }
    
    
    function toArrayForDocumentPdf($extra=true)
    {//'energy_id','occupation_id','layer_type_id',
        $values=array();
        foreach (array('revenue'=>'getRevenue',
                       'number_of_people'=>'getNumberOfPeople',
                       'surface_wall'=>'getSurfaceWall',
                       'surface_top'=>'getSurfaceTop',
                       'surface_floor'=>'getSurfaceFloor',
                       'surface_ite'=>'getITESurface',
                       'boiler_quantity'=>'getBoilerQuantity',
                       'pack_quantity'=>'getPackQuantity',
                       'number_of_children'=>'getNumberOfChildren',
                       'parcel_surface'=>'getParcelSurface',
                       'parcel_number'=>'getParcelNumber',
                       'parcel_reference'=>' getParcelReference',
                       'install_surface_wall'=>'getInstallSurfaceWall',
                       'install_surface_top'=>'getInstallSurfaceTop',
                       'install_surface_floor'=>'getInstallSurfaceFloor',
                       'ana_prime'=>'getAnaPrime',
                        'surface_home'=>'getSurfaceHome',
                        'cef'=>'getCEF',
                        'cef_project'=>'getCEFProject',
                        'cep'=>'getCEP',
                       // 'cep_project'=>'getCEPProject',
                        'power_consumption'=>'getPowerConsumption',
                        'economy'=>'getEconomy',
                       'number_of_fiscal'=>'getNumberOfFiscal') as $field=>$formatter)
        {
            if (method_exists($this->getFormatter(), $formatter))
                $values[$field]=(string)$this->getFormatter()->$formatter();
        }
         $values['cep_project']=$this->getFormatter()->getCEPProject()->getText("#.00");
        $values['cep']=$this->getFormatter()->getCEP()->getText("#.00");
        $values['cef_project']=$this->getFormatter()->getCEFProject()->getText("#.00");
        $values['cef']=$this->getFormatter()->getCEF()->getText("#.00");
        $values['energy']=array('value'=>(string)$this->getEnergy()->getI18n(),
                                'electricity'=>$this->getEnergy()->get('name')==0?"1":"0",
                                'combustible'=>$this->getEnergy()->get('name')==1?"1":"0",  
                               );
        $values['more_2_years']=$this->get('more_2_years')=='YES'?"1":"0";     
        $values['has_strainer']=$this->get('has_strainer')=='Y'?"1":"0";  
        $values['has_bbc']=$this->get('has_bbc')=='Y'?"1":"0"; 
        $values['declarants']=$this->get('declarants');
        $values['occupation']=array(
            'value'=>(string)$this->getOccupation()->getI18n(),
            'name'=>$this->getOccupation()->get('name'),          
        );        
        $values['layer_type']=array(
            'value'=>(string)$this->getType()->getI18n(),    
            'name'=>$this->getType()->get('name'),
            'crawling'=>$this->getType()->get('name')==1?"1":"0",
            'lostfills'=>$this->getType()->get('name')==0?"1":"0",
        );
        $values['nombre_foyers_fiscaux_sup_1']=$this->get('number_of_fiscal') > 1 ?(string)$this->getFormatter()->getNumberOfFiscal():"";
        if ($extra)
        {    
            $calculation= new DomoprimeCalculation($this->getContract());       
            if ($calculation->getClass()->get('name') == 1)
            {              
                // tres modest
                $values['extra']=array(
                 //   'class'=>1,
                    'verymodest'=>array(                    
                        'numberofpeople'=>(string)$this->getFormatter()->getNumberOfPeople(),
                        'noms_prenoms_declarants'=>$this->get('declarants'),
                        'nombre_foyers_fiscaux'=>(string)$this->getFormatter()->getNumberOfFiscal(),                    
                        'nombre_foyers_fiscaux_sup_1'=>$this->get('number_of_fiscal') > 1 ?(string)$this->getFormatter()->getNumberOfFiscal():""
                    )
                );

            }   
            elseif ($calculation->getClass()->get('name') == 0)
            {            
                // modest
                $values['extra']=array(
                 //   'class'=>0,
                    'modest'=>array(
                        'numberofpeople'=>(string)$this->getFormatter()->getNumberOfPeople(),
                        'noms_prenoms_declarants'=>$this->get('declarants'),
                        'nombre_foyers_fiscaux'=>(string)$this->getFormatter()->getNumberOfFiscal(),
                        'nombre_foyers_fiscaux_sup_1'=>$this->get('number_of_fiscal') > 1 ?(string)$this->getFormatter()->getNumberOfFiscal():""
                    )
                );                      
            }     
        }        
        if ($this->hasPreviousEnergy())
        {    
          $values['previous_energy']=array('value'=>(string)$this->getPreviousEnergy()->getI18n(),
                                'electricity'=>$this->getPreviousEnergy()->get('name')==0?"1":"0",
                                'combustible'=>$this->getPreviousEnergy()->get('name')==1?"1":"0",  
                               );
        }
        return $values;
    }
    
    
    static function getRequestFromPager($pager)
    {              
       if (!$pager->hasItems())
            return null;
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT * FROM ".self::getTable().                           
                           " WHERE ".self::getTableField('contract_id')." IN(".implode(",",array_keys($pager->getItems())).")".                          
                           ";")               
                ->makeSiteSqlQuery($pager->getSite()); 
        if (!$db->getNumRows())
            return;        
        while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
        {                            
            $pager->items[$item->get('contract_id')]->request=$item->loaded()->setSite($pager->getSite());
        }               
    } 
    
    
    function getSettings()
    {
        if ($this->settings===null)
        {
            $this->settings=new DomoprimeIsoSettings(null,$this->getSite());
        }   
       return $this->settings; 
    }
    
    
    function getDocument()
    {
        if ($this->document===null)
        {
            $engine=new DomoprimeIsoDocumentEngine($this);
        }    
        return $this->document;
    }
    
    function setSurfacesChanges($surfaces)
    {
       foreach ($surfaces as $name=>$surface)
        {
            if ($this->get($name) != $surface)
               $this->set($name,$surface);   
        }   
        return $this;
    }
    
    function getSurfacesChanged($surfaces)
    {
        $changes=new mfArray();
        foreach ($surfaces as $name=>$surface)
        {
            if ($this->get($name) != $surface)
               $changes[$name]=$surface;   
        }   
        return $changes;
    }
    /*
     * SELECT * FROM t_customers_contract LEFT JOIN t_domoprime_iso_customer_request ON t_domoprime_iso_customer_request.contract_id=t_customers_contract.id WHERE t_domoprime_iso_customer_request.id IS NULL 
     */
     static function getNumberOfTransferredRequest($site=null)
    {                    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT count(".self::getTableField('id').") FROM ".self::getTable().  
                           " INNER JOIN " .self::getOuterForJoin('meeting_id').  
                           " INNER JOIN ".CustomerMeetingForms::getInnerForJoin('meeting_id').  
                           ";")               
                ->makeSiteSqlQuery($site); 
       $row=$db->fetchRow();                
       return $row[0];              
    } 
    
     static function getNumberOfTransferredRequestForContract($site=null)
    {                    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT count(".self::getTableField('id').") FROM ".self::getTable().  
                           " INNER JOIN " .self::getOuterForJoin('contract_id').  
                           " INNER JOIN ".CustomerMeetingForms::getInnerForJoin('contract_id').  
                           " WHERE ".CustomerCOntract::getTableField('meeting_id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($site); 
       $row=$db->fetchRow();                
       return $row[0];              
    } 
    
     static function getNumberOfForm($site=null)
    {                    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT count(".CustomerMeetingForms::getTableField('id').") FROM ".CustomerMeetingForms::getTable().  
                           " INNER JOIN " .CustomerMeetingForms::getOuterForJoin('meeting_id').  
                      //    " LEFT JOIN ".self::getInnerForJoin('meeting_id'). 
                      //     " WHERE ".self::getTableField('id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($site); 
                
       $row=$db->fetchRow();                
       return $row[0];              
    } 
    
    static function getNumberOfFormForContracts($site=null)
    {                    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT count(".CustomerMeetingForms::getTableField('id').") FROM ".CustomerMeetingForms::getTable().  
                           " INNER JOIN " .CustomerMeetingForms::getOuterForJoin('contract_id').  
                      //    " LEFT JOIN ".self::getInnerForJoin('meeting_id'). 
                           " WHERE ".CustomerContract::getTableField('meeting_id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($site); 
                
       $row=$db->fetchRow();                
       return $row[0];              
    } 
    
    static function transferFormToRequest($site=null)
    {    
        // SELECT * FROM `t_domoprime_iso_customer_request` INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_domoprime_iso_customer_request.meeting_id WHERE t_domoprime_iso_customer_request.contract_id IS NULL 
    //    self::truncate($site);
        $collection =new  DomoprimeCustomerRequestCollection(null,$site);
        DomoprimeCustomerMeetingForms::initializeSettings($site);
        $db=new mfSiteDatabase();
        
        $db->setParameters(array('limit'=>DomoprimeIsoSettings::load($site)->get('transfer_number_of_items',10)))                
                ->setObjects(array('DomoprimeCustomerMeetingForms','CustomerMeeting'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeCustomerMeetingForms::getTable().  
                           " INNER JOIN " .DomoprimeCustomerMeetingForms::getOuterForJoin('meeting_id').  
                           " LEFT JOIN ".self::getInnerForJoin('meeting_id'). 
                           " WHERE ".self::getTableField('id')." IS NULL".
                           " ORDER BY ".DomoprimeCustomerMeetingForms::getTableField('id')." ASC ".
                           " LIMIT 0,{limit}".
                           ";")               
                ->makeSiteSqlQuery($site); 
       //echo $db->getQuery()         ;
         if ($db->getNumRows())
         {
         
            while ($items=$db->fetchObjects())
            {                    
               $items->getDomoprimeCustomerMeetingForms()->set('meeting_id',$items->getCustomerMeeting());
               $collection[]=$items->getDomoprimeCustomerMeetingForms()->transfertToRequest();            
            } 
            $collection->save();
            self::setContractFromMeeting($site);
         }      
        //$count=self::transferFormContractsToRequest($site);
        return $collection->count();
    } 
    
    static function transferFormContractsToRequest($site=null)
    {    
        // SELECT * FROM `t_domoprime_iso_customer_request` INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_domoprime_iso_customer_request.meeting_id WHERE t_domoprime_iso_customer_request.contract_id IS NULL 
    //    self::truncate($site);
        $collection =new  DomoprimeCustomerRequestCollection(null,$site);
        DomoprimeCustomerMeetingForms::initializeSettings($site);
        $db=new mfSiteDatabase();
        
        $db->setParameters(array('limit'=>DomoprimeIsoSettings::load($site)->get('transfer_number_of_items',10)))                
                ->setObjects(array('DomoprimeCustomerMeetingForms','CustomerContract'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeCustomerMeetingForms::getTable().  
                           " INNER JOIN " .DomoprimeCustomerMeetingForms::getOuterForJoin('contract_id').  
                           " LEFT JOIN ".self::getInnerForJoin('contract_id'). 
                           " WHERE ".self::getTableField('id')." IS NULL AND ".CustomerCOntract::getTableField('meeting_id')." IS NULL".
                           " ORDER BY ".DomoprimeCustomerMeetingForms::getTableField('id')." ASC ".
                           " LIMIT 0,{limit}".
                           ";")               
                ->makeSiteSqlQuery($site); 
     // echo $db->getQuery()         ;
         if (!$db->getNumRows())
            return $collection->count();
         
        while ($items=$db->fetchObjects())
        {                    
           $items->getDomoprimeCustomerMeetingForms()->set('contract_id',$items->getCustomerContract());
           $collection[]=$items->getDomoprimeCustomerMeetingForms()->transfertToRequestContract();            
        } 
        $collection->save();
               
        return $collection->count();
    } 
    
    static function truncate($site=null)
    {
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                             
                ->setQuery("DELETE FROM ".self::getTable().                             
                           ";")               
                ->makeSiteSqlQuery($site); 
    }
    /*
     SELECT * FROM `t_domoprime_iso_customer_request`
INNER JOIN t_customers_meeting ON t_customers_meeting.id=t_domoprime_iso_customer_request.meeting_id
INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_domoprime_iso_customer_request.meeting_id
WHERE t_domoprime_iso_customer_request.contract_id IS NULL
     * 
     UPDATE `t_domoprime_iso_customer_request`
INNER JOIN t_customers_meeting ON t_customers_meeting.id=t_domoprime_iso_customer_request.meeting_id
INNER JOIN t_customers_contract ON t_customers_contract.meeting_id=t_domoprime_iso_customer_request.meeting_id
  SET t_domoprime_iso_customer_request.contract_id=t_customers_contract.id
WHERE t_domoprime_iso_customer_request.contract_id IS NULL
     */
    static function setContractFromMeeting($site=null)
    {
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("UPDATE ".DomoprimeCustomerRequest::getTable().                             
                           " INNER JOIN " .DomoprimeCustomerRequest::getOuterForJoin('meeting_id'). 
                           " INNER JOIN " .CustomerContract::getInnerForJoin('meeting_id').                            
                           " SET ".DomoprimeCustomerRequest::getTableField('contract_id')."=".CustomerContract::getTableField('id').",".
                                CustomerContract::getTableField('partner_layer_id')."=".CustomerMeeting::getTableField('partner_layer_id').
                           " WHERE ".DomoprimeCustomerRequest::getTableField('contract_id')." IS NULL".                         
                           ";")               
                ->makeSiteSqlQuery($site);  
    }
            
    
    function toArrayForTransfer()
     {
         $values=new mfArray();
         // values
         foreach (array('revenue','number_of_people','parcel_surface','parcel_reference',
                        'install_surface_wall','install_surface_top','install_surface_floor','tax_credit_used',
                        'surface_wall','surface_top','surface_floor','number_of_fiscal','more_2_years',
                        'number_of_children','declarants',  
                   //      'surface_ite','pack_quantity','boiler_quantity','number_of_parts',
                        'created_at','updated_at') as $field)
         {
             $values[$field]=$this->get($field);
         }            
         // foreign keys
        foreach (array( 'energy_id'=>'getEnergy',
                        'occupation_id'=>'getOccupation',
                         'layer_type_id'=>'getType',                                                                                                     
                 ) as $field=>$method)
         {        
             if (!$this->get($field))
                 continue;         
             $values[$field]=$this->$method()->toArrayForTransfer();
         }                
         return $values;
     }
     
     function getDocumentName($separator="_")
     {
         $values=new mfArray();
         if ($this->get('surface_top') > 0)       
            $values[]="101";       
        if ($this->get('surface_wall') > 0)       
           $values[]="102";        
        if ($this->get('surface_floor') > 0)       
            $values[]="103";      
        return $values->implode($separator);
     }
                          
      static function getNumberOfTransferredRequestForContracts($site=null)
    {                    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())                
                ->setQuery("SELECT count(".self::getTableField('id').") FROM ".self::getTable().  
                           " INNER JOIN " .self::getOuterForJoin('contract_id').  
                           " INNER JOIN ".CustomerMeetingForms::getInnerForJoin('contract_id').  
                           " WHERE ".CustomerMeetingForms::getTableField('meeting_id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($site); 
       $row=$db->fetchRow();                
       return $row[0];              
    } 
    
    
    function transferFormToRequestFromCOntract()
    {
        if ($this->isLoaded())
            return $this;
        DomoprimeCustomerMeetingForms::initializeSettings($this->getSite());
        $forms=new DomoprimeCustomerMeetingForms($this->getCOntract(),$this->getSite());
        $forms->transfertToRequestFromContract($this);
        $this->save();
        return $this;
    }
    
    function copyFrom($object,$excepted=array(),$fields=array(),$adders=array())
    {
        parent::copyFrom($object, $excepted, $fields, $adders);
        foreach (array('surface_wall','surface_top','surface_floor') as $field)
        {        
           $this->set('src_'.$field,$object->get($field));
           $this->set($field,0.0);
        }
        return $this;
    }
       
    
    function copyFromContract(CustomerContract $source)
    {      
        $request=new DomoprimeCustomerRequest($source,$this->getSite());
        $this->copyFrom($request,array('contract_id','meeting_id','customer_id'));               
        $this->save();
        return $this;
    }
    
     function copyFromMeeting(CustomerMeeting $source)
    {             
        $request=new DomoprimeCustomerRequest($source,$this->getSite());
        $this->copyFrom($request,array('meeting_id','customer_id','contract_id'));               
        $this->save();
        return $this;
    }
    
    function getQuantityByProduct(Product $product)
    {
        $names=$this->getSettings()->getSurfaceNamingsForProducts();                
        return isset($names[$product->get('id')])?$this->get($names[$product->get('id')]):0;
    }
    
    
    static function getRequestsFromContracts(CustomerContractCollection $contracts)
    {         
         $ids=new mfArray($contracts->getKeys());
         $collection=new DomoprimeCustomerRequestCollection(null,$contracts->getSite());
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("SELECT * FROM ".self::getTable().                          
                           " WHERE ".self::getTableField('contract_id')." IN('".$ids->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($contracts->getSite()); 
         if (!$db->getNumRows())
            return $collection;         
        while ($item=$db->fetchObject('DomoprimeCustomerRequest'))
        {                    
            $collection[$item->get('contract_id')]=$item->loaded()->setSite($contracts->getSite());
        } 
        return $collection;                
    }
    
    static function loadParametersForContractMultiple(mfAction $action)
    {         
         foreach (self::getRequestsFromContracts($action->getParameter('contracts')) as $request)
         {
             if (!isset($action->contracts[$request->get('contract_id')]))
                 continue;
             $action->contracts[$request->get('contract_id')]['contract']['request']=$request->toArrayForDocument();
         }                    
    }
    
    
    function hasSurfaces()
    {
        if ($this->has_surfaces===null)
        {
            $this->has_surfaces=false;
            foreach (array( 'surface_wall','surface_top','surface_floor') as $field)
            {                
                if ($this->get($field) == 0)
                     continue;
                $this->has_surfaces=true;
                break;                
            }
        }    
        return $this->has_surfaces;
    }
    
    
    static function getNumberOfRequests($site=null)
    {               
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())                
                ->setQuery("SELECT count(id) FROM ".self::getTable().                          
                           " WHERE ".self::getTableField('contract_id')." IS NOT NULL".
                           ";")               
                ->makeSiteSqlQuery($site); 
         $row=$db->fetchRow();
         return intval($row[0]);
    }
    
    
      function getRestinchargePriceWithTaxWall()
    {
        return floatval($this->get('restincharge_price_with_tax_wall'));
    }
    
      function getFormattedRestinchargePriceWithTaxWall()
    {
        return format_currency($this->getRestinchargePriceWithTaxWall(),'EUR');
    }
    
    function getRestinchargePriceWithoutTaxWall()
    {
        return floatval($this->get('restincharge_price_without_tax_wall'));
    }
    
      function getFormattedRestinchargePriceWithoutTaxWall()
    {
        return format_currency($this->getRestinchargePriceWithoutTaxWall(),'EUR');
    }
    
    
      function getAddedPriceWithTaxWall()
    {
        return floatval($this->get('restincharge_price_with_tax_wall'));
    }
    
      function getFormattedAddedPriceWithTaxWall()
    {
        return format_currency($this->getAddedPriceWithTaxWall(),'EUR');
    }
    
    function getAddedPriceWithoutTaxWall()
    {
        return floatval($this->get('restincharge_price_without_tax_wall'));
    }
    
      function getFormattedAddedPriceWithoutTaxWall()
    {
        return format_currency($this->getAddedPriceWithoutTaxWall(),'EUR');
    }
    
    
     function getRestinchargePriceWithTaxFloor()
    {
        return floatval($this->get('restincharge_price_with_tax_floor'));
    }
    
      function getFormattedRestinchargePriceWithTaxFloor()
    {
        return format_currency($this->getRestinchargePriceWithTaxFloor(),'EUR');
    }
    
    function getRestinchargePriceWithoutTaxFloor()
    {
        return floatval($this->get('restincharge_price_without_tax_floor'));
    }
    
      function getFormattedRestinchargePriceWithoutTaxFloor()
    {
        return format_currency($this->getRestinchargePriceWithoutTaxFloor(),'EUR');
    }
    
    
      function getAddedPriceWithTaxFloor()
    {
        return floatval($this->get('restincharge_price_with_tax_floor'));
    }
    
      function getFormattedAddedPriceWithTaxFloor()
    {
        return format_currency($this->getAddedPriceWithTaxFloor(),'EUR');
    }
    
    function getAddedPriceWithoutTaxFloor()
    {
        return floatval($this->get('restincharge_price_without_tax_floor'));
    }
    
      function getFormattedAddedPriceWithoutTaxFloor()
    {
        return format_currency($this->getAddedPriceWithoutTaxFloor(),'EUR');
    }
      
    /* =========================================================================== */
    
     function getRestinchargePriceWithTaxTop()
    {
        return floatval($this->get('restincharge_price_with_tax_top'));
    }
    
      function getFormattedRestinchargePriceWithTaxTop()
    {
        return format_currency($this->getRestinchargePriceWithTaxTop(),'EUR');
    }
    
    function getRestinchargePriceWithoutTaxTop()
    {
        return floatval($this->get('restincharge_price_without_tax_top'));
    }
    
      function getFormattedRestinchargePriceWithoutTaxTop()
    {
        return format_currency($this->getRestinchargePriceWithoutTaxTop(),'EUR');
    }
    
    /* =========================================================================== */
    
      function getAddedPriceWithTaxTop()
    {
        return floatval($this->get('added_price_with_tax_top'));
    }
    
      function getFormattedAddedPriceWithTaxTop()
    {
        return format_currency($this->getAddedPriceWithTaxTop(),'EUR');
    }
    
    function getAddedPriceWithoutTaxTop()
    {
        return floatval($this->get('added_price_without_tax_top'));
    }
    
      function getFormattedAddedPriceWithoutTaxTop()
    {
        return format_currency($this->getAddedPriceWithoutTaxTop(),'EUR');
    }
        
    /* =========================================================================== */
        
    function getAddedPriceWithoutTaxForType($type)
    {
        return floatval($this->get('added_price_without_tax_'.$type));
    }
    
      function getFormattedAddedPriceWithoutTaxForType($type)
    {
        return format_currency($this->getAddedPriceWithoutTaxTopForType($type),'EUR');
    }
    
      function getRestInChargePriceWithoutTaxForType($type)
    {
        return floatval($this->get('restincharge_price_without_tax_'.$type));
    }
    
      function getFormattedRestInChargePriceWithoutTaxForType($type)
    {
        return format_currency($this->getRestInChargePriceWithoutTaxTopForType($type),'EUR');
    }
    
    /* =========================================================================== */
    
    function getAddedPriceWithTaxForType($type)
    {
        return floatval($this->get('added_price_with_tax_'.$type));
    }
    
      function getFormattedAddedPriceWithTaxForType($type)
    {
        return format_currency($this->getAddedPriceWithTaxTopForType($type),'EUR');
    }
    
      function getRestInChargePriceWithTaxForType($type)
    {
        return floatval($this->get('restincharge_price_with_tax_'.$type));
    }
    
      function getFormattedRestInChargePriceWithTaxForType($type)
    {
        return format_currency($this->getRestInChargePriceWithTaxTopForType($type),'EUR');
    }
    
    
    function hasNumberOfParts()
    {
        return (boolean)$this->get('number_of_parts');
    }
    
    function getITESurface()
    {
        return intval($this->get('surface_ite'));
    }
    
    function getFormattedITESurface()
    {
        return new FloatFormatter($this->get('surface_ite'));
    }
    
    function getBoilerPackQuantity()
    {
        return intval($this->get('packboiler_quantity'));
    }
    
    function getFormattedBoilerPackQuantity()
    {
        return new FloatFormatter($this->get('packboiler_quantity'));
    }
    
    function getBoilerQuantity()
    {
        return intval($this->get('boiler_quantity'));
    }
    
    function getPackQuantity()
    {
        return intval($this->get('pack_quantity'));
    }
    
    function getFormattedPackQuantity()
    {
        return new FloatFormatter($this->get('pack_quantity'));
    }
    
    function getFormattedType1Quantity()
    {
        return new FloatFormatter($this->get('surface_ite'));
    }
    
    function getFormattedType2Quantity()
    {
        return new FloatFormatter($this->get('surface_ite'));
    }
       
     function getFormattedBoilerQuantity()
    {
        return new FloatFormatter($this->get('boiler_quantity'));
    }
    
    function getAnaPrime()
    {
        return intval($this->get('ana_prime'));
    }
    
    function getFormattedAnaPrime()
    {
        return new FloatFormatter($this->get('ana_prime'));
    }
        
    function hasPreviousEnergy()
    {
       return (boolean)$this->get('previous_energy_id'); 
    }
    
    function getPreviousEnergy()
    {
        return $this->_previous_energy_id=$this->_previous_energy_id===null?new DomoprimePreviousEnergy($this->get('previous_energy_id'),$this->getSite()):$this->_previous_energy_id;
    }
    
    function getSurfaceHome()
    {
        return floatval($this->get('surface_home'));
    }
    
    function hasSurfaceHome()
    {
        return $this->getSurfaceHome() > 0 ;
    }
    
    function hasCef()
    {
        return (boolean)$this->get('cef');
    }
    
    function getCEF()
    {
        return floatval($this->get('cef'));
    }
    
     function hasCEFProject()
    {
        return (boolean)$this->get('cef_project');
    }
    
     
    function getCEFProject()
    {
         return floatval($this->get('cef_project'));
    }
    
    function hasCEP()
    {
         return (boolean)$this->get('cep'); 
    }
    
    function getCEP()
    {
         return floatval($this->get('cep'));
    }
    
    function hasCEPProject()
    {
       return (boolean)$this->get('cep_project');   
    }
    
    function getCEPProject()
    {
          return floatval($this->get('cep_project'));
    }
    
    function hasPowerConsumption()
    {
         return (boolean)$this->get('power_consumption');   
    }
    
    function getPowerConsumption()
    {
        return floatval($this->get('power_consumption'));   
    }
    
      function hasEconomy()
    {
         return (boolean)$this->get('economy');   
    }
    
    function getEconomy()
    {
          return floatval($this->get('economy'));  
    }
    
    
     function getCefMinusCefProject()
    {
          return $this->getCEF() - $this->getCEFProject();
    }
           
    function hasEngine()
    {
        return (boolean)$this->get('engine_id');
    }
    
    function getEngine()
    {
        return $this->_engine_id=$this->_engine_id===null?new DomoprimeCumacEngineSetting($this->get('engine_id'),$this->getSite()):$this->_engine_id;
    }
    
     function getNumberOfPeople()
    {
        return floatval($this->get('number_of_people'));
    }
    
     function getNumberOfParts()
    {
        return floatval($this->get('number_of_parts'));
    }
    
    function hasEnergyClass()
    {
        return (boolean)$this->get('energy_class');
    }
    
    function hasPreviousEnergyClass()
    {
         return (boolean)$this->get('previous_energy_class');
    }
    
    function getEnergyClass()
    {
         return new DomoprimeEnergyClass($this->get('energy_class'));
    }
    
    function getPreviousEnergyClass()
    {
        return new DomoprimeEnergyClass($this->get('previous_energy_class'));
    }
    
    
    function getHomeSurface()
    {
        return floatval($this->get('surface_home'));
    }
    
    function hasBBCSubvention()
    {
        return $this->get('has_bbc')=='Y';
    }
   
    function hasPassoireSubvention()
    {
        return $this->get('has_strainer')=='Y';
    }
    
    
    static function affectNewEnergy(DomoprimeEnergy $current_energy,DomoprimeEnergy $new_energy,$site=null)
    {  
         if ($current_energy->get('id')==$new_energy->get('id'))
             return $this;
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array("current_energy_id"=>$current_energy->get('id'),"new_energy_id"=>$new_energy->get('id')))                
                ->setQuery("UPDATE ".self::getTable().  
                           " SET " .self::getTableField('energy_id'). " = ".  "'{new_energy_id}'".
                           " WHERE ".self::getTableField('energy_id')." = ". "'{current_energy_id}'".
                           ";")               
                ->makeSiteSqlQuery($site);    
         //       echo $db->getQuery();
 
    }
    
    
     function getRoofType1()
    {
       return $this->_roof_type1_id=$this->_roof_type1_id===null?new CustomerContractRoofType($this->get('roof_type1_id'),$this->getSite()):$this->_roof_type1_id;     
    }
    
      function getRoofType2()
    {
       return $this->_roof_type2_id=$this->_roof_type2_id===null?new CustomerContractRoofType($this->get('roof_type2_id'),$this->getSite()):$this->_roof_type2_id;     
    }
    
     function getCounterType()
    {
       return $this->_counter_type_id=$this->_counter_type_id===null?new CustomerContractCounterType($this->get('counter_type_id'),$this->getSite()):$this->_counter_type_id;     
    }
    
     function getEquipmentType()
    {
       return $this->_equipment_type_id=$this->_equipment_type_id===null?new CustomerContractEquipmentType($this->get('equipment_type_id'),$this->getSite()):$this->_equipment_type_id;     
    }
    
     function getHouseType()
    {
       return $this->_house_type_id=$this->_house_type_id===null?new CustomerContractHouseType($this->get('house_type_id'),$this->getSite()):$this->_house_type_id;     
    }
    
    function toArrayForApi2()
    {
        if ($this->to_array_for_api2===null)
        {                            
            $this->to_array_for_api2=new mfArray($this->toArray([   'energy_id','occupation_id','layer_type_id',
                                   'revenue','number_of_people','parcel_surface','parcel_reference',
                                   'install_surface_wall','install_surface_top','install_surface_floor','tax_credit_used',
                                   'surface_wall','surface_top','surface_floor',
                                   'number_of_fiscal','more_2_years',
                                   'src_surface_wall','src_surface_top','src_surface_floor',
                                   'number_of_children','declarants',        
                                   'added_price_with_tax_wall',
                                   'added_price_without_tax_wall',
                                   'added_price_with_tax_floor',
                                   'added_price_without_tax_floor',
                                   'added_price_with_tax_top',
                                   'added_price_without_tax_top',        
                                   'restincharge_price_with_tax_wall',
                                   'restincharge_price_without_tax_wall',
                                   'restincharge_price_with_tax_floor',
                                   'restincharge_price_without_tax_floor',
                                   'restincharge_price_with_tax_top',
                                   'restincharge_price_without_tax_top',
                                   'pricing_id',
                                   'previous_energy_id','surface_home','engine_id',
                                   'number_of_parts','surface_ite','packboiler_quantity',
                                   'pack_quantity','boiler_quantity','ana_prime',
                                   'has_strainer','has_bbc',
                                   'energy_class','previous_energy_class',
                                   'cef','cef_project','cep','cep_project','power_consumption','economy',
                                   'counter_type_id','equipment_type_id','house_type_id','roof_type1_id','roof_type2_id','build_year'])); 
            
            }
        return $this->to_array_for_api2;
    }
}
