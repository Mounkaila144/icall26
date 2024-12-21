<?php

class DomoprimeCalculationBase extends mfObject2 {
     
    protected static $fields=array( 'region_id','sector_id','contract_id','meeting_id','class_id','revenue','signature',
                            'energy_id','zone_id','purchasing_price','margin_price','polluter_pricing',
                            'number_of_people','number_of_parts','qmac_value','qmac', 'user_id', 'accepted_by_id' ,'isLast' ,'status', 
                            'polluter_id','causes','customer_id','work_id','number_of_quotations','cee_prime',
                            'is_ana_available','is_economy_valid','budget',
                            'beta_surface' ,'economy','cumac_coefficient' ,'min_cee','coef_sale_price','quotation_coefficient','is_quotations_valid',
                            'engine_id','pricing_id','cef_cef_project','ana_prime','bbc_subvention','subvention','prime','budget_to_add_ttc','budget_to_add_ht',
                            'created_at', 'updated_at');
    const table="t_domoprime_calculation";
     protected static $foreignKeys=array('region_id'=>'DomoprimeRegion',
                                         'class_id'=>'DomoprimeClass',
                                         'sector_id'=>'DomoprimeSector',         
                                         'zone_id'=>'DomoprimeZone',
                                         'energy_id'=>'DomoprimeEnergy',
                                         'meeting_id'=>'CustomerMeeting',
                                         'contract_id'=>'CustomerContract',
                                         'user_id'=>'User', 
                                         'accepted_by_id'=>'User',
                                         'customer_id'=>'Customer',
                                         'polluter_id'=>'DomoprimePollutingCompany',
                                         'work_id'=>'DomoprimeCustomerContractWork',
                                         'engine_id'=>'DomoprimeCumacEngineSetting',
                                         'pricing_id'=>'DomoprimeIsoCumacPrice',
                                         ); // By default
     
      protected static $fieldsNull=array( 'polluter_id','causes','meeting_id','is_quotations_valid','contract_id','customer_id','work_id','engine_id','pricing_id'); // By default
      
      
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          return $this->add($parameters); 
      }   
      else
      {                     
         if ($parameters instanceof CustomerContract)
            return $this->loadByContract($parameters);  
         if ($parameters instanceof DomoprimeCustomerContractWork)
            return $this->loadByWorkForContract($parameters);  
         if ($parameters instanceof CustomerMeeting)
            return $this->loadByMeeting($parameters);
         if ($parameters instanceof DomoprimeIso2CumacEngine)
            return $this->loadByDomoprimeIso2CumacEngine($parameters);   
         if ($parameters instanceof DomoprimeEngine)
            return $this->loadByDomoprimeEngine($parameters);  
         if ($parameters instanceof DomoprimeIsoEngine)
            return $this->loadByDomoprimeIsoEngine($parameters);             
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);          
      }   
    }
    
    
     protected function loadByDomoprimeIsoEngine(DomoprimeIsoEngine $engine)
    {      
        $this->engine=$engine;
        $this->loadByDomoprimeEngine($engine);       
    } 
    
    protected function loadByDomoprimeIso2CumacEngine(DomoprimeIso2CumacEngine $engine)
    {
        $this->engine=$engine;
        $this->loadByDomoprimeEngine($engine);       
    }       
          
     protected function loadByDomoprimeEngine($engine)
    {                         
        $this->engine=$engine;                                                            
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('sector_id'=>$this->getEngine()->getZone()->getSector()->get('id'),
                                      'zone_id'=>$this->getEngine()->getZone()->get('id'),
                                      'region_id'=>$this->getEngine()->getZone()->getRegion()->get('id'),
                                      'meeting_id'=>$this->getEngine()->hasMeeting()?$this->getEngine()->getMeeting()->get('id'):null,
                                      'contract_id'=>$this->getEngine()->hasContract()?$this->getEngine()->getContract()->get('id'):null,
                                      'class_id'=>$this->getEngine()->getClass()->get('id'),
                                      'energy_id'=>$this->getEngine()->getEnergy()->get('id'),
                                      'revenue'=>$this->getEngine()->getRevenue(),
                                      'qmac'=>$this->getEngine()->getTotalQmac(),                                     
                                      'number_of_people'=>$this->getEngine()->getNumberOfPeople(),
                                      'polluter_id'=>$this->getEngine()->hasPolluter()?$this->getEngine()->getPolluter()->get('id'):null,
                            ))
                ->setQuery("SELECT * FROM ".self::getTable()." WHERE sector_id='{sector_id}' AND ".
                                    "zone_id = '{zone_id}' AND ".
                                    "(".
                                         "(".
                                             "meeting_id ".($this->getEngine()->hasMeeting()?"='{meeting_id}' ":"IS NULL").
                                            " AND ".
                                             "contract_id ='{contract_id}' ".
                                         ")".
                                            " OR ".
                                         "(".
                                            "meeting_id ='{meeting_id}' ".
                                            " AND ".
                                            "contract_id ".($this->getEngine()->hasContract()?"='{contract_id}' ":"IS NULL").
                                         ")".
                                    ") AND ".
                                    "class_id = '{class_id}' AND ".
                                    "energy_id = '{energy_id}' AND ".
                                    "revenue = '{revenue}' AND ".
                                    "qmac = '{qmac}' AND ".
                                    "number_of_people = '{number_of_people}' AND ".
                                    "polluter_id ".($this->getEngine()->hasPolluter()?"='{polluter_id}' ":"IS NULL")." AND ".
                                    "isLast='YES'".
                           ";")
                ->makeSiteSqlQuery($this->site);          
         //echo $db->getQuery();        
      //   SystemDebug::getInstance()->addMessage($db->getQuery());
         return $this->rowtoObject($db);
    }
    
    protected function loadByWork($work)
    {                                      
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                                      'work_id'=>$work->get('id'),                                     
                            ))
                ->setQuery("SELECT * FROM ".self::getTable()." WHERE work_id = '{work_id}' AND ".                                  
                                    "isLast='YES'".
                           ";")
                ->makeSiteSqlQuery($this->site);                              
         return $this->rowtoObject($db);
    }
    
    protected function loadByMeeting($meeting)
    {                                      
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                                      'meeting_id'=>$meeting->get('id'),                                     
                            ))
                ->setQuery("SELECT * FROM ".self::getTable()." WHERE meeting_id = '{meeting_id}' AND ".                                  
                                    "isLast='YES'".
                           ";")
                ->makeSiteSqlQuery($this->site);                              
         return $this->rowtoObject($db);
    }
    
     protected function loadByContract($contract)
    {                                    
        if ($contract->isNotLoaded())
            return ;
     //   if ($contract->getMeeting()->isNotLoaded())
      //      return; 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                                      'meeting_id'=>$contract->get('meeting_id'),
                                      'contract_id'=>$contract->get('id')
                            ))
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE (meeting_id = '{meeting_id}' OR contract_id='{contract_id}') AND isLast='YES' ".
                           " ORDER BY id DESC LIMIT 0,1".
                           ";")
                ->makeSiteSqlQuery($this->site);                              
         return $this->rowtoObject($db);
    }
    
     protected function loadByWorkForContract($work)
    {                                    
        if ($work->isNotLoaded())
            return ;        
     //   if ($contract->getMeeting()->isNotLoaded())
      //      return; 
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array(
                                      'meeting_id'=>$work->getContract()->get('meeting_id'),
                                      'contract_id'=>$work->getContract()->get('id')
                            ))
                ->setQuery("SELECT * FROM ".self::getTable().
                           " WHERE (meeting_id = '{meeting_id}' OR contract_id='{contract_id}') AND isLast='YES' ".
                           " ORDER BY id DESC LIMIT 0,1".
                           ";")
                ->makeSiteSqlQuery($this->site);                              
         $this->rowtoObject($db);
         $this->set('work_id',$work);
         return $this;
    }
    
 /*   protected function loadByName($name)
    {
         $this->set('name',$name);
         $db=mfSiteDatabase::getInstance()->setParameters(array($name));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s';")
            ->makeSiteSqlQuery($this->site);                           
         return $this->rowtoObject($db);
    }*/
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
       $this->status=isset($this->status)?$this->status:"REQUEST";
       $this->isLast=isset($this->isLast)?$this->isLast:"YES";
       $this->is_ana_available=isset($this->is_ana_available)?$this->is_ana_available:"N";
       $this->is_quotation_valid=isset($this->is_quotation_valid)?$this->is_quotation_valid:"NO";
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
    
  /*  protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }*/
    
    
   function getRegion()
    {
       if ($this->_region_id===null)
       {
          $this->_region_id=new DomoprimeRegion($this->get('region_id'),$this->getSite());          
       }   
       return $this->_region_id;
    }  
    
       function getClass()
    {
       if ($this->_class_id===null)
       {
          $this->_class_id=new DomoprimeClass($this->get('class_id'),$this->getSite());          
       }   
       return $this->_class_id;
    }  
    
      function getMeeting()
    {
       if ($this->_meeting_id===null)
       {
          $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());          
       }   
       return $this->_meeting_id;
    }  
    
    function getSector()
    {
       if ($this->_sector_id===null)
       {
          $this->_sector_id=new DomoprimeSector($this->get('sector_id'),$this->getSite());          
       }   
       return $this->_sector_id;
    } 
    
     function getEnergy()
    {
       if ($this->_energy_id===null)
       {
          $this->_energy_id=new DomoprimeEnergy($this->get('energy_id'),$this->getSite());          
       }   
       return $this->_energy_id;
    } 
    
      function getZone()
    {
       if ($this->_zone_id===null)
       {
          $this->_zone_id=new DomoprimeZone($this->get('zone_id'),$this->getSite());          
       }   
       return $this->_zone_id;
    } 
    
    function getUser()
    {
        if ($this->_user_id===null)
       {
          $this->_user_id=new User($this->get('user_id'),'admin',$this->getSite());          
       }   
       return $this->_user_id;
    }
    
    function hasAcceptedBy()
    {
        return $this->get('accepted_by_id');
    }
    
    function getAcceptedBy()
    {
         if ($this->_accepted_by_id===null)
       {
          $this->_accepted_by_id=new User($this->get('accepted_by_id'),'admin',$this->getSite());          
       }   
       return $this->_accepted_by_id;
    }
    
    function getEngine()
    {
        return $this->engine;
    }
    
    function updateLast()
    {  // SELECT count(id),contract_id FROM `t_domoprime_calculation` WHERE isLast='YES' GROUP BY contract_id HAVING count(id) > 1        
        $db=mfSiteDatabase::getInstance();
        if ($this->hasMeeting())
        {    
            $db->setParameters(array('meeting_id'=>$this->getEngine()->getMeeting()->get('id')))
                    ->setQuery("UPDATE ".self::getTable()." SET isLast='NO' WHERE meeting_id = '{meeting_id}' ".                                  
                               ";") ;                 
        }
        else
        {
            $db=mfSiteDatabase::getInstance()
                    ->setParameters(array('contract_id'=>$this->getEngine()->getContract()->get('id')))
                    ->setQuery("UPDATE ".self::getTable()." SET isLast='NO' WHERE contract_id = '{contract_id}' ".                                  
                               ";");                  
        }    
        $db->makeSiteSqlQuery($this->site);  
    }
    
    function getStatusI18n()
    {
        return __($this->get('status'),array(),'messages','app_domoprime');
    }
    
    function isAccepted()
    {
        return ($this->get('status')=='ACCEPTED');
    }
    
    function isRefused()
    {
        return ($this->get('status')=='REFUSED'); 
    }
    
    function setAccepted($user)
    {
        $this->set('accepted_by_id',$user->getGuardUser());
        $this->set('status','ACCEPTED');
        return $this;
    }
    
    function setRefused($user)
    {
        $this->set('accepted_by_id',$user->getGuardUser());
        $this->set('status','REFUSED');
        return $this;
    }
    
    
    function process(User $user)
    {                                     
        $this->is_modified=false;
        $this->set('sector_id',$this->getEngine()->getZone()->getSector());
        $this->set('zone_id',$this->getEngine()->getZone());
        $this->set('region_id',$this->getEngine()->getZone()->getRegion());
        $this->set('meeting_id',$this->getEngine()->hasMeeting()?$this->getEngine()->getMeeting():null);  
        if (!$this->hasContract())
            $this->set('contract_id',$this->getEngine()->hasContract()?$this->getEngine()->getContract():null);
        $this->set('class_id',$this->getEngine()->getClass());
        $this->set('energy_id',$this->getEngine()->getEnergy());
        $this->set('revenue',$this->getEngine()->getRevenue());        
        $this->set('number_of_people',$this->getEngine()->getNumberOfPeople());
        $this->set('qmac_value',$this->getEngine()->getTotalValueQmac());
        $this->set('qmac',$this->getEngine()->getTotalQmac()); 
        $this->set('purchasing_price',$this->getEngine()->getTotalPose());
        $this->set('margin_price',$this->getEngine()->getTotalMargin());  
        $this->set('causes',$this->getEngine()->getCauses()->implode(','));        
        $this->set('customer_id',$this->getEngine()->hasMeeting()?$this->getEngine()->getMeeting()->getCustomer():$this->getEngine()->getContract()->getCustomer());         
        if ($this->getEngine()->hasPolluter())
        {    
            $this->set('polluter_id',$this->getEngine()->getPolluter());
        }         
        if ($this->getEngine()->isAccepted())
        {
            $this->set('status','ACCEPTED');            
        }   
        elseif ($this->getEngine()->isRefused())
        {
            $this->set('status','REFUSED');
        }              
        if ($this->isNotLoaded())
        {                  
            $this->is_modified=true;
            // Transfert to contract
         //   mfContext::getInstance()->getEventManager()->notify(new mfEvent($this->getMeeting(), 'meeting.change'));
            $this->updateLast();
            $this->set('user_id',$user);  
            $this->set('isLast','YES');
            $this->save();            
        }    
        if (!$this->is_modified)
            return $this;
        // products
        $collection=new DomoprimeProductCalculationCollection(null,$this->getSite()); 
        foreach ($this->getEngine()->getProducts() as $product_energy)
        {
            $item=new DomoprimeProductCalculation(null,$this->getSite());
            $item->add(array('calculation_id'=>$this,
                             'qmac'=>$product_energy->getTotalQmac(),
                             'product_id'=>$product_energy->getProduct(),
                             'qmac_value'=>$product_energy->getTotalValueQmac(),
                             'purchasing_price'=>$product_energy->getTotalPose(),
                             'margin'=>$product_energy->getTotalMargin(),
                             'surface'=>$product_energy->getSurface()
                        ));
            $collection[]=$item;
        }    
        $collection->save();
        return $this;
    }
    
    function isModified()
    {
        return $this->is_modified;
    }
    
    
    static function generateCalculationForContracts(CustomerContractMultipleProcess $multiple)
    {
        //var_dump($multiple->getSelection());
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())
                ->setObjects(array('CustomerContract','Customer'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."')".
                           ";")
                ->makeSiteSqlQuery($multiple->getSite());
         if (!$db->getNumRows())
             return ;
         $contracts=new mfArray();
         while ($items=$db->fetchObjects())
         {
             $item=$items->getCustomerContract();
             $item->set('customer_id',$items->getCustomer());
             $contracts[]=$item;
         }                 
         foreach ($contracts as $contract)
         {
             try
             {
                $engine=new DomoprimeEngine($contract);
                $engine->process();
                $report=new DomoprimeCalculation($engine);
                $report->process(mfContext::getInstance()->getUser()->getGuardUser());    
             } 
             catch (mfException $ex) 
             {
                $multiple->getMessages()->push(__("Customer [%s] ",$contract->getCustomer()->getName()).$ex->getMessage());
                 // Remove last calculation
                $report=new DomoprimeCalculation($contract);
                $report->release();
             }
         }                               
    }
    
    function hasPolluter()
    {
        return (boolean)$this->get('polluter_id');
    }
   
     function getPolluter()
    {
        if ($this->_polluter_id===null)
        {
            $this->_polluter_id= new DomoprimePollutingCompany($this->get('polluter_id'),$this->getSite());
        }    
        return $this->_polluter_id;
    }
            
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeCalculationFormatter($this);
        }    
        return $this->formatter;
    }
    
    
     function getPollutersForSelect($site=null)
    {       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".DomoprimeCalculation::getTable().
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('polluter_id').                                                       
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('name')." ASC ".                          
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();        
        $items=array();
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                              
            $items[$item->get('id')]=strtoupper($item->get('name'));
        }      
        return $items;
    }  
    
     function getPolluters($site=null)
    {       
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable()." FROM ".DomoprimeCalculation::getTable().
                           " LEFT JOIN ".DomoprimeCalculation::getOuterForJoin('polluter_id').                                                       
                           " GROUP BY ".PartnerPolluterCompany::getTableField('id').
                           " ORDER BY ".PartnerPolluterCompany::getTableField('name')." ASC ".                           
                           ";")               
                ->makeSiteSqlQuery($site); 
        if (!$db->getNumRows())
            return array();        
        $items=array();
        while ($item=$db->fetchObject('PartnerPolluterCompany'))
        {                           
            if ($item->get('id'))                
             $items[$item->get('id')]=$item->loaded();
            else
             $items[0]=$item->set('id',0);            
        }           
        return $items;
    } 
    
       
    
    function getCauses()
    {
        return new DomoprimeCauses($this->get('causes'));
    }
    
   /* NO SITE */ 
    static function getNumberOfOperationsFromFilter($filter)
    {              
         $query= clone $filter->getMfQuery();
         $query->select("count(".DomoprimeProductCalculation::getTableField('id').") as number_of_operations")
                 ->select(DomoprimeProductCalculation::getTableField('product_id')) 
                 //->inner(CustomerContract::getOuterForJoin('meeting_id'))
                 //->inner(DomoprimeCalculation::getInnerForJoin('meeting_id'))
                  ->inner(DomoprimeCalculation::getInnerForJoin('contract_id'))    
                 ->inner(DomoprimeProductCalculation::getInnerForJoin('calculation_id'))
                 ->where("isLast='YES' AND ".DomoprimeProductCalculation::getTableField('surface')." > 0")
                 ->where($filter->getWhere())                 
                 ->groupBy(DomoprimeProductCalculation::getTableField('product_id'));
         $query->getGroupBy()->findAndRemove(CustomerContract::getTableField('id'));
         $query->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'))
                          ->findAndRemove(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".DomoprimeCalculation::getTableField("isLast='YES'"))
                          ->findAndRemove(ProductInstallerSchedule::getInnerForJoin('contract_id'));  
         $query->getSelect()->findAndRemove("{fields}"); 
         $collection=new DomoprimeOperationCollection();
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry()))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
     //  echo $db->getQuery(); die(__METHOD__);
         if (!$db->getNumRows())
            return $collection;    
         $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection[$product_surface[$row['product_id']]]=$row['number_of_operations'];
        }
        return $collection;
    }
    
  
     static function getNumberOfCumacFromFilter($filter)
    {                           
        $query= clone $filter->getMfQuery();       
         $query->select("sum(".DomoprimeCalculation::getTableField('qmac').") as number_of_cumac")    
               //   ->inner(CustomerContract::getOuterForJoin('meeting_id'))
               // ->inner(DomoprimeCalculation::getInnerForJoin('meeting_id'))              
                 ->inner(DomoprimeCalculation::getInnerForJoin('contract_id'))    
                 ->where("isLast='YES'")
                 ->where($filter->getWhere());              
         $query->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'));         
         $query->getJoin()->findAndRemove(ProductInstallerSchedule::getInnerForJoin('contract_id'));   
         $query->getJoin()->findAndRemove(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".DomoprimeCalculation::getTableField("isLast='YES'"));  
         $query->getSelect()->findAndRemove("{fields}");       
         $query->getGroupBy()->findAndRemove(CustomerContract::getTableField('id'));
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry(),
                                         'user_id'=>mfContext::getInstance()->getUser()->getGuardUser()->get('id')
                                        ))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
     //  echo $db->getQuery();       
        SystemDebug::getInstance()->addMessage($db->getQuery())
                                  ->dump($query);                                                          
        $row=$db->fetchArray();       
        return new FloatFormatter($row['number_of_cumac']?$row['number_of_cumac']:0.0);
    }
    
    static function getNumberOfSurfacesFromFilter($filter)
    {       
        $query= clone $filter->getMfQuery();
         $query->select("sum(".DomoprimeProductCalculation::getTableField('surface').") as number_of_surfaces")
                 ->select(DomoprimeProductCalculation::getTableField('product_id')) 
                ->inner(DomoprimeCalculation::getInnerForJoin('contract_id'))
             //    ->inner(CustomerContract::getOuterForJoin('meeting_id'))
             //    ->inner(DomoprimeCalculation::getInnerForJoin('meeting_id'))
                 ->inner(DomoprimeProductCalculation::getInnerForJoin('calculation_id'))
                 ->where("isLast='YES' AND ".DomoprimeProductCalculation::getTableField('surface')." > 0")
                 ->where($filter->getWhere())
                 ->groupBy(DomoprimeProductCalculation::getTableField('product_id'));
         $query->getGroupBy()->findAndRemove(CustomerContract::getTableField('id'));
         $query->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'))
                          ->findAndRemove(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".DomoprimeCalculation::getTableField("isLast='YES'"))
                          ->findAndRemove(ProductInstallerSchedule::getInnerForJoin('contract_id'));  
         $query->getSelect()->findAndRemove("{fields}"); 
         $collection=new DomoprimeSurfaceCollection();
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry(),
                                         'user_id'=>mfContext::getInstance()->getUser()->getGuardUser()->get('id')
                       ))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
      //  echo "<!--". $db->getQuery(). "-->";
       SystemDebug::getInstance()->addMessage($db->getQuery()); 
         if (!$db->getNumRows())
            return $collection;    
         $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection["surface_".$product_surface[$row['product_id']]]=$row['number_of_surfaces'];
        }
        return $collection;
    }
    
    static function getNumberOfCumacsFromFilter($filter)
    {       
        $query= clone $filter->getMfQuery();
         $query->select("sum(".DomoprimeProductCalculation::getTableField('qmac').") as number_of_cumacs")
                 ->select(DomoprimeProductCalculation::getTableField('product_id')) 
                 ->inner(DomoprimeCalculation::getInnerForJoin('contract_id'))   
               //  ->inner(CustomerContract::getOuterForJoin('meeting_id'))
              //   ->inner(DomoprimeCalculation::getInnerForJoin('meeting_id'))                 
                 
                 
                 ->inner(DomoprimeProductCalculation::getInnerForJoin('calculation_id'))
                 ->where("isLast='YES' AND ".DomoprimeProductCalculation::getTableField('surface')." > 0")
                 ->where($filter->getWhere())
                 ->groupBy(DomoprimeProductCalculation::getTableField('product_id'));
         $query->getGroupBy()->findAndRemove(CustomerContract::getTableField('id'));
         $query->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'))
                          ->findAndRemove(ProductInstallerSchedule::getInnerForJoin('contract_id'))
                          ->findAndRemove(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".DomoprimeCalculation::getTableField("isLast='YES'"));  
         $query->getSelect()->findAndRemove("{fields}"); 
         $collection=new DomoprimeQmacCollection();
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry(),
                                          'user_id'=>mfContext::getInstance()->getUser()->getGuardUser()->get('id')
                                ))               
                ->setQuery((string)$query)               
                ->makeSqlQuery();     
       SystemDebug::getInstance()->addMessage($db->getQuery()); 
         if (!$db->getNumRows())
            return $collection;    
         $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
        while ($row=$db->fetchArray())
        {  
            $collection[$product_surface[$row['product_id']]]=$row['number_of_cumacs'];
        }
        return $collection;
    }
    
     function toArrayForQuotation()
    {
        $values=array();
        $values['class']=$this->getClass()->toArrayForQuotation();        
        $values['sector']=$this->getSector()->get('name');      
        $values['qmac_classic_zero']=$this->getSettings()->get('classic_class')==$this->get('class_id')?format_number($this->get('qmac'),'#.00'):"0";
        $values['qmac_precarity_zero']=$this->getSettings()->get('classic_class')!=$this->get('class_id')?format_number($this->get('qmac'),'#'):"0"; 
        $values['polluter_pricing']=(string)$this->getFormatter()->getPolluterPricing()->getText();
        $values['cumac_coefficient']=(string)$this->getFormatter()->getCumacCoefficient()->getText();
        return $values;
    }
    
     function toArrayForBilling()
    {
       return $this->toArrayForQuotation();
    }
    
     function toArrayForDocument()
    {
        $values=parent::toArray(array('region_id','sector_id','meeting_id','class_id','revenue',
                            'energy_id','zone_id','purchasing_price','margin_price',
                            'number_of_people','qmac_value','qmac', 'user_id', 'accepted_by_id' ,'isLast' ,'status', 
                            'polluter_id'));
        $values['class']=$this->getClass()->toArrayForDocument();        
        $values['sector']=$this->getSector()->get('name');  
        $values['polluter_pricing']=(string)$this->getFormatter()->getPolluterPricing()->getText();
        return $values;
    }
    
    function toArrayForDocumentPdf()
    {        
        $values=parent::toArray(array('region_id','sector_id','meeting_id','class_id','revenue',
                            'energy_id','zone_id','purchasing_price','margin_price',
                            'number_of_people','qmac_value','qmac', 'user_id', 'accepted_by_id' ,'isLast' ,'status', 
                            'polluter_id'));
        $values['class']=$this->getClass()->toArrayForDocumentPdf();         
        $values['sector']=$this->getSector()->get('name');                                                
        $values['products']=$this->getProductCalculationCollection()->toArrayForDocumentPdf();  
      
        $values['qmac_text']=format_number($this->get('qmac'),'#');
        $values['qmac_classic']=$this->getSettings()->get('classic_class')==$this->get('class_id')?format_number($this->get('qmac'),'#'):"";
        $values['qmac_precarity']=$this->getSettings()->get('classic_class')!=$this->get('class_id')?format_number($this->get('qmac'),'#'):"";
        $values['qmac_classic_zero']=$this->getSettings()->get('classic_class')==$this->get('class_id')?format_number($this->get('qmac'),'#'):"0";
        $values['qmac_precarity_zero']=$this->getSettings()->get('classic_class')!=$this->get('class_id')?format_number($this->get('qmac'),'#'):"0";
        $values['qmac_classic_zero_1000']=$this->getSettings()->get('classic_class')==$this->get('class_id')?format_number($this->get('qmac') /1000,'#.00'):"0";
        $values['qmac_precarity_zero_1000']=$this->getSettings()->get('classic_class')!=$this->get('class_id')?format_number($this->get('qmac') / 1000,'#.00'):"0";
                 
        $values['qmac_value_text']=format_number($this->get('qmac_value'),'#.00');
        $values['qmac_value_classic']=$this->getSettings()->get('classic_class')==$this->get('class_id')?format_number($this->get('qmac_value'),'#.00'):"";
        $values['qmac_value_precarity']=$this->getSettings()->get('classic_class')!=$this->get('class_id')?format_number($this->get('qmac_value'),'#.00'):"";
        $values['qmac_value_classic_zero']=$this->getSettings()->get('classic_class')==$this->get('class_id')?format_number($this->get('qmac_value'),'#.00'):"0";
        $values['qmac_value_precarity_zero']=$this->getSettings()->get('classic_class')!=$this->get('class_id')?format_number($this->get('qmac_value'),'#.00'):"0";
        if ($this->getClass()->get('name')=="1")                                       
            $values['type_grille_precarite_a_ou_b']=__("prime + surprime grille A",[],'messages','app_domoprime');           
        elseif ($this->getClass()->get('name')=="0")                        
            $values['type_grille_precarite_a_ou_b']=__("prime B",[],'messages','app_domoprime');                 
        else                      
            $values['type_grille_precarite_a_ou_b']=__("prime",[],'messages','app_domoprime');    
        $values['polluter_pricing']=(string)$this->getFormatter()->getPolluterPricing()->getText();
        return $values;
    }
    
    
    
      function getContract()
    {
       if ($this->_contract_id===null)
       {
          $this->_contract_id=new CustomerContract($this->get('contract_id'),$this->getSite());          
       }   
       return $this->_contract_id;
    }  
    
     function hasContract()
    {         
       return (boolean)$this->get('contract_id');
    }  
    
      function hasMeeting()
    {         
       return (boolean)$this->get('meeting_id');
    }  
    
    function getCustomer()
    {
       if ($this->_customer_id===null)
       {
          $this->_customer_id=new Customer($this->get('customer_id'),$this->getSite());          
       }   
       return $this->_customer_id; 
    }
    
    
    /* ================NO SITE ==================*/
     static function getStatisticsByPollutersFromFilter($filter)
    {       
         $query= clone $filter->getMfQuery();
         $query->select("{fields},count(".DomoprimeProductCalculation::getTableField('id').") as `number_of_operations`")
                 ->select("sum(".DomoprimeProductCalculation::getTableField('qmac').") as number_of_cumacs")
                 ->select("sum(".DomoprimeProductCalculation::getTableField('surface').") as number_of_surfaces")               
                 ->select(DomoprimeProductCalculation::getTableField('product_id'))        
                  ->inner(DomoprimeCalculation::getInnerForJoin('contract_id'))   
              //   ->inner(CustomerContract::getOuterForJoin('meeting_id'))
              //   ->inner(DomoprimeCalculation::getInnerForJoin('meeting_id'))
                 ->inner(DomoprimeProductCalculation::getInnerForJoin('calculation_id'))
                 ->where("isLast='YES' AND ".DomoprimeProductCalculation::getTableField('surface')." > 0")
                 ->where($filter->getWhere())
                 ->orderBy(DomoprimePollutingCompany::getTableField('name'))
                 ->groupBy(DomoprimeProductCalculation::getTableField('product_id'))
                 ->groupBy(DomoprimeCalculation::getTableField('polluter_id'));
         $query->getGroupBy()->findAndRemove(CustomerContract::getTableField('id'));
         $query->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'))
                          ->findAndRemove(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".DomoprimeCalculation::getTableField("isLast='YES'"))
                          ->findAndRemove(ProductInstallerSchedule::getInnerForJoin('contract_id'));  
         $query->getSelect()->findAndRemove("{fields}");     
         $collection=new mfArray();
         $db=mfSiteDatabase::getInstance()
                 ->setObjects(array('DomoprimePollutingCompany'))
                ->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry(),
                                      'user_id'=>mfContext::getInstance()->getUser()->getGuardUser()->get('id')
                    ))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
      // echo $db->getQuery();
         if (!$db->getNumRows())
            return $collection;    
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
                
        while ($items=$db->fetchObjects())
        {  
          // echo "<pre>"; var_dump($items); echo "<pre>";
            if ($items->hasDomoprimePollutingCompany())           
            {    
              $item=$items->getDomoprimePollutingCompany();
            }   
            else
            {                 
               $item=new  DomoprimePollutingCompany();
            }                      
            if (!isset($collection[(int)$item->get('id')]))                      
                $collection[(int)$item->get('id')]=$item;                                        
            $collection[(int)$item->get('id')]->addOperation($product_surface[$items->product_id],$items->number_of_operations);            
            $collection[(int)$item->get('id')]->addCumac($product_surface[$items->product_id],$items->number_of_cumacs);            
            $collection[(int)$item->get('id')]->addSurface("surface_".$product_surface[$items->product_id],$items->number_of_surfaces);   
        }       
        return $collection;
    }
    
    static function setContractForCalculationsFromMeeting(CustomerContract $contract)
    {
       if (!$contract->hasMeeting())
           return ;    
       $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$contract->get('id'),'meeting_id'=>$contract->getMeeting()->get('id')))               
                ->setQuery("UPDATE ".self::getTable().
                           " SET contract_id='{contract_id}'".
                           " WHERE meeting_id='{meeting_id}'".
                           ";")               
                ->makeSiteSqlQuery($contract->getSite());       
    }
    
    
     static function getStatisticsFromFilter($filter)
    {     /* SITE */
                        
         $query= clone $filter->getMfQuery();
         $query->select("count(".DomoprimeProductCalculation::getTableField('id').") as `number_of_operations`")
                 ->select("sum(".DomoprimeProductCalculation::getTableField('qmac').") as number_of_cumacs")
                 ->select("sum(".DomoprimeProductCalculation::getTableField('surface').") as number_of_surfaces")               
                 ->select(DomoprimeProductCalculation::getTableField('product_id'))        
                 ->inner(DomoprimeCalculation::getInnerForJoin('contract_id'))                
                 ->inner(DomoprimeProductCalculation::getInnerForJoin('calculation_id'))
                 ->where("isLast='YES' AND ".DomoprimeProductCalculation::getTableField('surface')." > 0")
                 ->where($filter->getWhere())                
                 ->groupBy(DomoprimeProductCalculation::getTableField('product_id'));                 
         $query->getGroupBy()->findAndRemove(CustomerContract::getTableField('id'));
         $query->getJoin()->findAndRemove(CustomerContractProduct::getInnerForJoin('contract_id'))
                          ->findAndRemove(DomoprimeCalculation::getInnerForJoin('contract_id')." AND ".DomoprimeCalculation::getTableField("isLast='YES'"))
                          ->findAndRemove(ProductInstallerSchedule::getInnerForJoin('contract_id'));  
         $query->getSelect()->findAndRemove("{fields}");            
         $collection=new mfArray();
         $db=mfSiteDatabase::getInstance()                 
                ->setParameters(array('lang'=>mfContext::getInstance()->getUser()->getCountry(),
                                      'user_id'=>mfContext::getInstance()->getUser()->getGuardUser()->get('id')
                    ))               
                ->setQuery((string)$query)               
                ->makeSqlQuery(); 
      // echo $db->getQuery();
         if (!$db->getNumRows())
            return $collection;    
        $product_surface=DomoprimeSettings::load()->getTypeNamesForProducts();
                
        while ($row=$db->fetchArray())
        {  
          //echo "<pre>"; var_dump($row); echo "<pre>";
          
        }       
        return $collection;
    }
    
    
    function getProductCalculationCollection()
    {
         $collection=new DomoprimeProductCalculationCollection(null,$this->getSite());
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('calculation_id'=>$this->get('id')))
                ->setObjects(array('Product','DomoprimeProductCalculation'))
                ->setQuery("SELECT {fields} FROM ".DomoprimeProductCalculation::getTable().
                           " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id').
                           " WHERE ".DomoprimeProductCalculation::getTableField('calculation_id')."='{calculation_id}'".
                           ";")
                ->makeSiteSqlQuery($this->getSite());
         if (!$db->getNumRows())
            return $collection; 
        while ($items=$db->fetchObjects())
        {  
            $items->getDomoprimeProductCalculation()->set('product_id',$items->getProduct());
            $collection[]=$items->getDomoprimeProductCalculation();
        }
        
      //  echo "<pre>"; var_dump($collection);
        
        return $collection; 
    }
    
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new DomoprimeSettings(null,$this->getSite()):$this->settings;
    }
    
    function isLast()
    {
        return $this->get('isLast')=='YES';
    }
    
    function release()
    {
        if ($this->isNotLoaded())
            return $this;
        if (!$this->isLast())
            return $this;
        $this->set('isLast','NO');
        $this->save();
        return $this;
    }
    
    static function deleteForContracts(CustomerContractMultipleProcess $multiple)
    {
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("DELETE FROM ".self::getTable().                           
                           " WHERE contract_id IN('".$multiple->getSelection()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($multiple->getSite());                  
    }
    
    
     static function updateCalculationWithContractFromMultipleMeetings(CustomerMeetingMultipleProcess $multiple)
    {        
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("UPDATE ".self::getTable(). 
                           " INNER JOIN ".CustomerContract::getTable()." ON ".CustomerContract::getTableField('meeting_id')."=".self::getTableField('meeting_id').
                           " SET ".self::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                           " WHERE ".self::getTableField('meeting_id')." IN('".$multiple->getSelection()->implode("','")."')".
                           ";")               
                ->makeSiteSqlQuery($multiple->getSite());                  
    } 
    
    function hasClass()
    {
        return (boolean)$this->get('class_id');
    }
    
    
     function getPricing()
    {
        return $this->_pricing_id= $this->_pricing_id ===null?new DomoprimeIsoCumacPrice($this->get('pricing_id'),$this->getSite()):$this->_pricing_id;
    }
    
    function hasQuotationsValid($true=true,$false=false)
    {
        return (boolean)$this->get('is_quotations_valid')?$true:$false;
    }
    
    function isQuotationsValid($true=true,$false=false)
    {
        return $this->get('is_quotations_valid')=='YES'?$true:$false;
    }
        
    function getSubvention()
    {
        return floatval($this->get('subvention'));
    }
    
    function getBBcSubvention()
    {
        return floatval($this->get('bbc_subvention'));
    }
    
    function getAnaprime()
    {
        return floatval($this->get('ana_prime'));
    }
        
     function getPrime()
    {
        return floatval($this->get('prime'));
    }
    
      function getMinCee()
    {
        return floatval($this->get('min_cee'));
    }
    
    function getBudget()
    {
        return floatval($this->get('budget'));
    }
    
     function getBudgetToAddTTC()
    {
        return floatval($this->get('budget_to_add_ttc'));
    }
    
      function getBudgetToAddHT()
    {
        return floatval($this->get('budget_to_add_ht'));
    }
    
    function getPolluterPricing()
    {
        return floatval($this->get('polluter_pricing'));
    }
    
      function getTotalCeePrime()
    {
        return floatval($this->get('cee_prime'));
    }
    
    function isEconomyValid($true=true,$false=false)
    {
        return $this->get('is_economy_valid')=='Y'?$true:$false;
    }
    
    function hasWork()
    {
        return (boolean)$this->get('work_id');
    }
    
     function isAnaAvailable($true=true,$false=false)
    {
        return $this->get('is_ana_available')=='Y'?$true:$false;
    }
}
