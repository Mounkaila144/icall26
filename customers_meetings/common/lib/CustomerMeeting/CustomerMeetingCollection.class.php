<?php


 
class CustomerMeetingCollection extends mfObjectCollection2 {
    
    protected $customers=null;
    
    function __construct($data=null,$site=null)
    {        
      parent::__construct($data,null,$site);
    }
    
    protected function executeSelectQuery($db)
    {
       $db->setParameters()
           ->setQuery("SELECT * FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       $db->setParameters()
          ->setQuery("DELETE FROM ".$this->getTable()." WHERE ".$this->getWhereConditions().";")
          ->makeSiteSqlQuery($this->site);   
    }            
    
    protected function executeInsertQuery($db)
    {
       $db->makeSiteSqlQuery($this->site);   
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".$this->getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site);   
    }
    
    protected function setStatus($status='ACTIVE')
    {
        foreach ($this->collection as $item)
        {
            $item->set('status',$status);
        }    
        $this->save();
    }
    
    
    function setStatusDelete()
    {
       
            $this->setStatus('DELETE');        
            return $this;
    }
    
     function setStatusActive()
    {
       
            $this->setStatus('ACTIVE');        
            return $this;
    }
       
    
    function copyCustomersToSite($site)
    {
        $customer_collection=new CustomerCollection(null,$site);
        foreach ($this->collection as $item)
        {
            if (isset($customer_collection[$item->getCustomer()->get('id')]))
                continue;
            $item_dst=new Customer(null,$site);
            $customer_collection[$item->getCustomer()->get('id')]=$item_dst->copyFrom($item->getCustomer(),array('created_at','updated_at'));         
        }    
        $customer_collection->save(); 
        $address_collection=new CustomerAddressCollection(null,$site);
        foreach ($this->collection as $item)
        {          
            $item_dst=new CustomerAddress(null,$site);
            $item_dst->copyFrom($item->getCustomer()->getAddress(),array('created_at','updated_at'));
            $item_dst->set('customer_id',$customer_collection[$item->getCustomer()->get('id')]);
            $address_collection[]=$item_dst;
        }
        $address_collection->save();
        $this->imported_customers=array();
        foreach ($customer_collection  as $src=>$customer)
            $this->imported_customers[$src]=$customer->get('id');       
    }
   
    function copyUsersToSite($site)
    {
       $users=array();      
       foreach ($this->collection as $item)
       {
           if ($item->hasAssistant() && !isset($users[$item->getAssistant()->getSignature()]))          
               $users[$item->getAssistant()->getSignature()]=$item->getAssistant();      
           if ($item->hasSale() && !isset($users[$item->getSale()->getSignature()]))          
               $users[$item->getSale()->getSignature()]=$item->getSale();                  
           if ($item->hasSale2() && !isset($users[$item->getSale2()->getSignature()]))          
               $users[$item->getSale2()->getSignature()]=$item->getSale2();   
           if ($item->hasTelepro() && !isset($users[$item->getTelepro()->getSignature()]))          
               $users[$item->getTelepro()->getSignature()]=$item->getTelepro();   
            if ($item->hasCreatorUser() && !isset($users[$item->getCreatorUser()->getSignature()]))          
               $users[$item->getCreatorUser()->getSignature()]=$item->getCreatorUser();            
       }      
       // Find user in DB destination 
       $user_conditions=array();
       foreach ($users as $user)  
       {    
          $user_conditions[]=" ((UPPER(firstname)='".strtoupper($user->get('firstname'))."'".
                             " AND UPPER(lastname)='".strtoupper($user->get('lastname'))."')".
                             " OR UPPER(email)='".strtoupper($user->get('email'))."' ".
                             ")";  
       }   
       $existing_users=array();
       $db=mfSiteDatabase::getInstance()                   
                         ->setQuery("SELECT * FROM ".User::getTable().                                   
                                    " WHERE ".implode(" OR ",$user_conditions).                                    
                                    ";")
                         ->makeSiteSqlQuery($site);      
        if ($db->getNumRows())
        {
            while ($item=$db->fetchObject('User'))            
            {                
                $existing_users[$item->getSignature()]=$item->setSite($site)->loaded();                            
            }    
        }                
        // Create users
        $users_collection=new UserCollection(null,'admin',$site);
        foreach ($users as $user)
        {                       
           if (array_key_exists($user->getSignature(),$existing_users))
               continue;
           $item=new User(null,'admin',$site);
           $users_collection[$user->getSignature()]=$item->copyFrom($user,array('created_at','updated_at'));
        }    
        $users_collection->save();                
        // build couple src => dst 
       $this->imported_users=array();     
       foreach ($users as $item)
       {         
          if (isset($existing_users[$item->getSignature()]))
          {    
             $this->imported_users[$item->get('id')]=$existing_users[$item->getSignature()]->get('id');          
          }   
          elseif (isset($users_collection[$item->getSignature()]))
          {    
             $this->imported_users[$item->get('id')]=$users_collection[$item->getSignature()]->get('id');          
          }  
          else
          {
            
          }    
       }       
    }
    
    function copyStateToSite($site)
    {
       $states=array();
       foreach ($this->collection as $item)
       {
           $key=$item->getStatus()->getCustomerMeetingStatusI18n()->get('value');
           if ($item->hasStatus() && !isset($states[$key]))           
               $states[$key]=$item->getStatus();          
       }  
       // states I18N
       $states_conditions=array();
       foreach ($states as $state)      
          $states_conditions[]=  $state->getCustomerMeetingStatusI18n()->get('value');
       $db=mfSiteDatabase::getInstance()                   
                         ->setQuery("SELECT * FROM ".CustomerMeetingStatusI18n::getTable().                                   
                                    " WHERE value COLLATE UTF8_GENERAL_CI IN('".implode("','",$states_conditions)."')".                                    
                                    ";")
                         ->makeSiteSqlQuery($site);  
        if ($db->getNumRows())
        {
            while ($item=$db->fetchObject('CustomerMeetingStatusI18n'))            
            {                
                $existing_states[$item->get('value')]=$item->get('status_id');                            
            }    
        }        
       // Create state
        $collection_state=new CustomerMeetingStatusCollection(null,$site);
        foreach ($states as $state)
        {
            $item=new CustomerMeetingStatus(null,$site);
            if (array_key_exists($state->getCustomerMeetingStatusI18n()->get('value'),$existing_states))
               continue;
           $item->copyFrom($state);
           $collection_state[$state->getCustomerMeetingStatusI18n()->get('value')]= $item;
        }    
        $collection_state->save();
        $collection_state_i18n=new CustomerMeetingStatusI18nCollection(null,$site);
        foreach ($collection_state as $key=>$state)
        {
            $item_i18n=new CustomerMeetingStatusI18n(null,$site);
            $item_i18n->copyFrom($states[$key]->getCustomerMeetingStatusI18n());  
            $item_i18n->set('status_id',$state->get('id'));
            $collection_state_i18n[]=$item_i18n;
        }    
        $collection_state_i18n->save();
        // build couple src => dst 
       $this->imported_states=array();
       foreach ($states as $state)
       {
          if (isset($existing_states[$state->getCustomerMeetingStatusI18n()->get('value')]))
             $this->imported_states[$state->get('id')]=$existing_states[$state->getCustomerMeetingStatusI18n()->get('value')];
          elseif (isset($collection_state[$state->getCustomerMeetingStatusI18n()->get('value')]))
             $this->imported_states[$state->get('id')]=$collection_state[$state->getCustomerMeetingStatusI18n()->get('value')]->get('id');
       }     
    }
    
    function copyToSite($site)
    {    
        // Recherche les clients par phone & mobile    
        $this->destination_collection=new CustomerMeetingCollection(null,$site);             
        $this->copyCustomersToSite($site);  // Customer
        $this->copyUsersToSite($site);      // User               
        $this->copyStateToSite($site);     // Status   
        // TODO
        // callcenter
        // status_lead_id
        // status_call_id
        // campaign_id
        // type_id    
        foreach ($this->collection as $meeting)
        {
           $dst_meeting=new CustomerMeeting(null,$site);
           if ($meeting->hasAssistant())          
              $dst_meeting->set('assistant_id',$this->imported_users[$meeting->get('assistant_id')]);
           if ($meeting->hasSale())          
              $dst_meeting->set('sales_id',$this->imported_users[$meeting->get('sales_id')]);            
           if ($meeting->hasSale2())          
              $dst_meeting->set('sale2_id',$this->imported_users[$meeting->get('sale2_id')]);
           if ($meeting->hasTelepro())          
              $dst_meeting->set('telepro_id',$this->imported_users[$meeting->get('telepro_id')]); 
           if ($meeting->hasCreatorUser())          
              $dst_meeting->set('created_by_id',$this->imported_users[$meeting->get('created_by_id')]); 
           if ($meeting->hasStatus())          
              $dst_meeting->set('state_id',$this->imported_states[$meeting->get('state_id')]); 
           $dst_meeting->set('customer_id',$this->imported_customers[$meeting->get('customer_id')]);                     
           foreach (array('in_at','callback_at','is_callback_cancelled','callback_cancel_at','is_qualified',
                          'confirmed_at','treated_at','remarks','is_confirmed','created_at',
                          'sale_comments','creation_at') as $field)
           {        
             $dst_meeting->set($field,$meeting->get($field));  
           }
           $this->destination_collection[$meeting->get('id')]=$dst_meeting;
        }    
        $this->destination_collection->save();       
       // => By Event :  Comments , Forms
    }
    
    function getDestinationCollection()
    {
        return $this->destination_collection;
    }
    
    function getTranslatorUsers()
    {
        return $this->imported_users;
    }
    
    function getUserTranslate($user_id)
    {
        return isset($this->imported_users[$user_id])?$this->imported_users[$user_id]:null;
    }
    
    function getMeetingTranslate($meeting_id)
    {
        return isset($this->destination_collection[$meeting_id])?$this->destination_collection[$meeting_id]->get('id'):null;
    }
       
    
    function getArrayKeys()
    {
        return new mfArray($this->getKeys());
    }
    
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new ProductSettings(null,$this->getSite()):$this->settings;
    }
    
    function createDefaultProducts()
    {                
        $collection=new CustomerMeetingProductCollection(null,$this->getSite());        
        foreach ($this as $meeting)
        {    
            foreach ($this->getSettings()->getDefaultProductsById() as $product_id)
            {
                    $item=new CustomerMeetingProduct(null,$this->getSite());
                    $item->add(array('product_id'=>$product_id,'meeting_id'=>$meeting));
                    $collection[]=$item;
            }    
        }
        $collection->save();
        return $this;
    }
    
    function clear()
    {
        $this->collection=array();
        return $this;
    }
}

