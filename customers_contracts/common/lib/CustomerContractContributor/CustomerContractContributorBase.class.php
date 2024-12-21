<?php

class CustomerContractContributorBase extends mfObject2 {
     
            
    protected static $fields=array('contract_id','team_id','user_id','attribution_id','payment_at','type','created_at','updated_at');
    const table="t_customers_contracts_contributor"; 
    protected static $foreignKeys=array('contract_id'=>'CustomerContract',
                                        'attribution_id'=>'UserAttribution',
                                        'team_id'=>'UserTeam',
                                        'user_id'=>'User'); // By default
    protected static $fieldsNull=array('payment_at','team_id','user_id');  
  
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
    
   
   
    public function getUser()
    {      
        if ($this->_user_id===null)
        {
            $this->_user_id=new User($this->get('user_id'),$this->getSite());          
        }    
        return $this->_user_id;
    }
    
    function getContract()
    {
        if ($this->_contract_id===null)
        {
            $this->_contract_id=new CustomerContract($this->get('contract_id'),$this->getSite());
        }    
        return $this->_contract_id;
    }  
    
    function hasUser()
    {
        return (boolean)$this->get('user_id');
    }
    
    function hasTeam()
    {
        return (boolean)$this->get('team_id');
    }
    
    function getUserAttribution()
    {
        if ($this->_attribution_id===null)
        {
            $this->_attribution_id=new UserAttribution($this->get('attribution_id'),$this->getSite());
        }   
        return $this->_attribution_id;
    }
   
    function hasPaymentAt()
    {
        return (boolean)$this->get('payment_at');
    }
    
    function getTeam()
    {
        return $this->_team_id=$this->_team_id===null?new UserTeam($this->get('team_id'),$this->getSite()):$this->_team_id;
    }
    
    
    
    static function getNumberOfContractsToComplete($site=null)
    {
        $db=mfSiteDatabase::getInstance() 
            ->setParameters(array())           
            ->setQuery("SELECT count(contract_id) FROM (SELECT contract_id,count(".CustomerContractContributor::getTableField('id').") as number_of_contributor".
                       " FROM ".CustomerContractContributor::getTable().                                     
                       " GROUP BY contract_id".
                       " HAVING number_of_contributor < 6) as a".                               
                       ";")
            ->makeSiteSqlQuery($site); 
       $row=$db->fetchRow();
       return $row[0];
    }
    
    
    
    
    static function updateAttributionsCompletion($site=null)
    {
       $collection = new CustomerContractContributorCollection(null,$site);
        // SELECT contract_id,count(t_customers_contracts_contributor.id) as number_of_contributor FROM t_customers_contracts_contributor GROUP BY contract_id HAVING number_of_contributor < 6 LIMIT 0,1000;
       $db=mfSiteDatabase::getInstance();
       $db->setParameters(array())           
            ->setQuery("SELECT contract_id,count(".CustomerContractContributor::getTableField('id').") as number_of_contributor".
                       " FROM ".CustomerContractContributor::getTable().                      
                       " GROUP BY contract_id".
                       " HAVING number_of_contributor < 6".
                       " LIMIT 0,500".
                       ";")
            ->makeSiteSqlQuery($site);   
           // echo $db->getQuery();
            if ($db->getNumRows())
            {                                       
                $list=new mfArray();
                while ($row=$db->fetchArray())            
                    $list[$row['contract_id']]=$row['contract_id'];             
              // With at least one          
              $db->setParameters(array())           
                 ->setQuery("SELECT * FROM ".CustomerContractContributor::getTable().                      
                           " WHERE contract_id IN('".$list->implode("','")."')".
                           ";")
                 ->makeSiteSqlQuery($site);   
               if (!$db->getNumRows())
                      return ;     
               $list_contributors= new mfArray();              
               while ($item=$db->fetchObject('CustomerContractContributor'))  
               {
                   if (!isset($list_contributors[$item->get('contract_id')]))
                       $list_contributors[$item->get('contract_id')]=new CustomerContratContributors();
                   $list_contributors[$item->get('contract_id')]->addContributor($item->loaded());
               }        

               foreach ($list_contributors as $contract_id=>$contributors)
               {              
                   foreach ($contributors->getMissingTypes() as $type)
                   {
                       $contributor=new CustomerContractContributor(null,$site);
                       $contributor->add(array('type'=>$type,'contract_id'=>$contract_id));
                       $collection[]=$contributor;
                   }    
               }  
            }           
           // With no
           $db->setParameters(array())           
             ->setQuery("SELECT ".CustomerContract::getTableField('id')." FROM ".CustomerContract::getTable(). 
                        " LEFT JOIN ".CustomerContractContributor::getInnerForJoin('contract_id'). 
                        " WHERE ".CustomerContractContributor::getTableField('id')." IS NULL".
                        ";")
             ->makeSiteSqlQuery($site);  
           if ($db->getNumRows())
           {
               while ($row=$db->fetchArray())     
               {
                    foreach (array('telepro','sale_1','sale_2','assistant','manager','team') as $type)
                    {                       
                        $contributor=new CustomerContractContributor(null,$site);
                        $contributor->add(array('type'=>$type,'contract_id'=>$row['id']));
                        $collection[]=$contributor;
                    }  
               }        
           }                                 
           $collection->save();   
                                 
    }        
    
}
