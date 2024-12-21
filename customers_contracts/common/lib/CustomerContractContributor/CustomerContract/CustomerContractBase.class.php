<?php

class CustomerContractBase extends mfObject2 {
      
    
    protected static $fields=array('customer_id','reference','meeting_id','financial_partner_id','tax_id','opened_at',
                                   'total_price_with_taxe','total_price_without_taxe','status',        
                                   'team_id','telepro_id','sale_1_id','sale_2_id','manager_id',     
                                   'closed_at', 'has_tva','advance_payment','admin_status_id','remarks', //'menusality',                                   
                                   'opened_at_range_id','sav_at_range_id', //'callcenter_id',
                                   'is_revivable','is_signed','quoted_at','billing_at','is_billable',
                                    'dates_is_opened','dates_opened_at_by','dates_opened_at','dates_is_valid',
                                   'partner_layer_id','opc_status_id','polluter_id','install_state_id','time_state_id',
                                   'is_confirmed','is_hold','opc_range_id','sav_at','doc_at','is_hold_admin','is_hold_quote',
                                   'is_document','is_photo','is_quality','company_id','is_works_hold',
                                   'sent_at','payment_at','state_id','opc_at','apf_at','assistant_id','created_by_id',
                                   'pre_meeting_at','created_at','updated_at');
    const table="t_customers_contract"; 
    protected static $foreignKeys=array('customer_id'=>'Customer',
                                        'state_id'=>'CustomerContractStatus',  
                                        'meeting_id'=>'CustomerMeeting',
                                        'financial_partner_id'=>'Partner',
                                        'team_id'=>'UserTeam',
                                        'telepro_id'=>'User',
                                        'sale_1_id'=>'User',
                                        'sale_2_id'=>'User',
                                        'manager_id'=>'User', 
                                        'assistant_id'=>'User',                                         
                                        'tax_id'=>'Tax',
                                        'install_state_id'=>'CustomerContractInstallStatus',  
                                        'time_state_id'=>'CustomerContractTimeStatus',  
                                        'polluter_id'=>'PartnerPolluterCompany',
                                        'opc_range_id'=>'CustomerContractRange',
                                        'opc_status_id'=>'CustomerContractOpcStatus', 
                                        'admin_status_id'=>'CustomerContractAdminStatus', 
                                        'partner_layer_id'=>'PartnerLayerCompany',
                                        'created_by_id'=>'User',  
                                         'callcenter_id'=>'Callcenter',
                                         'opened_at_range_id'=>'CustomerContractRange',
                                         'sav_at_range_id'=>'CustomerContractRange',
                                         'dates_opened_at_by'=>'User',
                                         'company_id'=>'CustomerContractCompany',
                                         'campaign_id'=>'CustomerMeetingCampaign',
                                        ); 
    
    protected static $fieldsNull=array('meeting_id',
                                       'financial_partner_id',
                                       'opc_status_id',
                                       'sav_at',
                                       'doc_at',
                                        'admin_status_id',
                                        'pre_meeting_at',
                                        'quoted_at',
                                        'dates_opened_at_by','dates_opened_at',
                                        'billing_at',
                                        'customer_id',
                                        'partner_layer_id',
                                        'opc_range_id',
                                        'time_state_id',
                                        'partner_layer_id',
                                        'state_id',
                                        'polluter_id',
                                        'install_state_id',
                                        'created_by_id',
                                     // 'tax_id','team_id',
                                    //   'telepro_id','sale_1_id','sale_2_id','manager_id', 
                                    //   'state_id','assistant_id',
                                       'payment_at','opc_at','opened_at','sent_at','apf_at','closed_at',
                                       'company_id'); // By default
    
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {          
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']); 
          
          if (isset($parameters['customer']) && isset($parameters['opened_at']) && isset($parameters['product']) && isset($parameters['total_price_with_taxe']))
             return $this->loadbyCustomerAndInAtAndProductAndAmount($parameters['customer'],(string)$parameters['opened_at'],$parameters['product'],(string)$parameters['total_price_with_taxe']); 
          if (isset($parameters['reference']))
             return $this->loadbyReference((string)$parameters['reference']); 
          
          return $this->add($parameters); 
      }   
      else
      {
         if ($parameters instanceof CustomerMeeting)
            return $this->loadByMeeting($parameters); 
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         
      }   
    }
    
    
     protected function loadByReference($reference)
    {         
         $this->set('reference',$reference);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('reference'=>$reference))
                ->setQuery("SELECT * FROM ".self::getTable()." WHERE reference='{reference}';")
                ->makeSiteSqlQuery($this->getSite());                           
         return $this->rowtoObject($db);
    }
    
    protected function loadbyCustomerAndInAtAndProductAndAmount($customer,$opened_at,$product,$total_price_with_taxe)
    {             
         $this->set('opened_at',$opened_at);
         $this->set('customer_id',$customer);
         $this->set('total_price_with_taxe',$total_price_with_taxe);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('customer_id'=>$customer->get('id'),
                    'opened_at'=>$opened_at,
                    'total_price_with_taxe'=>$total_price_with_taxe,
                    'product_id'=>$product->get('id')))
                ->setQuery("SELECT ".self::getFieldsAndKeyWithTable()." FROM ".self::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').                        
                           " WHERE opened_at='{opened_at}' AND ".CustomerContractProduct::getTableField('product_id')."={product_id}".
                                    " AND total_price_with_taxe='{total_price_with_taxe}' ".
                           ";")
                ->makeSiteSqlQuery($this->getSite());         
         $this->rowtoObject($db);        
    }   
    
    protected function loadByMeeting($meeting)
    {
         $this->site=$meeting->getSite();
         $this->set('meeting_id',$meeting);
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array('meeting_id'=>$meeting->get('id')))
                ->setQuery("SELECT * FROM ".self::getTable()." WHERE meeting_id={meeting_id};")
                ->makeSiteSqlQuery($this->getSite());                           
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
       $this->total_price_with_taxe=isset($this->total_price_with_taxe)?$this->total_price_with_taxe:0.0; 
       $this->total_price_without_taxe=isset($this->total_price_without_taxe)?$this->total_price_without_taxe:0.0;        
       $this->advance_payment=isset($this->advance_payment)?$this->advance_payment:0.0; 
       $this->status=isset($this->status)?$this->status:"ACTIVE";      
       $this->has_tva=isset($this->has_tva)?$this->has_tva:"YES";         
       $this->financial_partner_id=isset($this->financial_partner_id)?$this->financial_partner_id:0;     
     //  $this->state_id=isset($this->state_id)?$this->state_id:0;
       $this->team_id=isset($this->team_id)?$this->team_id:0;
       $this->telepro_id=isset($this->telepro_id)?$this->telepro_id:0;
       $this->sale_1_id=isset($this->sale_1_id)?$this->sale_1_id:0;
       $this->sale_2_id=isset($this->sale_2_id)?$this->sale_2_id:0;
       $this->manager_id=isset($this->manager_id)?$this->manager_id:0;
       $this->assistant_id=isset($this->assistant_id)?$this->assistant_id:0;
       $this->tax_id=isset($this->tax_id)?$this->tax_id:0;    
       $this->is_hold=isset($this->is_hold)?$this->is_hold:"NO";  
       $this->is_hold_admin=isset($this->is_hold_admin)?$this->is_hold_admin:"NO";  
       $this->is_hold_quote=isset($this->is_hold_quote)?$this->is_hold_quote:"NO";  
       $this->is_confirmed=isset($this->is_confirmed)?$this->is_confirmed:"NO"; 
       $this->is_billable=isset($this->is_billable)?$this->is_billable:"YES";
       $this->is_revivable=isset($this->is_revivable)?$this->is_revivable:"YES";
       $this->is_signed=isset($this->is_signed)?$this->is_signed:"NO";
       $this->dates_is_opened=isset($this->dates_is_opened)?$this->dates_is_opened:"NO";      
       $this->dates_is_valid=isset($this->dates_is_valid)?$this->dates_is_valid:"NO";
        $this->is_document=isset($this->is_document)?$this->is_document:"N";
        $this->is_photo=isset($this->is_photo)?$this->is_photo:"N";
        $this->is_quality=isset($this->is_quality)?$this->is_quality:"N";
        $this->is_works_hold=isset($this->is_works_hold)?$this->is_works_hold:"N";
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
       
  
    public function getCustomer()
    {      
        if ($this->_customer_id===null)
        {
            $this->_customer_id=new Customer($this->get('customer_id')?$this->get('customer_id'):null,$this->getSite());          
        }    
        return $this->_customer_id;
    }
    
    function hasStatus()
    {
        return (boolean)($this->get('state_id')!=null);
    }
    
    function getStatus()
    {
        if ($this->_state_id===null)
        {              
            $this->_state_id=new CustomerContractStatus($this->get('state_id'),$this->getSite());           
        }    
        return $this->_state_id;
    }
    
      function getOldStatus()
    {
        if ($this->_old_state_id===null)
        {                          
            $this->_old_state_id=new CustomerContractStatus($this->hasPropertyChanged('state_id')?$this->getPropertyChanged('state_id'):null,$this->getSite());           
        }    
        return $this->_old_state_id;
    }
    
      function getMeeting()
    {
        if ($this->_meeting_id===null)
        {              
            $this->_meeting_id=new CustomerMeeting($this->get('meeting_id'),$this->getSite());           
        }    
        return $this->_meeting_id;
    }
    
    function getTax()
    {
        if ($this->_tax_id===null)
        {              
            $this->_tax_id=new Tax($this->get('tax_id'),$this->getSite());           
        }    
        return $this->_tax_id;
    }
    
    
   
   function getContractProducts()
    {      
       if ($this->isNotLoaded())
       {    
           return new  CustomerContractProductCollection(null,$this->getSite());
       }
        if ($this->contract_products===null)
        {                                      
                $this->contract_products=new CustomerContractProductCollection(null,$this->getSite());
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id')))
                         ->setObjects(array('CustomerContractProduct','Product','ProductAction','Tax'))
                         ->setQuery("SELECT {fields} FROM ".CustomerContractProduct::getTable().
                                    " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('product_id').
                                    " LEFT JOIN ".Product::getOuterForJoin('action_id').
                                    " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('tva_id').
                                    " WHERE contract_id='{contract_id}';")
                         ->makeSiteSqlQuery($this->getSite());  
               if (!$db->getNumRows())
                  return array();               
               while ($items=$db->fetchObjects())
               {        
                   $item=$items->getCustomerContractProduct();
                   $item->set('product_id',$items->getProduct());
                   $item->set('tva_id',$items->hasTax()?$items->getTax():0);
                   $item->getProduct()->set('action_id',$items->hasProductAction()?$items->getProductAction():0);
                   $this->contract_products[]=$item;
                }                        
        }    
        return $this->contract_products;
    }
    
    function getActiveProducts()
    {
       if ($this->isNotLoaded())
           return array();
       
        if (!$this->active_contract_products)
        {                                
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id')))                        
                         ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".CustomerContractProduct::getTable().
                                    " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('product_id').
                                    " WHERE contract_id='{contract_id}'".
                                        " AND is_active='YES'".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());  
                if (!$db->getNumRows())
                  return array();
               $this->active_contract_products=array();
               while ($item=$db->fetchObject('Product'))
               {        
                   
                   $this->active_contract_products[]=$item;
                }                        
        }    
        return $this->active_contract_products;
    }
   
    function hasContractProducts()
    {
        $this->getContractProducts();
        return !empty($this->contract_products);
    }
    
    function setComments($user,$action="")
    {
       $settings=  CustomerContractSettings::load($this->getSite());
       // Change state   
       //$this->setBillableFromStatus($this->form['state_id']->getValue());              
       if ($this->hasPropertyChanged('state_id'))
       {         
           $old=new CustomerContractStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->getPropertyChanged('state_id')),$this->getSite());
           $new=new CustomerContractStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->get('state_id')),$this->getSite());
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',$old->get('value')." => ".$new->get('value').__(" by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();
           // History           
           $comment->setHistory($user->getGuardUser());  
           
           if ($user->hasCredential(array(array('superadmin','admin','contract_hold'))) && in_array($this->get('state_id'),$settings->getHoldStatuses()))
           {      
                $this->set('is_hold','YES');     
                $comment= new CustomerContractComment(null,$this->getSite());        
                $comment->set('comment',__("Contract has been hold per status by ").strtoupper((string)$user->getGuardUser()));       
                $comment->set('contract_id',$this);
                $comment->save();          
                $comment->setHistory($user->getGuardUser());  
           }            
       }                                 
       if ($this->hasPropertyChanged('opc_status_id') && $settings->get('comment_opc_status')=='YES')
       {         
           $old=new CustomerContractOpcStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->getPropertyChanged('opc_status_id')),$this->getSite());
           $new=new CustomerContractOpcStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->get('opc_status_id')),$this->getSite());
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Opc status {old} => {new} by {user}",array('old'=>$old->get('value'),'new'=>$new->get('value'), 'user'=>(string)$user->getGuardUser()->getUpperName())));           
           $comment->set('contract_id',$this);
           $comment->save();
           // History           
           $comment->setHistory($user->getGuardUser());                                                                         
       } 
       if ($this->hasPropertyChanged('install_status_id') && $settings->get('comment_install_status')=='YES')
       {         
           $old=new CustomerContractInstallStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->getPropertyChanged('install_status_id')),$this->getSite());
           $new=new CustomerContractInstallStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->get('install_status_id')),$this->getSite());
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Install status {old} => {new} by {user}",array('old'=>$old->get('value'),'new'=>$new->get('value'), 'user'=>(string)$user->getGuardUser()->getUpperName())));           
           $comment->set('contract_id',$this);
           $comment->save();
           // History           
           $comment->setHistory($user->getGuardUser());                                                                         
       } 
        if ($this->hasPropertyChanged('time_state_id') && $settings->get('comment_time_state')=='YES')
       {         
           $old=new CustomerContractTimeStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->getPropertyChanged('time_state_id')),$this->getSite());
           $new=new CustomerContractTimeStatusI18n(array("lang"=>$user->getLanguage(),"status_id"=>$this->get('time_state_id')),$this->getSite());
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Time status {old} => {new} by {user}",array('old'=>$old->get('value'),'new'=>$new->get('value'), 'user'=>(string)$user->getGuardUser()->getUpperName())));           
           $comment->set('contract_id',$this);
           $comment->save();
           // History           
           $comment->setHistory($user->getGuardUser());                                                                         
       } 
       if ($this->hasPropertyChanged('sale_1_id') && $settings->get('comment_sale1')=='YES')
       {
           $old=new User($this->getPropertyChanged('sale_1_id'),'admin',$this->getSite());
           if ($old->isNotLoaded())
               $old=__("Nothing");
           $new=new User($this->get('sale_1_id'),'admin',$this->getSite());
            if ($new->isNotLoaded())
               $new=__("Nothing");
           $comment= new CustomerContractComment(null,$this->getSite());        
           $message=__("Sale 1 : {old} => {new} by {user}",array('user'=>(string)$user->getGuardUser(),'old'=>(string)$old,'new'=>(string)$new)).__(" by ").strtoupper((string)$user->getGuardUser());
           $comment->set('comment',$message);          
           $comment->set('contract_id',$this);
           $comment->save();          
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($this->hasPropertyChanged('sale_2_id') && $settings->get('comment_sale2')=='YES')
       {
           $old=new User($this->getPropertyChanged('sale_2_id'),'admin',$this->getSite());
           if ($old->isNotLoaded())
               $old=__("Nothing");            
           $new=new User($this->get('sale_2_id'),'admin',$this->getSite());
           if ($new->isNotLoaded())
               $new=__("Nothing");
           $comment= new CustomerContractComment(null,$this->getSite());   
           $message=__("Sale 2 : {old} => {new} by {user}",array('user'=>(string)$user->getGuardUser(),'old'=>(string)$old,'new'=>(string)$new)).__(" by ").strtoupper((string)$user->getGuardUser());
           $comment->set('comment',$message);           
           $comment->set('contract_id',$this);
           $comment->save();          
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='create' && $settings->get('comment_creation')=='YES')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract created by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       elseif ($action=='delete' && $settings->get('comment_delete')=='YES')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been deleted by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='recycle')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been recycled by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($this->hasPropertyChanged('is_confirmed'))
       {
           $old=($this->getPropertyChanged('is_confirmed')=='YES')?"Confirmed":"Not confirmed";
           $new=($this->get('is_confirmed')=='YES')?"Confirmed":"Not confirmed";
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__($old)." => ".__($new).__(" by ").strtoupper((string)$user->getGuardUser()));                      
           $comment->set('contract_id',$this);
        //   $comment->set('type','SYSTEM');
           $comment->save();          
           // History
           $comment->setHistory($user->getGuardUser()); 
       }
        if ($action=='hold')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been hold by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='unhold')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been unhold by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }    
       if ($action=='cancel')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been cancelled by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='uncancel')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been uncancelled by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }    
       if ($action=='blowing')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been blowing by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='unblowing')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been unblowing by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }   
       if ($action=='placement')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been placed by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='unplacement')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been unplaced by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }   
       if ($action=='hold_admin')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been hold admin by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='unhold_admin')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been unhold admin by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }   
        if ($action=='transfer')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has transferred by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       } 
       if ($action=='hold_quote')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been quotation hold by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($action=='unhold_quote')
       {
           $comment= new CustomerContractComment(null,$this->getSite());        
           $comment->set('comment',__("Contract has been quotation unhold by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('contract_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }  
    }
        
    function productsToContract()
    {
        $collection= new CustomerContractProductCollection(null,$this->getSite());
        foreach ($this->getMeeting()->getMeetingProducts() as $meeting_product)
        {                    
            $contract_product=new CustomerContractProduct(null,$this->getSite());
            $contract_product->set('contract_id',$this);    
            foreach (array('product_id','details') as $name)
                $contract_product->set($name,$meeting_product->get($name));    
            $collection[]=$contract_product;
        } 
        $collection->save();
    }
    
    
    function toContract($user)
    {        
       
        if ($this->getMeeting()->isNotLoaded())
            return false;        
        if ($this->isLoaded())
            return true;        
        $this->set('customer_id',$this->getMeeting()->get('customer_id'));
        $this->set('opened_at',$this->getMeeting()->get('in_at')); // Date opened   
        $this->set('opc_at',$this->getMeeting()->get('opc_at')); // Date opened   
        $this->set('total_price_without_taxe',$this->getMeeting()->get('turnover')); // Date opened     
        $this->set('remarks',$this->getMeeting()->get('remarks')); // Date opened  
        $this->set('opc_at',$this->getMeeting()->get('opc_at'));       
        $this->set('opc_range_id',$this->getMeeting()->get('opc_range_id'));      
        $this->set('created_by_id',$user->getGuardUser());      
        $this->set('opened_at_range_id',$this->getMeeting()->get('in_at_range_id'));
        if ($user->hasCredential(array(array('meeting_to_contract_sav_at_to_opc_at'))))
        {
            $this->set('sav_at',$this->getMeeting()->get('opc_at'));
            $this->set('sav_at_range_id',$this->getMeeting()->get('opc_range_id'));
        }
        if ($user->hasCredential(array(array('meeting_to_contract_opc_at_range_to_time'))))
        {
            $this->setOpcAtTimeFromRange();
        }
        if ($user->hasCredential(array(array('meeting_to_contract_opc_at_to_premeeting_at_billing_at_quoted_at'))))
        {
            $this->set('quoted_at',$this->getMeeting()->get('opc_at'));
            $this->set('billing_at',$this->getMeeting()->get('opc_at'));
            $this->set('pre_meeting_at',$this->getMeeting()->get('opc_at'));
            $this->set('opened_at',$this->getMeeting()->get('opc_at'));
        }
        // Affect meeting telepro, sale1 and sale2 to contract        
        foreach (array('telepro_id'=>'telepro_id','sale_1_id'=>'sales_id','sale_2_id'=>'sale2_id','assistant_id'=>'assistant_id',                       
                      ) as $contract_user=>$meeting_user)
        {        
            $this->set($contract_user,$this->getMeeting()->get($meeting_user));
        }                   
        $this->set('team_id',UserTeamUtils::getTeamFromUser($this->getTelepro())); 
        $this->set('polluter_id',$this->getMeeting()->get('polluter_id'));
        $this->set('company_id',$this->getMeeting()->get('company_id'));
        $this->set('campaign_id',$this->getMeeting()->get('campaign_id'));
        $this->set('partner_layer_id',$this->getMeeting()->get('partner_layer_id')?$this->getMeeting()->get('partner_layer_id'):null);     
        mfcontext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.change',array('action'=>'to_contract_load')));        
        $this->save();  
        mfcontext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.to_contract'));
        $this->setComments($user,'transfer');
        // Copy products from meeting
        $this->productsToContract();
        $this->createContributors();
    }
    
    function getTeam()
    {
         if ($this->_team_id===null)
        {              
            $this->_team_id=new UserTeam($this->get('team_id'),$this->getSite());           
        }    
        return $this->_team_id;
    }
    
    function hasTeam()
    {
        return (boolean)$this->get('team_id');
    }
    
    function hasTelepro()
    {
        return (boolean)$this->get('telepro_id');
    }
    
    function getTelepro()
    {
         if ($this->_telepro_id===null)
        {                      
            $this->_telepro_id=new User($this->get('telepro_id'),'admin',$this->getSite());           
        }    
        return $this->_telepro_id;
    }
    
    function hasSale1()
    {
        return (boolean)$this->get('sale_1_id');
    }
    
    function getSale1()
    {
         if ($this->_sale_1_id===null)
        {                         
            $this->_sale_1_id=new User($this->get('sale_1_id'),'admin',$this->getSite());           
        }    
        return $this->_sale_1_id; 
    }
    
     function hasSale2()
    {
        return (boolean)$this->get('sale_2_id');
    }
    
    function getSale2()
    {
           if ($this->_sale_2_id===null)
        {              
            $this->_sale_2_id=new User($this->get('sale_2_id'),'admin',$this->getSite());           
        }    
        return $this->_sale_2_id; 
    }
    
    function hasAssistant()
    {
        return (boolean)$this->get('assistant_id');
    }
    
    function getAssistant()
    {
           if ($this->_assistant_id===null)
        {              
            $this->_assistant_id=new User($this->get('assistant_id'),'admin',$this->getSite());           
        }    
        return $this->_assistant_id; 
    }
    
    function getPartner()
    {        
        if ($this->_financial_partner_id===null)
        {              
            $this->_financial_partner_id=new Partner($this->get('financial_partner_id'),$this->getSite());           
        }    
        return $this->_financial_partner_id; 
    }
    
    function hasPartner()
    {
        return (boolean)$this->get('financial_partner_id');
    }
    
    function getManager()
    {
        if ($this->_manager_id===null)
        {              
            $this->_manager_id=new User($this->get('manager_id'),'admin',$this->getSite());           
        }    
        return $this->_manager_id; 
    }    
    
    function hasMeeting()
    {
        return (boolean)$this->get('meeting_id');
    }
    
    function hasManager()
    {
        return (boolean)$this->get('manager_id');
    }
    
    function setContributors($contributors,$user)
    {
        foreach ($contributors as $type=>$contribution)
        {                              
            $this->set($type.'_id',$contribution['user_id']);                           
        } 
        if ($user->hasCredential(array(array('contract_new_telepro_as_user'))))
        {
            $this->set('telepro_id',$user->getGuardUser());
        }
        elseif ($user->hasCredential(array(array('contract_new_assistant_as_user'))))
        {
           $this->set('assistant_id',$user->getGuardUser()); 
        } 
        return $this;
    }
    
    function createContributions($attributions,$user)
    {             
         $settings=CustomerContractSettings::load($this->getSite());
         $collection=new CustomerContractContributorCollection(null,$this->getSite());
         foreach (array('telepro','sale_1','sale_2','manager','assistant') as $type)
         {
            $item=new CustomerContractContributor(null,$this->getSite());
            $item->set('contract_id',$this);
            $item->set('type',$type); 
            // Pre affect contributor from meeting           
            if ($user->hasCredential(array(array('contract_new_telepro_as_user'))))
            {
                $this->set('user_id',$user->getGuardUser());
            }
            elseif ($user->hasCredential(array(array('contract_new_assistant_as_user'))))
            {
               $this->set('user_id',$user->getGuardUser()); 
            }
            else 
                $item->set('user_id',$attributions['contributors'][$type]['user_id']);                                                           
            $item->set('attribution_id',$attributions['contributors'][$type]['attribution_id']?$attributions['contributors'][$type]['attribution_id']:$settings->get('default_attribution_id'));
            $collection[]=$item;
         }    
         $collection->save();
    }
    
    function createContributors()
    {          
        if ($this->isNotLoaded())
            return $this;
        $contributors=array('team','telepro','sale_1','sale_2','manager','assistant');
        //array('telepro_id'=>'telepro_id','sale_1_id'=>'sales_id','sale_2_id'=>'sale2_id')
        // Test is already created
        $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id')))
                         ->setObjects(array('CustomerContractContributor'))
                         ->setQuery("SELECT type FROM ".CustomerContractContributor::getTable().                                    
                                    " WHERE contract_id='{contract_id}';")
                         ->makeSiteSqlQuery($this->getSite());  
        if ($db->getNumRows())
        {
            while ($row=$db->fetchArray())
            { 
                if ($key=  array_search($row['type'], $contributors))
                    unset($contributors[$key]);    
            }
        } 
        if (empty($contributors))
            return $this;
        $settings=CustomerContractSettings::load($this->getSite());
        $collection=new CustomerContractContributorCollection(null,$this->getSite());
        foreach ($contributors as $type)
        {
            $item=new CustomerContractContributor(null,$this->getSite());
            $item->set('contract_id',$this);
            $item->set('type',$type); 
            // Pre affect contributor from meeting
            if ($type=='telepro')
                $item->set('user_id',$this->get('telepro_id')?$this->get('telepro_id'):null);
            elseif ($type=='sale_1')
                $item->set('user_id',$this->get('sale_1_id')?$this->get('sale_1_id'):null);
            elseif ($type=='sale_2')
                $item->set('user_id',$this->get('sale_2_id')?$this->get('sale_2_id'):null);
            elseif ($type=='manager')
                $item->set('user_id',$this->get('manager_id'));    
            elseif ($type=='assistant')
                $item->set('user_id',$this->get('assistant_id')?$this->get('assistant_id'):null);    
             elseif ($type=='team')
                $item->set('team_id',$this->get('team_id')); 
            $item->set('attribution_id',$settings->get('default_attribution_id'));
            $collection[]=$item;
        }           
        $collection->save();
    }
            
    function hasContributors()
    {
         if ($this->isNotLoaded())
             return false;
          $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id')))                         
                         ->setQuery("SELECT count(id) FROM ".CustomerContractContributor::getTable().                                   
                                    " WHERE contract_id='{contract_id}' ".                                    
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                  
         $row=$db->fetchRow();
         return $row[0];
    }
    
    function getContributors()
    {
        if ($this->isNotLoaded())
            return array();
        if ($this->contributors)
            return $this->contributors;
        $this->contributors=array();
        $settings=CustomerContractSettings::load($this->getSite());  
        $default=$settings->getDefaultUserAttribution();
      //  echo "<pre>"; var_dump($settings->getDefaultUserAttribution()); echo "</pre>"; 
         $lang=  mfcontext::getInstance()->getUser()->getCountry();
         $condition="";
         $contributors=array('telepro','sale_1','sale_2','manager');
         if ($settings->hasAssistant())
             $contributors[]='assistant';
         else       
             $condition=" AND type!='assistant'";                  
         $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id'),'lang'=>$lang))
                         ->setObjects(array('CustomerContractContributor',
                                            'UserAttributionI18n',
                                            'UserAttribution','User'))
                         ->setQuery("SELECT {fields} FROM ".CustomerContractContributor::getTable().
                                    " LEFT JOIN ".CustomerContractContributor::getOuterForJoin('attribution_id').
                                    " LEFT JOIN ".CustomerContractContributor::getOuterForJoin('user_id').
                                    " LEFT JOIN ".UserAttributionI18n::getInnerForJoin('attribution_id')." AND lang='{lang}' ".
                                    " WHERE contract_id='{contract_id}' ".$condition.
                                    " ORDER BY ".CustomerContractContributor::getTableField('id').
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());  
                if (!$db->getNumRows())
                  return $this->contributors;
                while ($item=$db->fetchObjects())
               {                          
                   if ($item->hasUserAttribution())
                   {    
                     //  $item->getCustomerContractContributor()->getUserAttribution()->set('user_attribution_i18n',$item->getUserAttributionI18n());
                       $item->getCustomerContractContributor()->set('attribution_id',$item->getUserAttribution());                      
                   }
                   else 
                   {                       
                       $item->getCustomerContractContributor()->set('attribution_id',$default);                                          
                   }                       
                   $item->getCustomerContractContributor()->set('user_id',$item->hasUser()?$item->getUser():null);                   
                   $this->contributors[$item->getCustomerContractContributor()->get('type')]=$item->getCustomerContractContributor();                 
                }  
                foreach ($contributors as $type)
                {
                    if (isset($this->contributors[$type]))
                        continue;
                    $item=new CustomerContractContributor(null,$this->getSite());
                    $item->add(array('user_id'=>null,'attribution_id'=>$default,'contract_id'=>$this,'type'=>$type));
                    $item->save();
                    $this->contributors[$type]=$item;
                }        
            //    var_dump($this->contributors);
             return $this->contributors;
    }
    
    
    function getAllContributors()
    {
        if ($this->isNotLoaded())
            return array();
        if ($this->contributors)
            return $this->contributors;
        $this->contributors=array();
        $settings=CustomerContractSettings::load($this->getSite());  
        $default=$settings->getDefaultUserAttribution();
        //var_dump($settings->getDefaultUserAttribution());
         $lang=  mfcontext::getInstance()->getUser()->getCountry();
         $condition="";
         $contributors=array('team','telepro','sale_1','sale_2','manager');
         if ($settings->hasAssistant())
             $contributors[]='assistant';
         else       
             $condition=" AND type!='assistant'";                  
         $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id'),'lang'=>$lang))
                         ->setObjects(array('CustomerContractContributor',
                                            'UserAttributionI18n',
                                            'UserTeam',
                                            'UserAttribution','User'))
                         ->setQuery("SELECT {fields} FROM ".CustomerContractContributor::getTable().
                                    " LEFT JOIN ".CustomerContractContributor::getOuterForJoin('attribution_id').
                                    " LEFT JOIN ".CustomerContractContributor::getOuterForJoin('user_id').
                                    " LEFT JOIN ".CustomerContractContributor::getOuterForJoin('team_id').
                                    " LEFT JOIN ".UserAttributionI18n::getInnerForJoin('attribution_id')." AND lang='{lang}' ".
                                    " WHERE contract_id='{contract_id}' ".$condition.
                                    " ORDER BY ".CustomerContractContributor::getTableField('id').
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());  
                if (!$db->getNumRows())
                  return $this->contributors;
                while ($item=$db->fetchObjects())
               {                          
                   if ($item->hasUserAttribution())
                   {    
                     //  $item->getCustomerContractContributor()->getUserAttribution()->set('user_attribution_i18n',$item->getUserAttributionI18n());
                       $item->getCustomerContractContributor()->set('attribution_id',$item->getUserAttribution());                      
                   }
                   else 
                   {                       
                       $item->getCustomerContractContributor()->set('attribution_id',$default);                                          
                   }                     
                   $item->getCustomerContractContributor()->set('user_id',$item->hasUser()?$item->getUser():null);                   
                   $item->getCustomerContractContributor()->set('team_id',$item->hasUserTeam()?$item->getUserTeam():false);                   
                   $this->contributors[$item->getCustomerContractContributor()->get('type')]=$item->getCustomerContractContributor();                 
                }  
                foreach ($contributors as $type)
                {
                    if (isset($this->contributors[$type]))
                        continue;
                    if ($type=='team')
                    {
                         $item=new CustomerContractContributor(null,$this->getSite());
                        $item->add(array('team_id'=>null,'attribution_id'=>$default,'contract_id'=>$this,'type'=>$type));
                        $item->save();
                    }    
                    else
                    {
                        $item=new CustomerContractContributor(null,$this->getSite());
                        $item->add(array('user_id'=>null,'attribution_id'=>$default,'contract_id'=>$this,'type'=>$type));
                        $item->save();
                    }
                    $this->contributors[$type]=$item;
                }        
            //    var_dump($this->contributors);
             return $this->contributors;
    }
    
  /*  function getContributor($function)
    {
        $this->getContributors();
        return isset($this->contributors[$function])?$this->contributors[$function]:null;
    }
    
    function hasContributor($function)
    {
         return isset($this->contributors[$function]);
    }*/
    
     function getDate($format="Y-m-d")
    {
        return date($format,strtotime($this->get('sent_at')));
    }
    
     function getTime($format="Y-m-d h:i:s")
    {
        return date($format,strtotime($this->get('sent_at')));
    }
    
    
    function getHour()
    {       
        return date("H",strtotime($this->get('sent_at')));
    }
    
     function getMinute()
    {       
        return date("i",strtotime($this->get('sent_at')));
    }
    
    function getDayTime()
    {
       // return new Day($this->get('in_at'));
        return new Day($this->getDate()." ".$this->getHour().":00"); // Remove 
    }
    
    function getDateI18nInWord($format="d/m/Y")
    {
        $day=$this->getDayTime();
        return  __($day->getDayName())." ".$day->getDate($format);
    }
    
    
    function getOpenedAtDate($format="Y-m-d")
    {
        return date($format,strtotime($this->get('opened_at')));
    }
    
     function getOpenedAtTime($format="Y-m-d h:i:s")
    {
        return date($format,strtotime($this->get('opened_at')));
    }
    
    function getOpenedAtHour()
    {       
        return date("H",strtotime($this->get('opened_at')));
    }
    
     function getOpenedAtMinute()
    {       
        return date("i",strtotime($this->get('opened_at')));
    }
    
    function getOpenedAtDayTime()
    {      
        return new Day($this->getOpenedAtDate()." ".$this->getOpenedAtHour().":00"); // Remove 
    }
    
    function getOpenedAtDateI18nInWord($format="d/m/Y")
    {
        $day=$this->getOpenedAtDayTime();
        return  __($day->getDayName())." ".$day->getDate($format);
    }
    
    /*
       customer_contract_action_assistant_view
       customer_contract_action_creator_view
       customer_contract_action_telepro_view
       customer_contract_action_all_view
     */
    function isUserAuthorized($user,$action="view")
    {
         if (!$user->hasCredential([['superadmin','customer_contract_action_'.$action,
                                    'customer_contract_action_assistant_'.$action,
                                    'customer_contract_action_creator_'.$action,
                                    'customer_contract_action_telepro_'.$action,
                                    'customer_contract_action_all_'.$action,
                                    'customer_contract_action_sale_'.$action,
                                    'customer_contract_action_telepro_manager_'.$action
                                   ]]))
            return false;
        if ($user->hasCredential([['superadmin','customer_contract_action_all_'.$action]]))
            return true;  
	$credential=false;			
	if ($user->hasCredential([['customer_contract_action_creator_'.$action]]))
            $credential |= $user->getGuardUser()->get('id')==$this->get('created_by_id');			
        if ($user->hasCredential([['customer_contract_action_assistant_'.$action]]))
            $credential |= $user->getGuardUser()->get('id')==$this->get('assistant_id');
        if ($user->hasCredential([['customer_contract_action_telepro_'.$action]]))
            $credential |= $user->getGuardUser()->get('id')==$this->get('telepro_id');
        if ($user->hasCredential([['customer_contract_action_sale_'.$action]]))
            $credential |= $user->getGuardUser()->get('id')==$this->get('sale_1_id') || $user->getGuardUser()->get('id')==$this->get('sale_2_id');
	if ($user->hasCredential([['customer_contract_action_creator_'.$action]]))
            $credential |= $user->getGuardUser()->get('id')==$this->get('created_by_id');     
        if ($user->hasCredential([['customer_contract_action_telepro_manager_'.$action]]))        
             $credential |=$user->getGuardUser()->getTeamsAsManager()->getKeys()->in($this->get('team_id'));                         
        return  $credential;     
          
      /*  if ($user->hasGroups('telepro') && $user->getGuardUser()->get('id')!=$this->get('telepro_id'))
                return false;
        if ($user->hasGroups('commercial') && 
                ($user->getGuardUser()->get('id')!=$this->get('sale_1_id') &&
                 $user->getGuardUser()->get('id')!=$this->get('sale_2_id')))        
            return false;*/
       // return true;
    }  
    
    function getPriceWithoutTax()
    {        
        if ($this->get('total_price_without_taxe')==0 && $this->get('total_price_with_taxe')!=0)
        {
            $tax_rate=$this->getTax()->get('rate');           
            $this->set('total_price_without_taxe',$this->get('total_price_with_taxe') / (1 + $tax_rate ));            
        }    
        return $this->get('total_price_without_taxe');
    }
    
    function getPriceWithTax()
    {
        if ($this->get('total_price_with_taxe')==0 && $this->get('total_price_without_taxe')!=0 )
        {
            $tax_rate=$this->getTax()->get('rate');
            $this->set('total_price_with_taxe',$this->get('total_price_without_taxe') * (1 + $tax_rate ));               
        }   
        return $this->get('total_price_with_taxe');
    }      
    
    function getTaxAmount()
    {
        if (!$this->get('tax_amount'))
        {    
            $tax_rate=$this->getTax()->get('rate');   
            $this->set('tax_amount',$tax_rate * $this->get('total_price_without_taxe'));
        }   
        return $this->get('tax_amount');
    }
    
  /*  function ($fields = null) {
        return array_merge(parent::toArray($fields),array(
            'created_at'=>format_date($this->get('created_at','a')),
            'opened_at'=>format_date($this->get('opened_at','a'))
            ));
    }*/
    
     function getFormattedTaxRate()
     {
         return format_pourcentage($this->getTax()->get('rate'));
     }
     
     function hasSales()
     {
         return $this->hasSale1() || $this->hasSale2();
     }
     
     function hasClosedAt()
     {
         return (boolean)$this->get('closed_at');
     }
     
     function hasTVA()
     {
         return $this->get('has_tva')=='YES';
     }
     
     function getFormattedAdvance()
     {
         return format_number($this->get('advance_payment'),'#.00');
     }
     
     function hasTotalSaleWithTax()
     {
         return (boolean)$this->total_sale_with_tax;
     }              
     
     function getFormattedTotalSaleWithTax()
     {
        return format_currency($this->total_sale_with_tax,'EUR');
     } 
     
     function getFormattedTotalPriceWithTax()
     {         
        return format_currency($this->total_price_with_taxe,$this->getProductSettings()->get('default_currency','EUR'));
     } 
     
     function getFormattedTotalPriceWithoutTax()
     {         
        return format_currency($this->total_price_without_taxe,$this->getProductSettings()->get('default_currency','EUR'));
     } 
     
     function hasTotalPaidWithTax()
     {
         return (boolean)$this->total_paid_with_tax;
     }
     
     function getFormattedTotalPaidWithTax()
     {
        return format_currency($this->total_paid_with_tax,'EUR');
     } 
     
     function hasTotalUnPaidWithTax()
     {
         return (boolean)$this->total_unpaid_with_tax;
     }
     
      function getFormattedTotalUnPaidWithTax()
     {
        return format_currency($this->total_unpaid_with_tax,'EUR');
     }           
         
     function getStatusI18n()
     {
         return __($this->get('status'),array(),'messages','customers_contracts');
     }
     
     function getOpcAtDate()
     {
         return new Day($this->get('opc_at'));
     }          
     
     function getOpcAtNextDay()
     {
         if ($this->get('opc_at'))
             return (string)$this->getOpcAtDate()->getDayAdd(1);
         return "";
     }
     
     function hasOpcAt()
     {
         return (boolean)$this->get('opc_at');
     }
     
      function getOpcAt()
      {
          return new DayTime($this->get('opc_at'));
      }
      
      function getProductSettings()
    {
        if ($this->product_settings===null)
        {
            $this->product_settings=ProductSettings::load($this->getSite());
        }   
        return $this->product_settings;
    }
    
    
    function getFormattedOpenedAt()
    {
       return new DateFormatter($this->get('opened_at'))    ;
    }
    
    function isValidDateOpcAt()
    {
        if (!$this->get('opc_at'))
            return ;
        if (strtotime($this->get('opc_at')) > strtotime($this->get('opened_at')))
                return true;
        return false;
    }
    
    function getAuthorizedOpcDate()
    {        
        return DateFormatter::getInstance($this->get('opened_at'))->getDayAdd(CustomerContractSettings::load()->get('number_of_day_for_opc',1));
    }
        
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new CustomerContractFormatter($this);
        }   
        return $this->formatter;
    }
    
    function hasPolluter()
    {
        return (boolean)$this->get('polluter_id');
    }
    
    function getPolluter()
    {
        if ($this->_polluter_id===null)
        {
            $this->_polluter_id= new PartnerPolluterCompany($this->get('polluter_id'),$this->getSite());
        }    
        return $this->_polluter_id;
    }
    
    function isOwner()
    {  
        $user=mfContext::getInstance()->getUser();        
        if ($user->getGuardUser()->get('id')==$this->get('assistant_id'))
            return true;
        if ($user->getGuardUser()->get('id')==$this->get('telepro_id'))
            return true;
        if ($user->getGuardUser()->get('id')==$this->get('sale_1_id'))
            return true;
         if ($user->getGuardUser()->get('id')==$this->get('sale_2_id'))
            return true;        
        return false;
    }
    
    
    
    
    function isAuthorized()
    {            
        $user=mfContext::getInstance()->getUser();
        if ($user->hasCredential(array(array('superadmin','admin','contract_owner'))) || !$user->hasCredential(array(array('contract_list_owner'))))
        {                 
            return true;
        } 
        if ($this->isOwner())
        {           
            return true;
        }         
        if ($user->hasCredential(array(array('contract_list_owner_free_assistant'))) && !$this->hasAssistant())
        {           
             return true;
        }     
         if ($user->hasCredential(array(array('contract_list_owner_free_telepro'))) && !$this->hasTelepro())
           {            
             return true;
        } 
          if ($user->hasCredential(array(array('contract_list_owner_free_sale1'))) && !$this->hasSale())
            {         
             return true;
        }      
           if ($user->hasCredential(array(array('contract_list_owner_free_sale2'))) && !$this->hasSale2())
          {          
             return true;
        } 
        return false;
    }
    
    protected function updateTeamFromTelepro()
    {        
        if ($this->hasTelepro())
        {   
            $this->set('team_id',UserTeamUtils::getTeamFromUser($this->getTelepro()));           
        }   
        return $this;
    }
    
    
    function save()
    {
        if ($this->hasPropertyChanged('telepro_id') || $this->isNotLoaded())
        {           
            $this->updateTeamFromTelepro();
        }       
        return parent::save();
    }
    
    function getInstallStatus()
    {
        if ($this->_install_state_id===null)
        {              
            $this->_install_state_id=new CustomerContractInstallStatus($this->get('install_state_id'),$this->getSite());           
        }    
        return $this->_install_state_id;
    }
    
     function hasInstallStatus()
    {
        return (boolean)$this->get('install_state_id');
    }
    
     function getTimeStatus()
    {
        if ($this->_time_state_id===null)
        {              
            $this->_time_state_id=new CustomerContractTimeStatus($this->get('time_state_id'),$this->getSite());           
        }    
        return $this->_time_state_id;
    }
    
     function hasTimeStatus()
    {
        return (boolean)$this->get('time_state_id');
    }
    
    function createDefaultProducts()
    {
         $products_by_default=ProductSettings::load($this->getSite())->getDefaultProductsById();
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$this->get('id')))                
                ->setQuery("SELECT ".CustomerContract::getTableField('id')." FROM ".CustomerContract::getTable(). 
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').
                           " WHERE ".CustomerContract::getTableField('id')."='{contract_id}'".  
                                    " AND ".CustomerContractProduct::getTableField('id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($this->getSite());
           //     echo $db->getQuery();
        if ($db->getNumRows())
        {
            $collection=new CustomerContractProductCollection(null,$this->getSite());
            while ($row=$db->fetchArray())
            {                                                   
                foreach ($products_by_default as $product_id)
                {
                    
                    $item=new CustomerContractProduct(null,$this->getSite());
                    $item->add(array('product_id'=>$product_id,'contract_id'=>$row['id']));
                    $collection[]=$item;
                }  
            } 
            $collection->save();
        }     
        
        // add non existing products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$this->get('id')))                
                ->setQuery("SELECT ".CustomerContract::getTableField('id').",".
                                 " GROUP_CONCAT(". CustomerContractProduct::getTableField('product_id')." SEPARATOR '|') as products".
                           " FROM ".CustomerContract::getTable(). 
                           " INNER JOIN ".CustomerContractProduct::getInnerForJoin('contract_id').
                           " WHERE ".CustomerContract::getTableField('id')."='{contract_id}'".   
                           " GROUP BY ".CustomerContract::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
         //   echo $db->getQuery();
        if (!$db->getNumRows())
            return ;   
        $collection=new CustomerContractProductCollection(null,$this->getSite());        
        while ($row=$db->fetchArray())
        {     
            $products= explode("|", $row['products']);                
            foreach ($products_by_default as $product_id)
            {
               if (in_array($product_id,$products))
                   continue;               
                $item=new CustomerContractProduct(null,$this->getSite());
                $item->add(array('product_id'=>$product_id,'contract_id'=>$row['id']));
                $collection[]=$item;
            }   
        } 
        $collection->save();
        
         // Update status active
      /*  $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('contract_id'=>$this->get('id')))                
                ->setQuery("UPDATE ".CustomerContractProduct::getTable()." SET status='ACTIVE'".
                           " WHERE ".CustomerContractProduct::getTableField('contract_id')."='{contract_id}'".                                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());    */
    }
    
    function hasPreviousStatus()
    {
        return (boolean)$this->getPreviousStatus();
    }
    
    function getPreviousStatus()
    {
       if ($this->previous_status_id===null)
       {
           if ($this->hasPropertyChanged('state_id'))
           {
               $this->previous_status_id=new CustomerContractStatus($this->getPropertyChanged('state_id'),$this->getSite());
           }    
           else
           { 
               $this->previous_status_id=false;
           }    
       }    
       return $this->previous_status_id;
    }
    
     function isConfirmed()
   {
       return ($this->get('is_confirmed')=='YES');
   } 
   
    function setConfirmed($user)
    {        
        $this->set('is_confirmed','YES');  
        if ($user->hasCredential(array(array('superadmin','contract_update_status_if_confirmed'))) && $this->getSettings()->hasConfirmedStatus())
           $this->set('state_id',$this->getSettings()->get('status_if_confirmed_id'));
        return $this;
    }
    
    function setUnconfirmed($user)
    {
          $this->set('is_confirmed','NO'); 
          if ($user->hasCredential(array(array('superadmin','contract_update_status_if_unconfirmed'))) && $this->getSettings()->hasUnConfirmedStatus())
                $this->set('state_id',$this->getSettings()->get('status_if_unconfirmed_id'));
          return $this;
    }
    
    function getHoldI18n()
    {
        return __($this->get('is_hold')); //,array(),'messages','customers_contracts');
    }
    
    function isHold()
    {
        return $this->get('is_hold')=='YES';
    }
    
    function setHold()
    {
        $this->set('is_hold','YES');
        return $this;
    }
    
    function setUnhold()
    {
        $this->set('is_hold','NO');
        return $this;
    }
    
    function hasSavAtRange()
    {
        return (boolean)$this->get('sav_at_range_id');
    }
    
    function getSavAtRange()
    {
       return $this->_sav_at_range_id=$this->_sav_at_range_id===null?$this->_sav_at_range_id=new CustomerContractRange($this->get('sav_at_range_id'),$this->getSite()):$this->_sav_at_range_id;
    }
    
    function hasOpcRange()
    {
        return (boolean)$this->get('opc_range_id');
    }
    
    function getOpcRange()
    {
       return $this->_opc_range_id=$this->_opc_range_id===null?$this->_opc_range_id=new CustomerContractRange($this->get('opc_range_id'),$this->getSite()):$this->_opc_range_id;
    }
    
    function hasOpenedAt()
    {
        return (boolean)$this->get('opened_at');
    }
    
    function hasOpenedAtRange()
    {
        return (boolean)$this->get('opened_at_range_id');
    }
    
    function getOpenedAtRange()
    {
       return $this->_opened_at_range_id=$this->_opened_at_range_id===null?$this->_opened_at_range_id=new CustomerContractRange($this->get('opened_at_range_id'),$this->getSite()):$this->_opened_at_range_id;
    }
    
    
    function setCloseAtFromOpcAt()
    {
        $this->set('closed_at',$this->getOpcAtDate()->getDate());
        return $this->save();
    }
    
       function getOpcAtDayTime()
    {     
        return new Day((string)$this->getOpcAtDate()->getDate()." 00:00"); 
    }
    
       function getSavAtDayTime()
    {     
        return new Day((string)$this->getSavAtDate()->getDate()." 00:00"); 
    }
    
    
    function getSettings()
    {
        return CustomerCOntractSettings::load($this->getSite());
    }
   
    
    function isCancelable()
    {
       return $this->getSettings()->hasCancelStatus() && $this->getSettings()->get('status_for_cancel_id')!=$this->get('state_id');
    }
    
    function isUnCancelable()
    {
       return $this->getSettings()->hasUnCancelStatus() && $this->getSettings()->get('status_for_uncancel_id')!=$this->get('state_id');
    }
    
    function isCancel()
    {
       return $this->getSettings()->get('status_for_cancel_id')==$this->get('state_id');
    }
    
     function isUnCancel()
    {
       return $this->getSettings()->get('status_for_uncancel_id')==$this->get('state_id');
    }
    
     function setCancelled($user)
    {
          if (!$this->isCancelable())
              return $this;         
          $this->set('state_id',$this->getSettings()->get('status_for_cancel_id'));
           if ($user->hasCredential(array(array('contract_cancelled_remove_opc_at'))))
          {
              $this->set('opc_at',null);
              $this->set('opc_range_id',0);
          }                    
          return $this;
    }
    
     function setUnCancelled($user)
    {
          if (!$this->isUnCancelable())
              return $this;         
          $this->set('state_id',$this->getSettings()->get('status_for_uncancel_id'));
          if ($user->hasCredential(array(array('contract_uncancelled_remove_opc_at'))))
          {
              $this->set('opc_at',null);
              $this->set('opc_range_id',0);
          }    
          return $this;
    }
    
    function hasOpcStatus()
    {
        return (boolean)$this->get('opc_status_id');
    }
    
    function getOpcStatus()
    {
        if ($this->_opc_status_id===null)
        {              
            $this->_opc_status_id=new CustomerContractOpcStatus($this->get('opc_status_id'),$this->getSite());           
        }    
        return $this->_opc_status_id;
    }
    
    /* ====================================== BLOWING ============================================== */ 
     function isBlowable()
    {
       return $this->getSettings()->hasBlowingStatus() && $this->getSettings()->get('status_for_blowing_id')!=$this->get('state_id');
    }
    
    function isUnBlowable()
    {
       return $this->getSettings()->hasUnBlowingStatus() && $this->getSettings()->get('status_for_unblowing_id')!=$this->get('state_id');
    }
    
    function isBlowing()
    {
       return $this->getSettings()->get('status_for_blowing_id')==$this->get('state_id');
    }
    
     function isUnBlowing()
    {
       return $this->getSettings()->get('status_for_unblowing_id')==$this->get('state_id');
    }
    
     function setBlowing($user)
    {
          if (!$this->isBlowable())
              return $this;         
          $this->set('state_id',$this->getSettings()->get('status_for_blowing_id'));                            
          return $this;
    }
    
     function setUnBlowing($user)
    {
          if (!$this->isUnBlowable())
              return $this;         
          $this->set('state_id',$this->getSettings()->get('status_for_unblowing_id'));            
          return $this;
    }
    
    
    /* ====================================== PLACEMENT ============================================== */ 
     function isPlacementable()
    {
       return $this->getSettings()->hasPlacementStatus() && $this->getSettings()->get('status_for_placement_id')!=$this->get('state_id');
    }
    
    function isUnPlacementable()
    {
       return $this->getSettings()->hasUnPlacementStatus() && $this->getSettings()->get('status_for_unplacement_id')!=$this->get('state_id');
    }
    
    function isPlacement()
    {
       return $this->getSettings()->get('status_for_placement_id')==$this->get('state_id');
    }
    
     function isUnPlacement()
    {
       return $this->getSettings()->get('status_for_unplacement_id')==$this->get('state_id');
    }
    
     function setPlacement($user)
    {
          if (!$this->isPlacementable())
              return $this;         
          $this->set('state_id',$this->getSettings()->get('status_for_placement_id'));                            
          return $this;
    }
    
     function setUnPlacement($user)
    {
          if (!$this->isUnPlacementable())
              return $this;         
          $this->set('state_id',$this->getSettings()->get('status_for_unplacement_id'));            
          return $this;
    }
    
    
      function getActiveProductsWithTax()
    {          
       if ($this->isNotLoaded())
           return new ProductCollection(null,$this->getSite());       
        if ($this->active_contract_products===null)
        {                   
            $this->active_contract_products=new ProductCollection(null,$this->getSite());
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('contract_id'=>$this->get('id')))                        
                        ->setObjects(array('Product','Tax'))
                         ->setQuery("SELECT {fields} FROM ".CustomerContractProduct::getTable().                                   
                                    " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('product_id').
                                    " LEFT JOIN ".Product::getOuterForJoin('tva_id').
                                    " WHERE contract_id='{contract_id}' ".
                                        " AND ".Product::getTableField('is_active')."='YES'".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                  return $this->active_contract_products;               
               while ($items=$db->fetchObjects())
               {            
                   $item=$items->getProduct();
                   $item->set('tva_id',$items->hasTax()?$items->getTax():0);
                   $this->active_contract_products[$item->get('id')]=$item;
               }                        
        }    
        return $this->active_contract_products;
    }
    
     function hasActiveProducts()
    {         
         return !$this->getActiveProducts()->isEmpty();
    }
    
    
    function hasPartnerLayer()
    {
        return (boolean)$this->get('partner_layer_id');
    }
    
    function getPartnerLayer()
    {
        if ($this->_partner_layer_id===null)
        {
            $this->_partner_layer_id= new PartnerLayerCompany($this->get('partner_layer_id'),$this->getSite());
        }    
        return $this->_partner_layer_id;
    }
    
    
    function hasSavAt()
     {
         return (boolean)$this->get('sav_at');
     }
     
      function getSavAt()
      {
          return new DayTime($this->get('sav_at'));
      }
      
       function getSavAtDate()
     {
         return new Day($this->get('sav_at'));
     } 
      
      function setOpcAtTimeFromRange()
      {
           if (!$this->hasOpcRange()) 
               return $this;
           $this->set('opc_at',$this->getOpcAtDate()->getDate()." ".$this->getOpcRange()->get('from'));           
           return $this;
      }
      
       function hasAdminStatus()
    {
        return (boolean)($this->get('admin_status_id')!=null);
    }
    
    function getAdminStatus()
    {
        if ($this->_admin_status_id===null)
        {              
            $this->_admin_status_id=new CustomerContractAdminStatus($this->get('admin_status_id'),$this->getSite());           
        }    
        return $this->_admin_status_id;
    }     
    
     function hasDocAt()
     {
         return (boolean)$this->get('doc_at');
     }
     
      function getDocAt()
      {
          return new DayTime($this->get('doc_at'));
      }
      
       function getDocAtDate()
     {
         return new Day($this->get('doc_at'));
     } 
     
     
     function isHoldAdmin()
    {
        return $this->get('is_hold_admin')=='YES';
    }
    
    function setHoldAdmin()
    {
        $this->set('is_hold_admin','YES');
        return $this;
    }
    
    function setUnholdAdmin()
    {
        $this->set('is_hold_admin','NO');
        return $this;
    }
    
    
     function hasPreMeetingAt()
     {
         return (boolean)$this->get('pre_meeting_at');
     }
     
      function getPreMeetingAt()
      {
          return new DayTime($this->get('pre_meeting_at'));
      }
      
       function getPreMeetingAtDate()
     {
         return new Day($this->get('pre_meeting_at'));
     } 
      
     function toArrayForMasterTransfer()
     {
         $values=$this->toArrayForTransfer();
         foreach (array('quoted_at','billing_at') as $field)        
             $values[$field]=$this->get($field);         
         return $values;
     }
     
     function toArrayForTransfer($exceptions = array())
     {
         $values=new mfArray();
         // values
         foreach (array(
                         'id',  'reference','opened_at','total_price_with_taxe','total_price_without_taxe',        
                        'closed_at', 'has_tva','advance_payment','remarks','is_confirmed','sav_at','doc_at',
                     //   'quoted_at','billing_at',
                        'sent_at','payment_at','opc_at','apf_at','pre_meeting_at','created_at','updated_at') as $field)
         {
             $values[$field]=$this->get($field);
         }           
         // foreign keys
         foreach (array( 'customer_id'=>'getCustomer',
                        'financial_partner_id'=>'getPartner', 
                    //    'tax_id'=>'getTax',
                        'team_id'=>'getTeam',
                        'telepro_id'=>'getTelepro',
                        'sale_1_id'=>'getSale1',
                        'sale_2_id'=>'getSale2',
                        'manager_id'=>'getManager',                    
                   //     'partner_layer_id'=>'getPartnerLayer',                     
                        'polluter_id'=>'getPolluter',                   
                        'assistant_id'=>'getAssistant',
                        'admin_status_id'=>'getAdminStatus',                                 
                        'opc_status_id'=>'getOpcStatus',                                   
                        'install_state_id'=>'getInstallStatus',             
                        'time_state_id'=>'getTimeStatus',             
                        'opc_range_id'=>'getOpcRange',                          
                        'sav_at_range_id'=>'getSavAtRange',   
                        'state_id'=>'getStatus',   
                 ) as $field=>$method)
         {        
             if (!$this->get($field))
                 continue;   
             if (in_array($field,$exceptions))
                 continue;
             $values[$field]=$this->$method()->toArrayForTransfer();
         }                 
         return $values;
     }
     
     function hasCreatorUser()
    {       
        return (boolean)$this->created_by_id; 
    }
    
    function getCreatorUser()
    {
       if (!$this->_created_by_id)
        {
            $this->_created_by_id=new User($this->get('created_by_id'),'admin',$this->getSite());
        }    
        return $this->_created_by_id; 
    }
    
    function isBillable()
    {
        return $this->get('is_billable')=="YES"?true:false;
    }
    
    
     function  hasCallcenter()
    {
       return (boolean)$this->get('callcenter_id');      
    }
     
    function getCallcenter()
    {
        return $this->_callcenter_id=$this->_callcenter_id===null?new Callcenter($this->get('callcenter_id'),$this->getSite()):$this->_callcenter_id;
    }
    
    
    
    function copy()
    {
        $item=parent::copy();  
           if (mfContext::getInstance()->getUser()->hasCredential(array(array('contract_list_copy_new_customer'))))  
           {    
           $customer=$this->getCustomer()->copy()->save();
           $item->set('customer_id',$customer);        
           $address=$this->getCustomer()->getAddress()->copy();
           $address->set('customer_id',$customer)->save();
          }
        $item->set('meeting_id',null);
        $item->save();
        return $item;
    }
    
    function copyProductsFrom(CustomerContract $source)
    {
       $products= new CustomerContractProductCollection(null, $this->getSite());
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('contract_id'=>$source->get('id')))
                 ->setQuery("SELECT * FROM ".CustomerContractProduct::getTable().
                            " WHERE contract_id='{contract_id}' ".
                            " GROUP BY product_id".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());  
        if (!$db->getNumRows())
          return $this;
       while ($item=$db->fetchObject('CustomerContractProduct'))
       {            
           $dst=new CustomerContractProduct(null,$this->getSite());
           $dst->copyFrom($item);
           $dst->set('contract_id',$this);
           $products[]=$dst;
       } 
       $products->save();     
        return $this;
    }
    
    function copyAttributionsFrom(CustomerContract $source)
    {
       $contributors= new CustomerContractContributorCollection(null, $this->getSite());
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('contract_id'=>$source->get('id')))
                 ->setQuery("SELECT * FROM ".CustomerContractContributor::getTable().
                            " WHERE contract_id='{contract_id}' ".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());  
        if (!$db->getNumRows())
          return $this;
       while ($item=$db->fetchObject('CustomerContractContributor'))
       {            
           $dst=new CustomerContractContributor(null,$this->getSite());
           $dst->copyFrom($item);
           $dst->set('contract_id',$this);
           $contributors[]=$dst;
       } 
       $contributors->save();     
       return $this;
    }
    
    
    function getProductItems()
    {
        if ($this->items===null)
        {    
            $this->items= new CustomerContractProductItemCollection(null, $this->getSite());
            $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('contract_id'=>$this->get('id')))
                     ->setQuery("SELECT * FROM ".CustomerContractProductItem::getTable().
                                " WHERE contract_id='{contract_id}' ".
                                ";")
                     ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
              return $this->items;
           while ($item=$db->fetchObject('CustomerContractProductItem'))
           {                           
               $this->items[$item->get('id')]=$item->loaded()->setSite($this->getSite());
           }           
        }
        return $this->items;                
    }
    
    function updateItems(ProductItemCollection $items)
    {
        if ($items->isEmpty())
            return $this;
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('contract_id'=>$this->get('id')))
                 ->setQuery("DELETE FROM ".CustomerContractProductItem::getTable().
                            " WHERE contract_id='{contract_id}' ".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());              
         $this->items= new CustomerContractProductItemCollection(null, $this->getSite());
         foreach ($items as $item)
         {
              $product_item=new CustomerContractProductItem(null,$this->getSite());
              $product_item->add(array('contract_id'=>$this,
                                       'product_id'=>$item->get('product_id'),
                                       'item_id'=>$item
                                    ));
              $this->items[]=$product_item;
         }  
         $this->items->save();
         return $this;
    }
    
    
    function getProductItemsWithProductAndItem()
    {
       if ($this->items===null)
        {    
            $this->items= new CustomerContractProductItemCollection(null, $this->getSite());
            $db=mfSiteDatabase::getInstance()
                     ->setParameters(array('contract_id'=>$this->get('id')))
                    ->setObjects(array('CustomerContractProductItem','Product','ProductItem'))
                     ->setQuery("SELECT {fields} FROM ".CustomerContractProductItem::getTable().
                                " INNER JOIN ".CustomerContractProductItem::getOuterForJoin('product_id').
                                " INNER JOIN ".CustomerContractProductItem::getOuterForJoin('item_id').
                                " WHERE contract_id='{contract_id}' ".
                                ";")
                     ->makeSiteSqlQuery($this->getSite());  
            if (!$db->getNumRows())
              return $this->items;
           while ($items=$db->fetchObjects())
           {                           
               $item=$items->getCustomerContractProductItem();
               $item->set('item_id',$items->getProductItem());
               $item->set('product_id',$items->getProduct());
               $this->items[$item->get('id')]=$item;
           }           
        }
        return $this->items;  
    }
    
    
    function updateItem($item_id)
    {
        
    }
    
    
     function hasQuotedAt()
     {
         return (boolean)$this->get('quoted_at');
     }
     
      function getQuotedAt()
      {
          return new DayTime($this->get('quoted_at'));
      }
      
       function getQuotedAtDate()
     {
         return new Day($this->get('quoted_at'));
     } 
     
     function hasBillingAt()
     {
         return (boolean)$this->get('billing_at');
     }
     
      function getBillingAt()
      {
          return new DayTime($this->get('billing_at'));
      }
      
       function getBillingAtDate()
     {
         return new Day($this->get('billing_at'));
     } 
     
    
     function setDatesIsOpened()
     {      
         $this->set('dates_is_opened','YES');
         $this->set('dates_opened_at',date("Y-m-d H:i:s"));
         $this->set('dates_opened_at_by',mfCOntext::getInstance()->getUser()->getGuardUser());
         return $this->save();
     }
     
     function isDatesIsOpened() 
     {           
         return $this->get('dates_is_opened')=='YES' || $this->get('is_opened_dates')==="true";
     }
     
     
     function getEngine()
     {
         return $this->engine=$this->engine===null?new CustomerContractDatesCheckerEngine($this):$this->engine;
     }
     
     
     function isSigned()
     {
         return $this->get('is_signed')=='YES';
     }
     
     
     function isPreMeetingAtAndQuotedAtBelowOrEqualOpenedAt()
     {         
         if ($this->getPreMeetingAtDate()->getDate() > $this->getOpenedAtDate())
             return false;
          if ($this->getQuotedAtDate()->getDate() > $this->getOpenedAtDate())
             return false;         
         return true;
     }
     
     
     function isPreMeetingAtAndQuotedAtBelowOrEqualToday()
     {         
         $today = new Day();
         if ($this->getPreMeetingAtDate()->getDate() > $today->getDate())
             return false;
          if ($this->getQuotedAtDate()->getDate() > $today->getDate())
             return false;         
         return true;
     }
     
     
      function getHoldQuoteI18n()
    {
        return __($this->get('is_hold_quote')); 
    }
    
    function isHoldQuote()
    {
        return $this->get('is_hold_quote')=='YES';
    }
    
    function setHoldQuote()
    {
        $this->set('is_hold_quote','YES');
        return $this;
    }
    
    function setUnholdQuote()
    {
        $this->set('is_hold_quote','NO');
        return $this;
    }
    
    function updateProducts(mfArray $values)
    {
       // var_dump($values);
        $this->contract_products = new CustomerContractProductCollection(null,$this->getSite());
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('contract_id'=>$this->get('id')))
                 ->setQuery("SELECT * FROM ".CustomerContractProduct::getTable().
                            " WHERE contract_id='{contract_id}' AND product_id IN('".$values->getKeys()->implode("','")."')".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());    
        if ($db->getNumRows())
        {   
            
        }
        
        foreach ($values as $product_id=>$value)
        {
            $item = new CustomerContractProduct(null,$this->getSite());
            $item->add(array('contract_id'=>$this,'product_id'=>$product_id,
                             'quantity'=>$value['quantity'],
                             'price_with_tax'=>$value['prime']));
            $item->set('total_sale_price_with_tax',$item->getQuantity() * $item->getAddedPriceWithTax());
            
        }    
        return $this;
    }
    
    function isDocument()
    {
        return (boolean)$this->get('is_document')=='Y';
    }
    
    function isPhoto()
    {
        return (boolean)$this->get('is_photo')=='Y';
    }
    
    function isQuality()
    {
        return (boolean)$this->get('is_quality')=='Y';
    }
    
   /* function setBillableFromStatus($state_id){
        $this->set('is_billable',$state_id===$this->getSettings()->getStatusNoBillable()->get('id')?'NO':'YES');
        return $this;
    }*/
    
    function hasCompany()
    {
        return (boolean)$this->get('company_id');
    }
    
      function getCompany()
    {
        return $this->_company_id=$this->_company_id===null?new CustomerContractCompany($this->get('company_id'),$this->getSite()):$this->_company_id;
    }
    
    
    function getWorks()
    {       
        return $this->works=$this->works===null?new DomoprimeCustomerContractWorkCollection($this,$this->getSite()):$this->works;
    }
    
    function create()
    {
        $this->add(array(
            'status'=>'INPROGRESS',
            'created_by_id'=> mfcontext::getInstance()->getUser()->getGuardUser()
        ));       
        $this->save();
        return $this;
    }
    
   /* function getStates()
    {
        return $this->states=$this->states===null?new DomoprimeCustomerContractWorkCollection($this,$this->getSite()):$this->states;
    }*/
    
    
    function toArrayForApi($options)
    {
        return $this->formatter_api=$this->formatter_api===null?new ContractItemFormatterApi($this,$options):$this->formatter_api;
    }
    
      function hasCampaign()
    {
        return (boolean)$this->get('campaign_id');
    }
    
      function getCampaign()
    {
        return $this->_campaign_id=$this->_campaign_id===null?new CustomerMeetingCampaign($this->get('campaign_id'),$this->getSite()):$this->_campaign_id;
    }
    
     
    function getOpenedAt()
    {
        
       return new DayTime($this->get('opened_at'));
    }
}
