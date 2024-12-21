<?php

class CustomerContractExportKMLFilterBase extends CustomerContractExportKMLCollection {
    
    protected $filter=null,$options=null,$number_of_items=0,$user=null;
    
    function __construct($filter,$user,ContractExportKmlOptions $options,$site=null) 
    {
       $this->filter=$filter;    
       $this->site=$site;        
       $this->user=$user;
       $this->options=$options;
       $this->filename=self::getDirectory($this->site)."/".$this->getName();
       $this->_query=new mfQuery();
       $this->objects=new mfArray();
       $this->execute();
    }        
    
    function getUser()
    {
        return $this->user;
    }
    
    function getObjects()
    {
        return $this->objects;
    }
    
    function getSite()
    {
        return $this->site;
    }
        
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getMfQuery()
    {
       return $this->_query; 
    }
    
   
    function getFilter()
    {
        return $this->filter;
    }
    
    protected function getItemsFromDatabase($db)
    {      
        $this->collection=array();
        if (!$db->getNumRows())
            return ;              
        while ($items=$db->fetchObjects())
        {           
           $items->getCustomer()->set('address',$items->getCustomerAddress());
           $items->getCustomerContract()->set('customer_id',$items->getCustomer());           
           $dept=  substr($items->getCustomer()->getAddress()->get('postcode'),0,2);
           mfContext::getInstance()->getEventManager()->notify(new mfEvent($items, 'contract.filter.kml.data'));  
           if ($this->getOptions() && $this->getOptions()->isSavAtMode())
           {
               $date=$items->getCustomerContract()->getFormatter()->getSavAt()->getDate();       
           }  
           elseif ($this->getOptions() && $this->getOptions()->isSavAtRangeMode())
           {             
              $date=$items->hasCustomerContractRangeI18n() ? strtoupper((string)$items->getCustomerContractRangeI18n()):__('Not defined');                
           }
           elseif ($this->getOptions() && $this->getOptions()->isOpcAtMode())
           {
               $date=$items->getCustomerContract()->getFormatter()->getOpcAt()->getDate();       
           }  
           elseif ($this->getOptions() && $this->getOptions()->isOpcRangeMode())
           {
              $date=$items->hasCustomerContractRangeI18n() ? strtoupper((string)$items->getCustomerContractRangeI18n()):__('Not defined');                
           }   
           else
           {               
               $date=$items->getCustomerContract()->getFormatter()->getOpenedAt()->getDate(); 
           }              
          // var_dump($date);die(__METHOD__);
           $this->collection[$dept][$date][]=$items->getCustomerContract();
        }              
        ksort($this->collection);   
    }
          
    function execute()
    {                       
        $db=mfSiteDatabase::getInstance()
                ->setParameters()
                ->setObjects(array('Customer','CustomerContract','CustomerAddress'))
                ->setQuery("SELECT {fields} FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " WHERE ".CustomerAddress::getTableField('coordinates')."!='' ".
                           " AND ".CustomerContract::getTableField('status')."='ACTIVE'".
                           $this->getFilter()->getWhere('AND').
                           " ORDER BY opened_at ASC".
                           ";")               
                ->makeSiteSqlQuery($this->site); 
        $this->number_of_items=$db->getNumRows();    
        $this->getItemsFromDatabase($db);    
    }
    
     function getNumberOfItems()
    {
        return $this->number_of_items;
    }
}

