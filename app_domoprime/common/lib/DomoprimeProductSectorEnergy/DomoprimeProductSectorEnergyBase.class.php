<?php


class DomoprimeProductSectorEnergyBase extends mfObject2 {
     
    protected static $fields=array('energy_id','product_id','sector_id','price','created_at','updated_at');
    const table="t_domoprime_product_sector_energy"; 
     protected static $foreignKeys=array('energy_id'=>'DomoprimeEnergy',
                                         'product_id'=>'DomoprimeProduct',
                                         'sector_id'=>'DomoprimeSector'); // By default
    
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
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);         
      }   
    }
    
   /* protected function loadByName($name)
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
    
    protected function executeIsExistQuery($db)    
    {      
      $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
      $db->setParameters(array('product_id'=>$this->get('product_id'),
                               'sector_id'=>$this->get('sector_id'),
                               'energy_id'=>$this->get('energy_id'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName().
                    " FROM ".self::getTable().
                    " WHERE product_id='{product_id}' AND sector_id='{sector_id}' AND energy_id='{energy_id}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
      function getEnergy()
    {
       if (!$this->_energy_id)
       {
          $this->_energy_id=new DomoprimeEnergy($this->get('energy_id'),$this->getSite());          
       }   
       return $this->_energy_id;
    }  
    
     function getProduct()
    {
       if (!$this->_product_id)
       {
          $this->_product_id=new Product($this->get('product_id'),$this->getSite());          
       }   
       return $this->_product_id;
    }  
    
     function getSector()
    {
       if (!$this->_sector_id)
       {
          $this->_sector_id=new DomoprimeSector($this->get('sector_id'),$this->getSite());          
       }   
       return $this->_sector_id;
    }  
    
    function getPrice()
    {
        return (float)$this->get('price');
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
    
    function getSurface()
    {
        return $this->surface;
    }
    
    function hasSurface()
    {
        return (boolean)$this->surface;
    }
    
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new DomoprimeSettings(null,$this->getSite()):$this->settings;
    }
    
    function process(DomoprimeEngine $engine)
    {             
        $class=$engine->getClass();
       // echo "<pre>"; var_dump($this->getSettings()->get('coef_multiples'));
        if ($engine->hasPolluter())
        {
            $coefficient=$engine->getClassPolluterPricing()->getCoefficient()->getValue();
           // var_dump($engine->getClassPolluterPricing()->getCoefficient()->isNull());
            if ($engine->getClassPolluterPricing()->getCoefficient()->isNull())
                $coefficient=$class->getCoefficient();        
        }   
        else
        {
            $coefficient=$class->getCoefficient();         
        }            
        $this->surface=$engine->getSurfaceFromProduct($this->getProduct());           
        if ($this->getSettings()->get('coef_multiples',false))
        {
            $multiple=$class->getMultipleByType($engine->getNameFromProduct($this->getProduct()));
            if ($multiple)
            {                              
                $this->total_qmac= (float)$this->surface * $this->getPrice() * $class->getMultiple() * $multiple;
                $this->total_value_qmac = $coefficient * $this->total_qmac; 
            }   
            else
            {                       
                $this->total_qmac= (float)$this->surface * $this->getPrice() * $class->getMultiple();
                $this->total_value_qmac = $coefficient * $this->total_qmac; 
            }                        
        }   
        else
        {                
            $this->total_qmac= (float)$this->surface * $this->getPrice() * $class->getMultiple();                    
            $this->total_value_qmac = $coefficient * $this->total_qmac; 
        }                   
        $this->total_pose=$this->surface * $this->getProduct()->get('purchasing_price');      
        $this->total_margin=$this->total_value_qmac - $this->total_pose;      
    }
        
   
}
