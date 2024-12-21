<?php

class DomoprimeAssetBase extends mfObject2 {
     
    protected static $fields=array('meeting_id','contract_id','reference','month','year','day',
                                   'total_asset_without_tax','total_tax','company_id',    
                                   'total_asset_with_tax',   'comments', 'work_id'                                                   ,
                                   'customer_id','creator_id','billing_id',
                                   'dated_at','status',
                                   'created_at','updated_at');
    const table="t_domoprime_asset"; 
    protected static $foreignKeys=array('meeting_id'=>'CustomerMeeting',    
                                        'contract_id'=>'CustomerContract',    
                                        'customer_id'=>'Customer',
                                        'creator_id'=>'User',
                                        'billing_id'=>'DomoprimeBilling',       
                                        'company_id'=>'CustomerContractCompany',
                                        'work_id'=>'DomoprimeCustomerContractWork',
                                        ); 
    protected static $fieldsNull=array('dated_at','meeting_id','contract_id','billing_id','company_id','work_id' ); // By default
   
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
         return $this->loadByEmail((string)$parameters);
      }   
    }
    
  /*  protected function loadByEmail($email)
    {
         $this->set('email',$email);
         $db=mfSiteDatabase::getInstance()->setParameters(array($email));
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE email='%s';")
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
        $this->status=isset($this->status)?$this->status:"ACTIVE";
        
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
            
    function create(CustomerContract $contract,$form,User $user)
    {
        $this->set('contract_id',$contract);
        $this->set('meeting_id',$contract->getMeeting());
        $this->set('customer_id',$contract->getCustomer());
        $this->set('company_id',$contract->getCompany());
        $this->set('month',date('m'));
        $this->set('year',date('Y'));
        $this->set('day',date('d'));  
        $this->set('dated_at',$form->getValue('dated_at'));
        $this->set('creator_id',$user);
        $this->save();   
        
        $this->set('total_asset_with_tax',$form->getValue('total_asset_with_tax'));
        $this->set('reference',$this->getFormattedReference());
        $this->save();
        return $this;
    }
    
    
    function createFromBilling(DomoprimeBilling $billing,User $user)
    {
        if ($billing->isNotLoaded())
            return $this;
        $this->set('contract_id',$billing->getContract());
        $this->set('billing_id',$billing);
        $this->set('work_id',$billing->get('work_id'));
        $this->set('meeting_id',$billing->getContract()->getMeeting());
        $this->set('customer_id',$billing->getContract()->getCustomer());
        $this->set('company_id',$billing->getContract()->getCompany());
        $this->set('month',date('m'));
        $this->set('year',date('Y'));
        $this->set('day',date('d'));  
        $this->set('dated_at',date('Y-m-d H:i:s'));
        $this->set('creator_id',$user);
        $this->save();   
        
        $this->set('total_asset_with_tax',$billing->get('total_sale_with_tax'));
        $this->set('total_asset_without_tax',$billing->get('total_sale_without_tax'));
        $this->set('total_tax',$billing->get('total_sale_with_tax') - $billing->get('total_sale_without_tax'));
        $this->set('reference',$this->getFormattedReference());
        $this->save();
        return $this;
    }
    
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    function getMeeting()
    {
        return $this->_meeting_id=$this->_meeting_id===null?new CustomerMeeting($this->get('meeting_id'),$this->getSite()):$this->_meeting_id;
    }
    
     function hasContract()
    {
        return (boolean)$this->get('contract_id');
    }
    
     function getContract()
    {
        return $this->_contract_id=$this->_contract_id===null?new CustomerContract($this->get('contract_id'),$this->getSite()):$this->_contract_id;
    }
    
    function getCustomer()
    {
        return $this->_customer_id=$this->_customer_id===null?new Customer($this->get('customer_id'),$this->getSite()):$this->_customer_id;
    }
    
    function getCreator()
    {
        return $this->_creator_id=$this->_creator_id===null?new User($this->get('creator_id'),'admin',$this->getSite()):$this->_creator_id;
    }
    
    function hasCreator()
    {
       return (boolean)$this->get('creator_id');
    }
    
     function hasBilling()
    {
        return (boolean)$this->get('billing_id');
    }
    
   function getBilling()
    {
        return $this->_billing_id=$this->_billing_id===null?new DomoprimeBilling($this->get('billing_id'),$this->getSite()):$this->_billing_id;
    }
 
    function getTotalWithoutTax()
    {
        return floatval($this->get('total_asset_without_tax'));                                  
    }
    
    function getFormattedTotalWithoutTax()
    {
        return format_currency($this->getTotalWithoutTax(),'EUR');
    }
  
    function getTotalWithTax()
    {
        return floatval($this->get('total_asset_with_tax'));                                   
    }
    
    function getFormattedTotalWithTax()
    {
        return format_currency($this->getTotalWithTax(),'EUR');
    }
    
    function getTotalTax()
    {
        return floatval($this->get('total_tax'));                                   
    }
    
    function getFormattedTotalTax()
    {
        return format_currency($this->getTotalTax(),'EUR');
    }
    
    function getSettings()
    {
        if ($this->settings===null)
        {
           $this->settings= new DomoprimeSettings(null,$this->getSite());
        }   
        return $this->settings;
    }
    
 
    function toArrayForAsset()
    {
        $values=parent::toArray(array());       
        foreach (array(                       
                       'total_without_tax'=>'FormattedTotalWithOutTax',
                       'total_with_tax'=>'FormattedTotalWithTax',            
                       'total_tax'=>'FormattedTotalTax',            
                       'reference'=>'FormattedReference',
                    ) as $name=>$method)
        {
            $method='get'.$method;
            $values[$name]=$this->$method();
        }     
        return $values;
    }             

    
    function getFormattedReference()
    {        
        $parameters=array('{id}'=>$this->get('id'), 
                          '{yyyy}'=>date('Y'),
                          '{mm}'=>date('m'),                          
                          '{dd}'=>date('d'));
        if (strpos($this->getSettings()->get('asset_reference_format'),'{id_company}')!==false)            
           $parameters['{id_company}'] = $this->getNumberOfAssets() + 1;    
        return strtr($this->getSettings()->get('asset_reference_format'), $parameters);   
    } 
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new DomoprimeAssetFormatter($this);
        }   
        return  $this->formatter;
    }
    
    function hasDatedAt()
    {
        return $this->get('dated_at');
    }
    
    
     function getCompany()
    {
        return $this->_company_id=$this->_company_id===null?new CustomerContractCompany($this->get('company_id'),$this->getSite()):$this->_company_id;
    }
    
     function getNumberOfAssets()
    {
        if ($this->number_of_assets===null)
        {    
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array( 'company_id'=>$this->get('company_id'),
                                        'contract_id'=>$this->get('contract_id')
                                        ))                       
                ->setQuery("SELECT count(".DomoprimeAsset::getTableField('id').") FROM ".DomoprimeAsset::getTable().                           
                           " WHERE ". DomoprimeAsset::getTableField('contract_id')."='{contract_id}' AND ".
                                      DomoprimeAsset::getTableField('company_id').($this->getContract()->hasCompany()?" ='{company_id}' ":" IS NULL").
                           ";")
                ->makeSiteSqlQuery($this->getSite());                   
            $row=$db->fetchRow();
            $this->number_of_assets=intval($row[0]);                 
        }
        return $this->number_of_assets;
    }
    
     function getWork()
     {
          return  $this->_work_id = $this->_work_id ===null ?new DomoprimeCustomerContractWork($this->get('work_id')):$this->_work_id;
     }
}
