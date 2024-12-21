<?php

class MarketingLeadsWpFormsBase extends mfObject2 {
    
    protected static $fields=array('id_wp','site_id','firstname','lastname','income','number_of_people','owner','energy',
                                   'phone','email','address','postcode','city','country','state','duplicate_wpf','zone',
                                   'is_duplicate','phone_status','state_id',
                                   'referrer','utm_source','utm_medium','utm_campaign',   
                                   'is_active','wp_created_at','created_at','updated_at','status');
    const table="t_marketing_leads_wp_forms"; 
    protected static $foreignKeys=array('site_id'=>'MarketingLeadsWpLandingPageSite',
                                        'state_id'=>'MarketingLeadsWpFormsStatus',
                                        ); // By default
    protected static $fieldsNull=array('updated_at','phone_status'); // By default
    
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
        $this->status=isset($this->status)?$this->status:"ACTIVE";
        $this->state=isset($this->state)?$this->state:"NEW";
        $this->country=isset($this->country)?$this->country:"FR";
        $this->is_active=isset($this->is_active)?$this->is_active:"YES";
        $this->number_of_people=isset($this->number_of_people)?$this->number_of_people:0;
        $this->duplicate_wpf=isset($this->duplicate_wpf)?$this->duplicate_wpf:"NO";
        $this->is_duplicate=isset($this->is_duplicate)?$this->is_duplicate:"NO";
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
//        $key_condition = ($this->getKey())?" AND id!=".$this->getKey():"";
//        $db->setParameters(array("firstname"=> $this->get("firstname"), "lastname"=> $this->get('lastname'), "email"=> $this->get('email'), 'site_id'=> $this->get('site_id')))
//           ->setQuery("SELECT * FROM ". MarketingLeadsWpForms::getTable().
//                      " WHERE ".MarketingLeadsWpForms::getTableField("firstname")."='{firstname}'".
//                      " AND ".MarketingLeadsWpForms::getTableField("lastname")."='{lastname}'".
//                      " AND ".MarketingLeadsWpForms::getTableField("email")."='{email}'".
//                      " AND ".MarketingLeadsWpForms::getTableField("site_id")."='{email}'".$key_condition.
//                      ";")
//           ->makeSiteSqlQuery($this->site);     
//        echo $db->getQuery()."<br />";
    }
    
    public function __toString()
    {      
        return (string) $this->firstname." ".$this->lastname;
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new MarketingLeadsWpFormsFormatter($this);
        }
        return $this->formatter;
    }
    
    function getSite()
    {
        if($this->_site_id==null)
            $this->_site_id = new MarketingLeadsWpLandingPageSite($this->get('site_id'), $this->site);
        return $this->_site_id;
    }
    
    function setSite(MarketingLeadsWpLandingPageSite $site)
    {
        $this->_site_id = $site;
        return $this;
    }
    
    function hasSite()
    {
        return (boolean) $this->_site_id;
    }
    
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','YES');
        $this->save();
    }
    
    function setOwner($owner)
    {
        $this->set('owner', $this->getOwnerStatus($owner));
        return $this;
    }
    
    function setEnergy($energy)
    {
        $this->set('energy', $this->getEnergyStatus($energy));
        return $this;
    }
    
    private function getOwnerStatus($status)
    {
        $status_array = array("Locataire"=>"tenant","locataire"=>"tenant","Propriétaire"=>"owner","propriétaire"=>"owner","Propriétaire non occupant"=>"non_occupant_owner","propriétaire non occupant"=>"non_occupant_owner");
        return $status_array[$status];
    }
    
    private function getEnergyStatus($status)
    {
        $status_array = array("Electricité"=>"electricity","électricité"=>"electricity","Combustible"=>"combustible","combustible"=>"combustible");
        return $status_array[$status];
    }
    
    /* FOR TRANSFERT */
     function adoptToCustomerStructure()
    {
        $contact_params = new mfArray();
        foreach(array('firstname'=>'firstname','lastname'=>'lastname','income'=>'salary','phone'=>'phone','email'=>'email') as $key=>$value)
        {
            $contact_params[$value] = $this->get($key);
        }
        $contact_params['mobile'] = $this->get('phone');
        return $contact_params;
    }
    
    function getCustomerFromLead()
    {
        $params = $this->adoptToCustomerStructure();
        $contract_params = empty($params['phone'])?array():array('phone'=>$params['phone']);
        $customer = new Customer($contract_params,$this->site);
        $customer->add($params);
        return $customer;        
    }
    
    function generateMeetingFromLead(CustomerMeetingStatus $status)
    {   
        $user= mfContext::getInstance()->getUser();
        $customer = $this->getCustomerFromLead()->save();          
        $customer->getAddress()->add($this->adoptToCustomerAddressStructure());
        
        if ($user->hasCredential([['marketing_leads_app_mhpac']]))
        {
            $customer->getAddress()->add(array('address1'=>$this->get('utm_source'),'city'=>$this->get('referrer')));
        }                
        $customer->getAddress()->save();      
        
        if ($user->hasCredential(array(array('marketing_leads_transfert_zone'))))
        {
             $campaign=new CustomerMeetingCampaign(array('name'=>$this->get('zone')),$this->site);  
             $campaign->save();             
        }
        else
        {
            $campaign = new CustomerMeetingCampaign(array('name'=>$this->get('utm_campaign')),$this->site);
        }    
        
        
        $meeting = new CustomerMeeting(null,$this->site);
        $meeting->add(array('customer_id'=>$customer, 
                            'remarks'=>'Transfered',
                            'campaign_id'=>$campaign,
                            'callcenter_id'=>new CallCenter(array('name'=>$this->get('utm_source')),$this->site),                            
                            'state_id'=>$status)); 
        if (mfContext::getInstance()->getUser()->hasCredential([['marketing_leads_app_mhpac']]))
        {
            $meeting->add(array('remarks'=>$this->get('utm_campaign'),
                                'in_at'=>$this->get('utm_medium').":00"
                                ));
        }                 
        return $meeting;
    }
    
    function adoptToCustomerAddressStructure()
    {
        $params = new mfArray();
        foreach (array('address1'=>'address','city','postcode','address2') as $name=>$value)
        {         
            $field = $this->get($value);
            if(($value=='address' || $value=='address2') && $field==='')
            {
                $field='Néant';
            }
            if($value=='city' && $field==='')
            {
                $field = ($this->get('zone')!=='')?$this->get('zone'):'Néant';
            }
            $params [(is_numeric($name)?$value:$name)] = $field;              
        } 
        return $params;
//        var_dump()
    }
    
    function adoptToCustomerMeetingFormsStructure()
    {
        //surface_mur,numberofpeople,energy,revenue,owner,surface_comble,surface_plancher
        $params = new mfArray();
        foreach (array('iso-numberofpeople'=>'number_of_people','iso-energy'=>'energy','iso-revenue'=>'income','iso-owner'=>'owner') as $name=>$value)
        {           
            $field = __($this->get($value));
            if($value=='iso-revenue' && $field==='')
            {
                $field=1;
            }
            $params[$name] = $field;              
        } 
      //  var_dump($params);
        return $params;
    }
    /* END */
        
    function setIsDuplicatWps($is_duplicate)
    {
        $this->set('duplicate_wpf', $this->getIsDuplicateWpf($is_duplicate));
        return $this;
    }
    
    private function getIsDuplicateWpf($is_duplicate)
    {
        if($is_duplicate)
            return "YES";
        elseif(!$is_duplicate)
            return "NO";
    }
    
    /* app_domoprime_iso form */
    function adoptToAppDomoprimeIsoFormStructure()
    {
        //'energy_id','revenue','number_of_people',//'energy_id'=>'energy',
        $params = new mfArray();
        foreach (array('number_of_people'=>'number_of_people','revenue'=>'income') as $name=>$value)
        {           
            $field = __($this->get($value));
            if($value=='income')
            {
                if($field==='' || $field==0)
                    $field=50;
            }
            $params[$name] = $field;              
        } 
        return $params;
    }
    
    function createFromLeadForMeeting(CustomerMeeting $meeting)
    {
        $request = new DomoprimeCustomerRequest($meeting,$meeting->getSite());     
        //fill request for meeting 
        $request->add($this->adoptToAppDomoprimeIsoFormStructure());
        $request->set('meeting_id',$meeting);   
        $request->set('customer_id',$meeting->getCustomer());   
        
        //create or get the energy object
        if($this->get('energy')!=='') {
            $energy_i18n = new DomoprimeEnergyI18n(array('value'=>__(ucfirst($this->get('energy')))));
            if($energy_i18n->isNotLoaded()){
                $energy = new DomoprimeEnergy($this->get('energy'),$meeting->getSite());
                $energy->save();
                $energy_i18n->set('energy_id',$energy)->save();
            }
            $request->set('energy_id',$energy_i18n->getEnergy());
        }
        return $request;
    }
    
    function hasStatus()
    {
        return (boolean) $this->get('state_id');
    }
    
    function getStatus()
    {
        if($this->_state_id===null)
        {
            $this->_state_id = new MarketingLeadsWpFormsStatus($this->get('state_id'),$this->site);
        }
        
        return $this->_state_id;
    }
    
    function setStatus(MarketingLeadsWpFormsStatus $status)
    {
        $this->_status_id = $status;
        return $this;
    }
}