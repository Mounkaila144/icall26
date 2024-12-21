<?php


class DomoprimeProductCalculationBase extends mfObject2 {
     
    protected static $fields=array( 'calculation_id','product_id','work_id','surface','purchasing_price','margin','qmac_value','qmac','created_at', 'updated_at');
    const table="t_domoprime_product_calculation"; 
    protected static $foreignKeys=array('calculation_id'=>'DomoprimeCalculation',   
                                         'work_id'=>'DomoprimeCustomerContractWork',
                                         'product_id'=>'Product',                                       
                                         );  
    protected static $fieldsNull=array('work_id');
    
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
       
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    { 
      $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
      $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
      $this->qmac_value=isset($this->qmac_value)?$this->qmac_value:0.00;
      $this->qmac=isset($this->qmac)?$this->qmac:0.00;  
      $this->purchasing_price=isset($this->purchasing_price)?$this->purchasing_price:0.00;  
      $this->margin_price=isset($this->margin_price)?$this->margin_price:0.00;       
      $this->surface=isset($this->surface)?$this->surface:0.00;       
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
      $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
         ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' AND name!='' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    
    function hasSurface()
    {
        return (boolean)$this->surface;
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeProductCalculationFormatter($this);
        }   
        return $this->formatter;
    }
    
    function getFormattedSurfacePrime()
    {
       return format_number($this->get('surface') * $this->getProduct()->get('prime_price'),"#.00")    ;
    }
    
     function getFormattedQmac()
    {
       return format_number($this->get('qmac'),"#.00")    ;
    }
    
    function toArrayForDocumentPdf()
    {                
         return array(         
            'prime_price'=>$this->getProduct()->getFormattedPrimePrice(),
            'prime'=>$this->getFormattedSurfacePrime(),
            'qmac'=>$this->getFormattedQmac()
         );
    }
    
    function getProduct()
    {
        if ($this->_product_id===null)
        {
            $this->_product_id=new Product($this->get('product_id'),$this->getSite());
        }    
        return $this->_product_id;
    }
    
    function getWork()
    {
        return $this->_work=$this->work_id===null?new DomoprimeCustomerContractWork($this->get('work_id'),$this->getSite()):$this->_work_id;
    }
    
    
    static function getProductCalculationByPager($pager)
    {
       $calculations=new mfArray($pager->getKeys());
       $db=mfSiteDatabase::getInstance()
                         ->setParameters(array())
                         ->setObjects(array('DomoprimeProductCalculation'))
                         ->setQuery("SELECT {fields} FROM ".DomoprimeProductCalculation::getTable(). 
                                    " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id').
                                    " WHERE calculation_id IN('".$calculations->implode("','")."')".
                                    " ORDER BY reference ASC".
                                    ";")
                         ->makeSqlQuery();                
                if (!$db->getNumRows())
                    return ;                           
        while ($items=$db->fetchObjects())
        {          
           $item= $items->getDomoprimeProductCalculation();          
           $pager[$item->get('calculation_id')]->addDomoprimeProductCalculation($items->getDomoprimeProductCalculation());
        }    
    }
}
