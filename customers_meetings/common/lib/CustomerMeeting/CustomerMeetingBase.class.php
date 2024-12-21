<?php

class CustomerMeetingBase extends mfObject2 {
     
    protected static $_variables=array('see_with_mr','see_with_mrs'); //,'see_both');
    
    protected static $fields=array('customer_id','in_at','out_at','state_id','status','sales_id','sale2_id','telepro_id','variables',
                                   'assistant_id',  'callback_at','is_callback_cancelled','callback_cancel_at',
                                   'lock_user_id','lock_time','is_locked','campaign_id','callcenter_id','type_id',
                                   'status_call_id','confirmator_id','is_qualified','sale_comments','status_lead_id',
                                   'confirmed_at','treated_at','created_by_id','confirmed_by_id',  
                                   'registration','turnover',
                                   'state_updated_at',
                                   'polluter_id','is_hold',
                                   'opc_at', 'is_works_hold',
                                   'opc_range_id',
                                   'in_at_range_id','is_hold_quote',
                                   'partner_layer_id','company_id',                                                         
                                   'creation_at', // System
                                   'remarks','is_confirmed','created_at','updated_at');
    protected static $fieldsNull=array('in_at','lock_time','callback_at','callback_cancel_at',
                                       'state_updated_at','opc_at','company_id','customer_id',
                                    //'callcenter_id',
                                       'polluter_id','opc_range_id','company_id','created_by_id','campaign_id','partner_layer_id',      
                                        'confirmed_at','treated_at'); // By default
    const table="t_customers_meeting"; 
    protected static $foreignKeys=array('customer_id'=>'Customer',
                                        'state_id'=>'CustomerMeetingStatus',  
                                        'telepro_id'=>'User','sales_id'=>'User','sale2_id'=>'User',
                                        'assistant_id'=>'User','lock_user_id'=>'User',
                                        'campaign_id'=>'CustomerMeetingCampaign',
                                        'callcenter_id'=>'Callcenter',
                                        'status_call_id'=>'CustomerMeetingStatusCall',
                                        'type_id'=>'CustomerMeetingType',
                                        'status_lead_id'  =>'CustomerMeetingStatusLead', 
                                        'created_by_id'=>'User',
                                        'confirmed_by_id'=>'User',
                                        'polluter_id'=>'PartnerPolluterCompany',
                                        'opc_range_id'=>'CustomerContractRange',
                                        'in_at_range_id'=>'CustomerContractRange',
                                        'partner_layer_id'=>'PartnerLayerCompany',
                                        'company_id'=>'CustomerMeetingCompany',      
                                        ); // By default
 
    function __construct($parameters=null,$site=null) {
      parent::__construct(null,$site);   
      $this->getDefaults(); 
      if ($parameters === null)  return $this;      
      if (is_array($parameters)||$parameters instanceof ArrayAccess)
      {
          if (isset($parameters['id']))
             return $this->loadbyId((string)$parameters['id']);        
           if (isset($parameters['in_at']) && isset($parameters['phone']))
             return $this->loadbyDateTimeAndCustomer((string)$parameters['in_at'],$parameters['phone']);        
          return $this->add($parameters); 
      }   
      else
      {
         if (is_numeric((string)$parameters)) 
            return $this->loadbyId((string)$parameters);
         
      }   
    }
    
    function loadbyDateTimeAndCustomer($date_time,$phone)
    {        
        $this->set('in_at',$date_time);
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('in_at'=>$date_time,'phone'=>$phone))
            ->setObjects(array('CustomerMeeting','Customer'))
            ->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().
                       " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                     //  " WHERE phone='{phone}' AND in_at='{in_at}'".     
                       " WHERE phone='{phone}' AND in_at=".($this->get('in_at')?"'".$this->get('in_at')."'":"NULL").
                       " LIMIT 0,1;")
            ->makeSiteSqlQuery($this->getSite());    
         if (!$db->getNumRows())
             return $this;                  
        $items=$db->fetchObjects();       
        $this->set('customer_id',$items->getCustomer());
        $this->toObject($items->getCustomerMeeting());   
        $this->loaded();
        return $this;
    }
    
    protected function loadById($id) {
        parent::loadById($id);
        $this->getVariables();        
    }
    
    protected function executeLoadById($db)
    {
         $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%d';")
            ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
       $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
       $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");   
       $this->creation_at=isset($this->creation_at)?$this->creation_at:date("Y-m-d H:i:s");
       $this->treated_at=isset($this->treated_at)?$this->treated_at:date("Y-m-d H:i:s");
       $this->is_confirmed=isset($this->is_confirmed)?$this->is_confirmed:"NO";
       $this->is_qualified=isset($this->is_qualified)?$this->is_qualified:"NO";       
    //   $this->variables=isset($this->variables)?$this->variables:serialize(array('see_with_mr'=>'YES','see_with_mrs'=>'NO','see_both'=>'NO'));  
       $this->see_with_mr=isset($this->see_with_mr)?$this->see_with_mr:'YES';
       $this->see_with_mrs=isset($this->see_with_mrs)?$this->see_with_mrs:'NO';
       $this->is_locked=isset($this->is_locked)?$this->is_locked:'NO';
       $this->is_hold=isset($this->is_hold)?$this->is_hold:'NO';
       $this->status=isset($this->status)?$this->status:"ACTIVE"; 
       $this->turnover=isset($this->turnover)?$this->turnover:0.0; 
       $this->is_callback_cancelled=isset($this->is_callback_cancelled)?$this->is_callback_cancelled:'NO';       
         $this->is_works_hold=isset($this->is_works_hold)?$this->is_works_hold:"N";
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));    
     /*  if ($this->hasPropertyChanged('state_id'))
       {                
            $this->set('treated_at',date("Y-m-d H:i:s"));  
            if (in_array($this->get('state_id'),$this->getSettings()->get('updated_at_states')))
            {        
               $this->set('state_updated_at',date("Y-m-d H:i:s"));  
            }   
       } */
       return $this;
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
      $key_condition=($this->getKey())?" AND ".self::getTableField('id')."!='{id}';":"";
      $db->setParameters(array('id'=>$this->getKey(),'phone'=>$this->getCustomer()->get('phone'),'in_at'=>$this->get('in_at')))
         ->setQuery("SELECT ".self::getTableField('id')." FROM ".self::getTable().
                    " LEFT JOIN ".self::getOuterForJoin('customer_id').
                    //" WHERE in_at='{in_at}' AND in_at!='' AND phone='{phone}' ".$key_condition)
                    " WHERE in_at=".($this->get('in_at')?"'".$this->get('in_at')."'":"NULL")." AND in_at IS NOT NULL AND phone='{phone}' ".$key_condition)
         ->makeSiteSqlQuery($this->site);      
    }
    
    function save() {
        $this->setVariables();
        return parent::save();
    }       
    
    function setConfirmed($user)
    {        
        $this->set('is_confirmed','YES');  
        if ($this->getSettings()->hasConfirmedAt())  
        {  
            $this->set('confirmed_by_id',$user->getGuardUser());
            $this->set('confirmed_at',date("Y-m-d H:i:s"));
        }    
        return $this;
    }
    
    function setCancelled()
    {
          $this->set('is_confirmed','NO');  
          return $this;
    }
   
    public function getCustomer()
    {      
        if (!$this->_customer_id)
        {
            $this->_customer_id=new Customer($this->get('customer_id'),$this->getSite());          
        }    
        return $this->_customer_id;
    }
    
    function hasSale()
    {
        return (boolean)$this->get('sales_id');       
    }
    
    function getSale()
    {
        if (!$this->_sales_id)
        {
            $this->_sales_id=new User($this->get('sales_id'),'admin',$this->getSite());
        }    
        return $this->_sales_id;
    }
    
    function  hasSale2()
    {
       return (boolean)$this->get('sale2_id');      
    }
    
    function  getSale2()
    {
       if (!$this->_sale2_id)
        {
            $this->_sale2_id=new User($this->get('sale2_id'),'admin',$this->getSite());
        }    
        return $this->_sale2_id; 
    }
    
    function hasTelepro()
    {
        return (boolean)$this->get('telepro_id');
        
    }
    
    function getTelepro()
    {
        if (!$this->_telepro_id)
        {
            $this->_telepro_id=new User($this->get('telepro_id'),'admin',$this->getSite());
        }    
        return $this->_telepro_id;
    }
    
    function getAssistant()
    {
        if (!$this->_assistant_id)
        {
            $this->_assistant_id=new User($this->get('assistant_id'),'admin',$this->getSite());
        }    
        return $this->_assistant_id;
    }
    
    function  hasAssistant()
    {
       return (boolean)$this->get('assistant_id');      
    }
    
    
    function getConfirmator()
    {
        if (!$this->_confirmator_id)
        {
            $this->_confirmator_id=new User($this->get('confirmator_id'),'admin',$this->getSite());
        }    
        return $this->_confirmator_id;
    }
    
    function  hasConfirmator()
    {
       return (boolean)$this->get('confirmator_id');      
    }
    
    function hasStatus()
    {
        return (boolean)($this->get('state_id'));
    }
    
    function getStatus()
    {
        if ($this->_state_id===null)
        {              
            $this->_state_id=new CustomerMeetingStatus($this->get('state_id'),$this->getSite());           
        }    
        return $this->_state_id;
    }
    
    function getOldStatus()
    {
        if ($this->_old_state_id===null)
        {                          
            $this->_old_state_id=new CustomerMeetingStatus($this->hasPropertyChanged('state_id')?$this->getPropertyChanged('state_id'):null,$this->getSite());           
        }    
        return $this->_old_state_id;
    }
    
    function  hasCampaign()
    {
       return (boolean)$this->get('campaign_id');      
    }
     
    function getCampaign()
    {
        if (!$this->_campaign_id)
        {
            $this->_campaign_id=new CustomerMeetingCampaign($this->get('campaign_id'),$this->getSite());
        }    
        return $this->_campaign_id;
    }
    
     function  hasCallcenter()
    {
       return (boolean)$this->get('callcenter_id');      
    }
     
    function getCallCenter()
    {
        if ($this->_callcenter_id===null)
        {
            $this->_callcenter_id=new CallCenter($this->get('callcenter_id'),$this->getSite());
        }    
        return $this->_callcenter_id;
    }
    
    function  hasType()
    {
       return (boolean)$this->get('type_id');      
    }
     
    function getType()
    {
        if (!$this->_type_id)
        {
            $this->_type_id=new CustomerMeetingType($this->get('type_id'),$this->getSite());
        }    
        return $this->_type_id;
    }
    
    function  hasCallStatus()
    {
       return (boolean)$this->get('status_call_id');      
    }
     
    function getCallStatus()
    {
        return $this->_status_call_id=$this->_status_call_id===null?new CustomerMeetingStatusCall($this->get('status_call_id'),$this->getSite()):$this->_status_call_id;
    }
    
    
     function  hasLeadStatus()
    {
       return (boolean)$this->get('status_lead_id');      
    }
     
    function getLeadStatus()
    {
        return $this->_status_lead_id=$this->_status_lead_id===null?new CustomerMeetingStatusLead($this->get('status_lead_id'),$this->getSite()):$this->_status_lead_id;
    }
    
    protected function setVariables()
    {
        $variables=array();
        foreach (self::$_variables as $name)
             $variables[$name]=$this->get($name);           
        $this->set('variables',serialize($variables));       
        return $this;
    }       
    
    protected function getVariables()
    {
       if (!$this->get('variables'))
           return $this;
       $variables=unserialize($this->get('variables')); 
       foreach (self::$_variables as $name)
       {        
           $this->set($name,$variables[$name]);
       } 
       return $this;
    }
    
   function isConfirmed()
   {
       return ($this->get('is_confirmed')=='YES');
   } 
   
   function isQualified()
   {
       return ($this->get('is_qualified')=='YES');
   } 
      
   function getMeetingProducts()
    {
       if ($this->isNotLoaded())
           return array();       
        if ($this->meeting_products===null)
        {                                              
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('meeting_id'=>$this->get('id')))
                         ->setObjects(array('CustomerMeetingProduct','Product'))
                         ->setQuery("SELECT {fields} FROM ".CustomerMeetingProduct::getTable().
                                    " INNER JOIN ".CustomerMeetingProduct::getOuterForJoin('product_id').
                                    " WHERE meeting_id='{meeting_id}' ".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());      
              //  echo $db->getQuery();
                if (!$db->getNumRows())
                  return array();              
               $this->meeting_products=array();
               while ($items=$db->fetchObjects())
               {                          
                   $item=$items->getCustomerMeetingProduct();
                   $item->set('product_id',$items->getProduct());
                   $this->meeting_products[$item->get('id')]=$item;
                }                        
        }    
        return $this->meeting_products;
    }
    
   
    
    function getActiveProducts()
    {
       if ($this->isNotLoaded())
           return new ProductCollection(null,$this->getSite());       
        if ($this->active_meeting_products===null)
        {                   
            $this->active_meeting_products=new ProductCollection(null,$this->getSite());
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('meeting_id'=>$this->get('id')))                        
                         ->setQuery("SELECT ".Product::getFieldsAndKeyWithTable()." FROM ".CustomerMeetingProduct::getTable().
                                    " LEFT JOIN ".CustomerMeetingProduct::getOuterForJoin('product_id').
                                    " WHERE meeting_id='{meeting_id}' ".
                                        " AND is_active='YES'".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                  return $this->active_meeting_products;               
               while ($item=$db->fetchObject('Product'))
               {                          
                   $this->active_meeting_products[$item->get('id')]=$item;
               }                        
        }    
        return $this->active_meeting_products;
    }
    
     function getActiveProductsWithTax()
    {
       if ($this->isNotLoaded())
           return new ProductCollection(null,$this->getSite());       
        if ($this->active_meeting_products===null)
        {                   
            $this->active_meeting_products=new ProductCollection(null,$this->getSite());
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('meeting_id'=>$this->get('id')))                        
                        ->setObjects(array('Product','Tax'))
                         ->setQuery("SELECT {fields} FROM ".CustomerMeetingProduct::getTable().                                 
                                    " LEFT JOIN ".CustomerMeetingProduct::getOuterForJoin('product_id').
                                    " LEFT JOIN ".Product::getOuterForJoin('tva_id').
                                    " WHERE meeting_id='{meeting_id}' ".
                                        " AND ".Product::getTableField('is_active')."='YES'".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                  return $this->active_meeting_products;               
               while ($items=$db->fetchObjects())
               {            
                   $item=$items->getProduct();
                   $item->set('tva_id',$items->hasTax()?$items->getTax():0);
                   $this->active_meeting_products[$item->get('id')]=$item;
               }                        
        }    
        return $this->active_meeting_products;
    }
    
     function hasActiveProducts()
    {         
         return !$this->getActiveProducts()->isEmpty();
    }
    
    function hasMeetingProducts()
    {
        $this->getMeetingProducts();
        return !empty($this->meeting_products);
    }
    
    function getMeetingProductsActive()
    {
       if ($this->isNotLoaded())
           return array();       
        if (!$this->meeting_products_active)
        {                                    
                $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('meeting_id'=>$this->get('id')))
                         ->setObjects(array('CustomerMeetingProduct','Product'))
                         ->setQuery("SELECT {fields} FROM ".CustomerMeetingProduct::getTable().
                                    " LEFT JOIN ".CustomerMeetingProduct::getOuterForJoin('product_id').
                                    " WHERE meeting_id='{meeting_id}' AND ".CustomerMeetingProduct::getTableField('status')."='ACTIVE'".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());                
                if (!$db->getNumRows())
                  return array();
               $this->meeting_products_active=array();
               while ($item=$db->fetchObjects())
               {        
                   $item->getCustomerMeetingProduct()->set('product_id',$item->getProduct());
                   $this->meeting_products_active[]=$item->getCustomerMeetingProduct();
                }                        
        }    
        return $this->meeting_products_active;
    }
   
    function hasMeetingProductsActive()
    {
        $this->getMeetingProductsActive();
        return !empty($this->meeting_products_active);
    }           
    
    function setComments($user,$action="")
    {
       $settings=  CustomerMeetingSettings::load($this->getSite());
       if ($this->hasPropertyChanged('state_id'))
       {                   
           $old=new CustomerMeetingStatusI18n(array("lang"=>$user->getCountry(),"status_id"=>$this->getPropertyChanged('state_id')),$this->getSite());
           $new=new CustomerMeetingStatusI18n(array("lang"=>$user->getCountry(),"status_id"=>$this->get('state_id')),$this->getSite());
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',$old->get('value')." => ".$new->get('value').__(" by ").(string)$user->getGuardUser());           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());       
           if ($user->hasCredential(array('meeting_view_treated_at_modified_by_status_change')))
           {
               $this->set('treated_at',date("Y-m-d H:i:s"));  
           } 
           if (in_array($this->get('state_id'),$this->getSettings()->get('updated_at_states')))
           {        
               $this->set('state_updated_at',date("Y-m-d H:i:s"));  
           } 
       }
       if ($this->hasPropertyChanged('status_call_id') && $settings->hasCallcenter())
       {          
           if ($user->hasCredential(array(array('meeting_view_treated_at_modified_by_status_call_change'))))
           {
               $this->set('treated_at',date("Y-m-d H:i:s"));
           }   
           $old=new CustomerMeetingStatusCallI18n(array("lang"=>$user->getCountry(),"status_id"=>$this->getPropertyChanged('status_call_id')),$this->getSite());
           $new=new CustomerMeetingStatusCallI18n(array("lang"=>$user->getCountry(),"status_id"=>$this->get('status_call_id')),$this->getSite());
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__('Callcenter status:')." ".$old->get('value')." => ".$new->get('value').__(" by ").(string)$user->getGuardUser());           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());              
       }
       if ($this->hasPropertyChanged('is_confirmed'))
       {
           $old=($this->getPropertyChanged('is_confirmed')=='YES')?"Confirmed":"Not confirmed";
           $new=($this->get('is_confirmed')=='YES')?"Confirmed":"Not confirmed";
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__($old)." => ".__($new));           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();          
           // History
           $comment->setHistory($user->getGuardUser()); 
       }         
       if ($this->hasPropertyChanged('sales_id'))
       {
           $old=new User($this->getPropertyChanged('sales_id'),'admin',$this->getSite());
           if ($old->isNotLoaded())
               $old=__("Nothing");
           $new=new User($this->get('sales_id'),'admin',$this->getSite());
            if ($new->isNotLoaded())
               $new=__("Nothing");
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $message=__("Sale 1 : {old} => {new}",array('old'=>(string)$old,'new'=>(string)$new));
           $comment->set('comment',$message);          
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();          
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       if ($this->hasPropertyChanged('sale2_id'))
       {
           $old=new User($this->getPropertyChanged('sale2_id'),'admin',$this->getSite());
           if ($old->isNotLoaded())
               $old=__("Nothing");            
           $new=new User($this->get('sale2_id'),'admin',$this->getSite());
           if ($new->isNotLoaded())
               $new=__("Nothing");
           $comment= new CustomerMeetingComment(null,$this->getSite());   
           $message=__("Sale 2 : {old} => {new}",array('old'=>(string)$old,'new'=>(string)$new));
           $comment->set('comment',$message);           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();          
           // History
           $comment->setHistory($user->getGuardUser());  
       }      
       
       /* ACTIONS */
       
       if ($action=='create')
       {
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Meeting created by ").(string)$user->getGuardUser());           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       elseif ($action=='delete')
       {
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Meeting has been deleted by ").(string)$user->getGuardUser());           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }  
       elseif ($action=='recycle')
       {
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Meeting has been recycled by ").(string)$user->getGuardUser());           
           $comment->set('meeting_id',$this);
           $comment->set('type','SYSTEM');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }         
       elseif ($action=='hold_quote')
       {
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Meeting has been quotation hold by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('meeting_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }
       elseif ($action=='unhold_quote')
       {
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Meeting has been quotation unhold by ").strtoupper((string)$user->getGuardUser()));           
           $comment->set('meeting_id',$this);
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());  
       }         
       $this->setLogComments($user);
    }
        
   /* ================================== IN_AT ============================================ */ 
   function getDate($format="Y-m-d")
    {
        return date($format,strtotime($this->get('in_at')));
    }
    
     function getTime($format="Y-m-d h:i:s")
    {
        return date($format,strtotime($this->get('in_at')));
    }          
    
    function getHour()
    {       
        return date("H",strtotime($this->get('in_at')));
    }
    
     function getMinute()
    {       
        return date("i",strtotime($this->get('in_at')));
    }
    
    /* ================================== CALLBACK_AT ============================================ */
    
    function getCallbackDate($format="Y-m-d")
    {
        return date($format,strtotime($this->get('callback_at')));
    }
    
     function getCallbackTime($format="Y-m-d h:i:s")
    {
        return date($format,strtotime($this->get('callback_at')));
    }
    
    function getCallbackHour()
    {       
        return date("H",strtotime($this->get('callback_at')));
    }
    
     function getCallbackMinute()
    {       
        return date("i",strtotime($this->get('callback_at')));
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
    
    function isUserAuthorized($user,$action='view')
    {            
        // to do membre equipe for sales
        if ($user->hasCredential(array(array('superadmin','admin','meeting_view_all'))))
               return true;                   
        $credential = false;
        if ($user->hasCredential(array(array('meeting_view_telepro_manager'))))
        {
            $credential |= $this->get('telepro_id') && ($user->getGuardUser()->getTeleproManagerCollaborators()->getKeys()->in($this->get('telepro_id')) ||
                   $user->getGuardUser()->getTeleproManagerCollaborators()->getKeys()->in($this->get('created_by_id')));
        }
        
        if ($user->hasCredential(array(array('meeting_view_creator'))))
        {
            $credential |=$user->getGuardUser()->get('id') == $this->get('created_by_id');
        }
        
      /*  if ($user->hasGroups(array('telepro','commercial')) || ($user->hasCredential(array(array('meeting_view_telepro','meeting_view_sale','meeting_view_assistant')))
                && ($user->getGuardUser()->get('id') == $this->get('telepro_id') ||
                    $user->getGuardUser()->get('id') == $this->get('sales_id') ||
                    $user->getGuardUser()->get('id') == $this->get('sale2_id') ||
                    $user->getGuardUser()->get('id') == $this->get('assistant_id'))   
           ))
        {
           $credential |= true;
        }    */
        if ($user->hasGroups(array('telepro')) || ($user->hasCredential(array(array('meeting_view_telepro')))
                && $user->getGuardUser()->get('id') == $this->get('telepro_id'))
           )
        {
           $credential |= true;
        } 
        if ($user->hasGroups(array('commercial')) || ($user->hasCredential(array(array('meeting_view_sale')))
                && ($user->getGuardUser()->get('id') == $this->get('sale2_id') ||
                    $user->getGuardUser()->get('id') == $this->get('sales_id'))
           ))
        {
           $credential |= true;
        } 
       /* if ($user->hasCredential(array(array('meeting_view_assistant'))) && $user->getGuardUser()->get('id') == $this->get('assistant_id')   
           )
        {
           $credential |= true;
        } */
        
       /* if (($user->hasGroups('telepro') || $user->hasCredential(array(array('meeting_view_telepro')))) && $user->getGuardUser()->get('id')==$this->get('telepro_id'))
               $credential |= true;
        if (($user->hasGroups('commercial') || $user->hasCredential(array(array('meeting_view_sale')))) && 
                ($user->getGuardUser()->get('id')==$this->get('sales_id') || $user->getGuardUser()->get('id')==$this->get('sale2_id')))        
           $credential |= true;  */
        if (($user->hasGroups('assistant') || $user->hasCredential(array(array('meeting_view_assistant')))) && 
                ($user->getGuardUser()->get('id')==$this->get('assistant_id') || $this->get('assistant_id')==0))   
        {                
          $credential |= true;
        }  
        if ($user->hasCredential(array(array('meeting_view_as_assistant'))) && $user->getGuardUser()->get('id')==$this->get('assistant_id'))   
        {                
          $credential |= true;
        }
      
        return $credential;       
    }    
       
    
   function toArray($fields = null) {
        $values=parent::toArray($fields);       
        if ($this->get('see_with_mrs')=='YES' && $this->get('see_with_mr')=='YES')
            $values['see_with']=__('miss and mister');
        elseif ($this->get('see_with_mrs')=='YES')
            $values['see_with']=__('miss');
        elseif ($this->get('see_with_mr')=='YES')
            $values['see_with']=__('mister'); 
        if ($this->hasTelepro() && $this->getTelepro()->isLoaded())
        {                
            $values['telepro']=(string)$this->getTelepro();         
            if ($this->getTelepro()->hasTeams())
            {    
                $values['teams']=(string)$this->getTelepro()->getTeams()->getNames()->implode()->upper();
            } 
        }   
        if ($this->hasSale())
            $values['sale_1']=(string)$this->getSale();
        if ($this->hasSale2())
            $values['sale_2']=(string)$this->getSale2();
        if ($this->hasAssistant())
            $values['assistant']=(string)$this->getAssistant();        
       //   if ($this->hasAssistant())
       //     $values['assistant']=(string)$this->getAssistant();        
        return $values;
    }    
    
    function isLocked()
    {
        return ($this->get('is_locked')=='YES');
    }
    
    function hasUserLock()
    {       
        return (boolean)$this->lock_user_id; 
    }
    
    function getUserLock()
    {
       if (!$this->_lock_user_id)
        {
            $this->_lock_user_id=new User($this->get('lock_user_id'),'admin',$this->getSite());
        }    
        return $this->_lock_user_id; 
    }
    
    function getLock($user)
    {
        if ($this->isNotLoaded())
            return true;
        CustomerMeetingUtils::cleanLocks($this);                    
      //  echo "<pre>"; var_dump($this->get('lock_user_id'),$user->get('id'),$this->isLocked()); echo "</pre>";
         if ($user->get('id')!=$this->get('lock_user_id') && $this->isLocked())
              return false;   // not lock
         // Save        
         $this->set('lock_time',date("Y-m-d H:i:s"));
         $this->set('lock_user_id',$user);
         $this->set('is_locked','YES');
         $this->save();
         return true; // has lock
    }
    
    // only used for list
    function isLockOwner()
    {
        return $this->is_lock_owner;
    }
    
    function unlock()
    {
         $this->set('lock_time',null);
         $this->set('lock_user_id',0);
         $this->set('is_locked','NO');
         $this->_lock_user_id=null;         
    }
    
    function getReleaseTimeLock()
    {
        $settings=  CustomerMeetingSettings::load($this->getSite());
        return (strtotime($this->get('lock_time'))+$settings->get('lock_time_out'))-time();
    }
    
    function releaseLockForUser($user)
    {
        if ($this->isNotLoaded())
            return $this;
        if ($user->get('id')!=$this->get('lock_user_id'))
            return $this;
        $this->unlock();
        $this->save();
    }
    
    function removeCallback()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_callback_cancelled','YES');
        $this->set('callback_cancel_at',date("Y-m-d H:i:s"));
        $this->save();
        return $this;
    }
    
    function hasSales()
     {
         return $this->hasSale() || $this->hasSale2();
     }
     
     function getNumberOfConfirmedMeetings()
     {
         if ($this->isNotLoaded())
             return false;
         $day=new Day($this->get('in_at'));         
         $db=mfSiteDatabase::getInstance()
                         ->setParameters(array('in'=>$day->getDate()." 00:00:00",'out'=>$day->getDate()." 23:59:59"))                       
                         ->setQuery("SELECT count(id) FROM ".CustomerMeeting::getTable().                                   
                                    " WHERE in_at BETWEEN '{in}' AND '{out}' AND ".
                                            CustomerMeeting::getTableField('status')."='ACTIVE' AND ".
                                            CustomerMeeting::getTableField('is_confirmed')."='YES'".
                                    ";")
                         ->makeSiteSqlQuery($this->getSite());  
         $row=$db->fetchRow();
         return (int)$row[0];
     }
     
     function getFormattedNumberOfConfirmedMeetings()
     {
         $confirmed=$this->getNumberOfConfirmedMeetings();
         return format_number_choice('[0] 0 confirmed|[1]one confirmed|(1,Inf]%s confirmed',$confirmed,$confirmed);
     }
     
     function getDateTimeConfirmedAt()
     {
        $settings= CustomerMeetingSettings::load($this->getSite());       
        if ($settings->hasConfirmedAt())
            return array('date'=>format_date($this->get('confirmed_at'),'a'),'time'=>format_date($this->get('confirmed_at'),'t'));
        return null;
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
    
    function hasDuplicateConfirmed()
    {
        if ($this->duplicate_confirmed===null)
        {              
            $condition=$this->isLoaded()?" AND ".CustomerMeeting::getTableField('id')."!={id}":"";
               
            $db=mfSiteDatabase::getInstance()
                             ->setParameters(array('phone'=>$this->getCustomer()->get('phone'),'id'=>$this->get('id')))                       
                             ->setQuery("SELECT count(".CustomerMeeting::getTableField('id').") FROM ".CustomerMeeting::getTable().
                                        " INNER JOIN ".CustomerMeeting::getOuterForJoin('customer_id').
                                        " WHERE ".
                                                Customer::getTableField('phone')."='{phone}' AND ".
                                                CustomerMeeting::getTableField('status')."='ACTIVE' AND ".
                                                CustomerMeeting::getTableField('is_confirmed')."='YES' ".
                                                $condition.
                                        ";")
                             ->makeSiteSqlQuery($this->getSite());  
             $row=$db->fetchRow();
             $this->duplicate_confirmed=(boolean)($row[0] > 0);
        }  
        return  $this->duplicate_confirmed;        
    }
    
    function setLogComments($user)
    {
       if ($this->hasPropertyChanged('created_at'))
       {               
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Created date modified {old} => {new}",array('old'=>format_date($this->getPropertyChanged('created_at'),array('d','t')),'new'=>format_date($this->get('created_at'),array('d','t')))));           
           $comment->set('meeting_id',$this);
           $comment->set('type','LOG');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());                        
       } 
       if ($this->hasPropertyChanged('in_at'))
       {                  
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Meeting date modified {old} => {new}",array('old'=>format_date($this->getPropertyChanged('in_at'),array('d','t')),'new'=>format_date($this->get('in_at'),array('d','t')))));           
           $comment->set('meeting_id',$this);
           $comment->set('type','LOG');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());                        
       } 
       // remarks
       if ($this->hasPropertyChanged('remarks'))
       {                  
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Remarks have been modified."));           
           $comment->set('meeting_id',$this);
           $comment->set('type','LOG');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());                        
       } 
       // sale_comments
       if ($this->hasPropertyChanged('sale_comments'))
       {                  
           $comment= new CustomerMeetingComment(null,$this->getSite());        
           $comment->set('comment',__("Sale comments have been modified."));           
           $comment->set('meeting_id',$this);
           $comment->set('type','LOG');
           $comment->save();                
           // History
           $comment->setHistory($user->getGuardUser());                        
       } 
       return $this;    
    }
    
    function setInTeamMembers($team_members)
    {
       /* if (in_array($this->get('assistant_id'),$team_members))
            $this->in_team_members=true;   */
        /*if (in_array($this->get('assistant_id'),$team_members))
            $this->in_team_members=true;  */ 
        $this->in_team_members=false;    
        return $this;
    }
    
    
    /*  Team ower */
    function isInTeamMembers()
    {
       return  $this->in_team_members;
    }

    function isChangedStateToSetAssistant()
    {      
        if (!$this->hasPropertyChanged('state_id'))
            return false;    
        $settings= CustomerMeetingSettings::load($this->getSite());               
        if ($settings->getStatus1ForAssistant() && $settings->getStatus1ForAssistant()->get('id')==$this->get('state_id'))
            return true;      
        if ($settings->getStatus2ForAssistant() && $settings->getStatus2ForAssistant()->get('id')==$this->get('state_id'))
            return true;  
        if ($settings->getStatus3ForAssistant() && $settings->getStatus3ForAssistant()->get('id')==$this->get('state_id'))
            return true;  
        return false;
    }
    
    function updateAssistant($user)
    {       
       $settings= CustomerMeetingSettings::load($this->getSite());     
       if ($settings->hasAssistant() && !$this->hasAssistant())
       {                  
            if ($user->hasCredential(array(array('meeting_view_states_for_user_as_assistant'))))
            {                         
                if ($this->isChangedStateToSetAssistant()) 
                {                                 
                    $this->set('assistant_id',$user->getGuardUser()); 
                }    
            } 
            elseif ($user->hasCredential(array(array('meeting_view_confirmed_for_user_as_assistant'))))
            {                      
                // libre d'assistant et confirmé
                if ($this->get('is_confirmed')=='YES' && $this->hasPropertyChanged('is_confirmed'))
                {    
                  $this->set('assistant_id',$user->getGuardUser());                 
                }  
            } 
            elseif ($user->hasGroups('assistant') || $user->hasCredential(array(array('meeting_view_assistant_as_user'))))
            {                         
                $this->set('assistant_id',$user->getGuardUser()); 
            }    
        }     
    }
    
    function getSettings()
    {
        if ($this->settings===null)
            $this->settings=CustomerMeetingSettings::load($this->getSite());
        return $this->settings;
    }
    
    function register()
    {        
        if (method_exists($this->getSettings()->get('registration_class','UtilsRegistration'),$this->getSettings()->get('registration_method','generateKeyForYear')))
        {
           $registration=call_user_func_array($this->getSettings()->getMethodForRegistration(),array('meetings',$this->getSettings()->get('registration_number_start')));           
           $this->set('registration',$registration->getFormatter()->render($this->getSettings()->get('registration_format','{year){month}{registration}')));
        }            
        return $this;
    }
    
    function getRegistration()
    {
        return new mfString($this->get('registration'));
    }
    
    function getProductSettings()
    {
        if ($this->product_settings===null)
        {
            $this->product_settings=ProductSettings::load($this->getSite());
        }   
        return $this->product_settings;
    }
    
    function getTurnover()
    {
        return floatval($this->get('turnover'));
    }
    
    function getFormattedTurnover()
    {        
        return format_currency($this->getTurnover(),$this->getProductSettings()->get('default_currency','EUR'));
    }
    
    function createDefaultProducts()
    {
         $products_by_default=ProductSettings::load($this->getSite())->getDefaultProductsById();
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$this->get('id')))                
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id')." FROM ".CustomerMeeting::getTable(). 
                           " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerMeeting::getTableField('id')."='{meeting_id}'".  
                                    " AND ".CustomerMeetingProduct::getTableField('id')." IS NULL".
                           ";")               
                ->makeSiteSqlQuery($this->getSite());
           //     echo $db->getQuery();
        if ($db->getNumRows())
        {
            $collection=new CustomerMeetingProductCollection(null,$this->getSite());
            while ($row=$db->fetchArray())
            {                                                   
                foreach ($products_by_default as $product_id)
                {
                    
                    $item=new CustomerMeetingProduct(null,$this->getSite());
                    $item->add(array('product_id'=>$product_id,'meeting_id'=>$row['id']));
                    $collection[]=$item;
                }  
            } 
            $collection->save();
        }     
        
        // add non existing products
          $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$this->get('id')))                
                ->setQuery("SELECT ".CustomerMeeting::getTableField('id').",".
                                 " GROUP_CONCAT(". CustomerMeetingProduct::getTableField('product_id')." SEPARATOR '|') as products".
                           " FROM ".CustomerMeeting::getTable(). 
                           " INNER JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id').
                           " WHERE ".CustomerMeeting::getTableField('id')."='{meeting_id}'".   
                           " GROUP BY ".CustomerMeeting::getTableField('id').
                           ";")               
                ->makeSiteSqlQuery($this->getSite()); 
         //   echo $db->getQuery();
        if (!$db->getNumRows())
            return ;   
        $collection=new CustomerMeetingProductCollection(null,$this->getSite());        
        while ($row=$db->fetchArray())
        {     
            $products= explode("|", $row['products']);                
            foreach ($products_by_default as $product_id)
            {
               if (in_array($product_id,$products))
                   continue;               
                $item=new CustomerMeetingProduct(null,$this->getSite());
                $item->add(array('product_id'=>$product_id,'meeting_id'=>$row['id']));
                $collection[]=$item;
            }   
        } 
        $collection->save();
        
         // Update status active
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array('meeting_id'=>$this->get('id')))                
                ->setQuery("UPDATE ".CustomerMeetingProduct::getTable()." SET status='ACTIVE'".
                           " WHERE ".CustomerMeetingProduct::getTableField('meeting_id')."='{meeting_id}'".                                      
                           ";")               
                ->makeSiteSqlQuery($this->getSite());    
    }
    
    
    function isOwner()
    {  
        $user=mfContext::getInstance()->getUser()->getGuardUser();
        if ($user->get('id')==$this->get('assistant_id'))
            return true;
        if ($user->get('id')==$this->get('telepro_id'))
            return true;
        if ($user->get('id')==$this->get('sales_id'))
            return true;
         if ($user->get('id')==$this->get('sale2_id'))
            return true;
        return false;
    }
    
    
    
    
    function isAuthorized()
    {            
        $user=mfContext::getInstance()->getUser();
        if ($user->hasCredential(array(array('superadmin','admin','meeting_owner'))) || !$user->hasCredential(array(array('meeting_list_owner'))))
        {                 
            return true;
        } 
        if ($this->isOwner())
        {           
            return true;
        }         
        if ($user->hasCredential(array(array('meeting_list_owner_free_assistant'))) && !$this->hasAssistant())
        {           
             return true;
        }     
         if ($user->hasCredential(array(array('meeting_list_owner_free_telepro'))) && !$this->hasTelepro())
           {            
             return true;
        } 
          if ($user->hasCredential(array(array('meeting_list_owner_free_sale1'))) && !$this->hasSale())
            {         
             return true;
        }      
           if ($user->hasCredential(array(array('meeting_list_owner_free_sale2'))) && !$this->hasSale2())
          {          
             return true;
        } 
        return false;
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
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new CustomerMeetingFormatter($this);
        }   
        return $this->formatter;
    }
    
     function hasOpcAt()
     {
         return (boolean)$this->get('opc_at');
     }
     
      function getOpcAt()
      {
          return new DayTime($this->get('opc_at'));
      }
      
      function hasInAt()
     {
         return (boolean)$this->get('in_at');
     }
     
       function getOpcAtDate()
     {
         return new Day($this->get('opc_at'));
     }  
     
     function hasOpcRange()
    {
        return (boolean)$this->get('opc_range_id') && $this->hasOpcAt();
    }
    
    function getOpcRange()
    {
       return $this->_opc_range_id=$this->_opc_range_id===null?new CustomerContractRange($this->get('opc_range_id'),$this->getSite()):$this->_opc_range_id;
    }
    
     function hasInAtRange()
    {
        return (boolean)$this->get('in_at_range_id') && $this->hasInAt();
    }
    
    function getInAtRange()
    {
       return $this->_in_at_range_id=$this->_in_at_range_id===null?new CustomerContractRange($this->get('in_at_range_id'),$this->getSite()):$this->_in_at_range_id;
    }
    
      function getOpcAtDayTime()
    {     
        return new Day((string)$this->getOpcAtDate()->getDate()." 00:00"); 
    }
    
      function hasCallbackAt()
    {
        return (boolean)$this->get('callback_at');
    }
    
    function isHold()
    {
        return $this->get('is_hold')=='YES';
    }
    
     function isUnHold()
    {
        return !$this->isHold();
    }
    
    function setHold()
    {
        $this->set('is_hold','YES');
        return $this;
    }
    
    function setUnHold()
    {
        $this->set('is_hold','NO');
        return $this;
    }
    
     function getInAtDayTime()
    {     
        return new Day((string)$this->getInAtDate()->getDate()." 00:00"); 
    }
    
      function getInAtDate()
     {
         return new Day($this->get('in_at'));
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
     
     
     function toArrayForTransfer()
     {
         $values=new mfArray();
         // values
         foreach (array('in_at','variables','callback_at','is_callback_cancelled',
                        'callback_cancel_at','is_qualified','sale_comments','confirmed_at','treated_at',
                        'registration','turnover','state_updated_at', 'opc_at',  'creation_at', 
                        'remarks','is_confirmed','created_at','updated_at') as $field)
         {
             $values[$field]=$this->get($field);
         }            
         // foreign keys
         foreach (array( 'customer_id'=>'getCustomer',
                         'state_id'=>'getStatus',
                         'sales_id'=>'getSale',
                         'sale2_id'=>'getSale2',
                         'telepro_id'=>'getTelepro',
                         'assistant_id'=>'getAssistant',  
                         'campaign_id'=>'getCampaign',
                         'callcenter_id'=>'getCallCenter',
                         'type_id'=>'getType',
                         'status_call_id'=>'getCallStatus',
                         'confirmator_id'=>'getConfirmator',
                         'status_lead_id'=>'getLeadStatus',
                         'created_by_id'=>'getCreatorUser',
                         'confirmed_by_id'=>'getConfirmator',  
                         'polluter_id'=>'getPolluter',     
                         'opc_range_id'=>'getOpcRange',                                                         
                 ) as $field=>$method)
         {        
             if (!$this->get($field))
                 continue;         
             $values[$field]=$this->$method()->toArrayForTransfer();
         }                 
         return $values;
     }
     
      function hasCompany()
    {
        return (boolean)$this->get('company_id');
    }
    
      function getCompany()
    {
        return $this->_company_id=$this->_company_id===null?new CustomerMeetingCompany($this->get('company_id'),$this->getSite()):$this->_company_id;
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
    
    
     function copy()
    {        
        $item=parent::copy();  
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('meeting_list_copy_new_customer'))))  
        {    
            $customer=$this->getCustomer()->copy()->save();
            $item->set('customer_id',$customer);        
            $address=$this->getCustomer()->getAddress()->copy();
            $address->set('customer_id',$customer)->save();
       }    
        $item->save();        
        return $item;
    }
    
    
     function copyProductsFrom(CustomerMeeting $source)
    {
       $products= new CustomerMeetingProductCollection(null, $this->getSite());
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('meeting_id'=>$source->get('id')))
                 ->setQuery("SELECT * FROM ".CustomerMeetingProduct::getTable().
                            " WHERE meeting_id='{meeting_id}' ".
                            " GROUP BY product_id".
                            ";")
                 ->makeSiteSqlQuery($this->getSite());  
        if (!$db->getNumRows())
          return $this;
       while ($item=$db->fetchObject('CustomerMeetingProduct'))
       {            
           $dst=new CustomerMeetingProduct(null,$this->getSite());
           $dst->copyFrom($item);
           $dst->set('meeting_id',$this);
           $products[]=$dst;
       } 
       $products->save();     
        return $this;
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
	
    function toArrayForApi($options)
    {
        if ($this->formatter_api===null)
        {
            $this->formatter_api=new CustomerMeetingItemFormatterApi($this,$options);
        }
        return $this->formatter_api;
    }
    
    function toArrayForApi2($options)
    {      
        return $this->formatter_api2=$this->formatter_api2===null?new CustomerMeetingItemFormatterApi2($this,$options):$this->formatter_api2;
    }
    
     static function DeleteMeetingsWithNoCustomer($site=null)
    {
         $db=mfSiteDatabase::getInstance()
            ->setParameters(array())
            ->setQuery("DELETE FROM ".self::getTable()." WHERE customer_id is null ;")
            ->makeSiteSqlQuery($site);    
         
       
    }        
    
}
