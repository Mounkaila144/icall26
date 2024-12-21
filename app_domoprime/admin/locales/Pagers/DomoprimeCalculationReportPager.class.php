<?php

class DomoprimeCalculationReport extends DomoprimeCalculation {

    protected $calculation_products=null;
    
    function addDomoprimeProductCalculation(DomoprimeProductCalculation $calculation_product)
    {
        if ($this->calculation_products===null)        
            $this->calculation_products=new DomoprimeProductCalculationCollection();        
       // if (isset($this->calculation_products[$calculation_product->get('product_id')]))
      //      return ;
        $this->calculation_products[$calculation_product->get('product_id')]=$calculation_product;
        return $this;
    }
    
    function getProductCalculationCollection()
    {
       return $this->calculation_products; 
    }
    
    function getCustomer()
    {
        return $this->customer;
    }
    
    function setCustomer(Customer $customer)
    {
        $this->customer=$customer;
        return $this;
    }
    
     function getContract()
    {
        return $this->contract;
    }
    
    function setContract($contract)
    {
        $this->contract=$contract;
        return $this;
    }
    
    function initializeProducts($products)
    {
        if ($this->calculation_products===null)        
            $this->calculation_products=new DomoprimeProductCalculationCollection();  
        foreach ($products as $product)
           $this->calculation_products[$product->get('id')] = new DomoprimeProductCalculation();
        return $this;
    }
    
    
    function getTotalSurface()
    {
        if ($this->total_surface===null)
        {
            $this->total_surface=0;
            foreach ($this->calculation_products as $calculation_product)
            {
                $this->total_surface+=$calculation_product->get('surface');
            }    
        }   
        return $this->total_surface;
    }
    
    
    
     function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeCalculationReportFormatter($this);
        }    
        return $this->formatter;
    }
}

class DomoprimeCalculationReportContractCollection extends mfArray {

    
}

class DomoprimeCalculationReportPager extends Pager {

    
    function __construct()
    {             
       parent::__construct(array('Customer',
                                'DomoprimeCalculationReport', 
                                'CustomerContract',
                                'CustomerAddress'
                               ));        
      $this->getProducts();
    }        
            
    protected function fetchObjects($db)
    {               
       while ($items = $db->fetchObjects()) 
       {                             
              $item=$items->getDomoprimeCalculationReport();    
              $items->getCustomer()->set('address',$items->getCustomerAddress());
              $item->initializeProducts($this->getproducts());
              $item->setCustomer($items->getCustomer());              
              $item->setContract($items->getCustomerContract());
              $this->items[$item->get('id')]=$item;                            
            //  $this->items[$item->get('id')]->addDomoprimeProductCalculation($items->getDomoprimeProductCalculation());
       }     
      DomoprimeProductCalculation::getProductCalculationByPager($this);       
    }
   
  
    
     function  getProducts()
    {
        if ($this->products===null)
        {
            $this->products=new ProductCollection();
            $db=mfSiteDatabase::getInstance()                       
                ->setParameters(array())              
                ->setQuery("SELECT * FROM ".Product::getTable().
                           " WHERE status='ACTIVE' AND is_active='YES'".
                           " ORDER BY reference ASC ".
                           ";")
                ->makeSqlQuery(); 
             if (!$db->getNumRows())
                    return $this->products;                
            while ($item=$db->fetchObject('Product'))
            {                             
               $this->products[$item->get('id')]=$item;
            }                    
        }    
        return $this->products;
    }
}

