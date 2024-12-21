<?php

class MarketingLeadsWpFormsCollection extends mfObjectCollection2 {
    
    function __construct($data=null,$site=null) {        
        parent::__construct($data, null, $site);
    }
    
    function getUser()
    {
        return mfcontext::getInstance()->getUser();
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
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".$this->getWhereConditions().";")
           ->makeSiteSqlQuery($this->site); 
    }
    
    /* FOR TRANSFERT */
    function fillFromSelection($selection,$site=null)
    {
        $db = mfSiteDatabase::getInstance()->setParameters(array())
           ->setQuery("SELECT * FROM ".MarketingLeadsWpForms::getTable().
                      " WHERE ".MarketingLeadsWpForms::getTableField("id")." IN ('".implode("','", $selection)."')".
                      ";")
           ->makeSiteSqlQuery($site);
        
        if(!$db->getNumRows())
            return null;
        
        while($lead = $db->fetchObject('MarketingLeadsWpForms'))
            $this[] = $lead;
        
        return $this;
    }
    
    function processTransfer($site=null)
    {
        if($this->count()==0)
            return null;
        
        $conditions = new mfArray();
        $customers_old =  new CustomerCollection(null,$site);
        $customers_new =  new CustomerCollection(null,$site);
        $addresses = new CustomerAddressCollection(null,$site);
        $this->meetings = new CustomerMeetingCollection(null,$site);
        $settings = new MarketingLeadsWpSettings(null,$site);
        if (!$settings->hasDefaultSendedStatus()) {
            throw new RuntimeException(__("statut 'Sended' not exist."));
        }
        
        //if(mfcontext::getInstance()->getUser()->hasCredential(array(array('marketing_leads_app_mhpac')))) 
            $callcenters= Callcenter::createAndLoad($this->getUtmSources(),$site); // utm_source
       // $campaigns= CustomerMeetingCampaign::createAndLoad($this->getUtmCampaigns(),$site); // utm_campaign
        //
         if($this->getUser()->hasCredential(array(array('marketing_leads_transfert_zone')))) 
             $campaigns=CustomerMeetingCampaign::createAndLoad($this->getZones(),$site);         
         else
             $campaigns=CustomerMeetingCampaign::createAndLoad($this->getUtmCampaigns(),$site);                                           
       // var_dump($callcenters);
        //req sur les tél (les doublons)
        foreach($this as $index=>$lead){
            $condition = (empty($lead->get('phone'))?$lead->get('email'):$lead->get('phone'));
            if(!empty($condition) && !in_array($condition, $conditions->toArray()))
                $conditions[] = $condition;
        }
        
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array())
           ->setQuery("SELECT * FROM ".Customer::getTable().
                      " WHERE ".Customer::getTableField("phone")." IN ('".$conditions->implode("','")."')".
                      " OR ".Customer::getTableField("email")." IN ('".$conditions->implode("','")."')".
                      ";")
           ->makeSiteSqlQuery($site);
        //construct customers collection and addresses collection
        while($item = $db->fetchObject('Customer'))
            $customers_old[] = $item->setSite($site);
        
        foreach($this as $lead)
        {
            $key = (empty($lead->get('phone'))?$lead->get('email'):$lead->get('phone'));
            if($customers_old->getCustomerByPhoneOrEmail($key)===false&&$customers_new->getCustomerByPhoneOrEmail($key)===false)
            {   //$params = $lead->adoptToCustomerStructure();
                $customer = new Customer(null,$site);
                $customer->add($lead->adoptToCustomerStructure());
                $customers_new[]= $customer; 
                $address = new CustomerAddress($lead->adoptToCustomerAddressStructure(),$site);
                $address->set('customer_id',$customer);
                $addresses[] = $address;
            }
        }
        $customers_new->save();
        foreach($addresses as $address){
            $address->set('customer_id',$address->_customer_id);
            if ($this->getUser()->hasCredential([['marketing_leads_app_mhpac']]))
                $address->set(array('address1'=>$lead->get('utm_source'),'city'=>$lead->get('referrer')));                           
        }
        $addresses->save(); 
        //construct this->meetings collection
        foreach ($this as $index=>$lead)
        {
            $key = (empty($lead->get('phone'))?$lead->get('email'):$lead->get('phone'));
            $customer = ($customers_old->getCustomerByPhoneOrEmail($key)?$customers_old->getCustomerByPhoneOrEmail($key):$customers_new->getCustomerByPhoneOrEmail($key));
            $meeting = new CustomerMeeting(null,$site);
            if ($this->getUser()->hasCredential([['marketing_leads_app_mhpac']]))
            {
                $meeting->add(array('remarks'=>$lead->get('utm_campaign'),
                                'in_at'=>$lead->get('utm_medium').":00"
                                ));
            } 
            if($this->getUser()->hasCredential(array(array('marketing_leads_transfert_zone')))){
               $campaign= $campaigns->getItemByKey($lead->get('zone'));
            }else{
                $campaign=$campaigns->getItemByKey($lead->get('utm_campaign'));
            }
            $meeting->add(array('customer_id'=>$customer,
                                'remarks'=>'Transfered',
                                'campaign_id'=>$campaign,
                                'callcenter_id'=>$callcenters->getItemByKey($lead->get('utm_source')),
                                'state_id'=>$settings->getStatusForMeeting()));
            $meeting->set('lead_marketing',$lead);
            $this->meetings[$index] = $meeting;
        }
        $this->meetings->save();
        $this->meetings->loaded();
        foreach ($this as $lead) {
            $form_lead = new MarketingLeadsWpForms($lead->get('id'), $site);

            if ($form_lead->isNotLoaded()) {
                throw new mfException('Object not loaded properly.');
            }else {
                $form_lead->set('state_id', $settings->getSendedStatus()->get('id'));
                $form_lead->save();
            }
        }
        return $this->meetings;
    }
    
    /* END */
    
    /* CleanUp */
    function processCleanUp()
    {
        if($this->count()==0)
            return $this;
        
        //process les doublons
        $conditions = new mfArray();
        $settings = MarketingLeadsWpSettings::load($this->site);
        
        //req sur les tél (les doublons)
        foreach($this as $index=>$lead){
            $condition = $lead->get('phone');
            if(!empty($condition) && !$conditions->in($condition))
                $conditions[$condition] = $index;
        }
        
        $db = mfSiteDatabase::getInstance();
        $db->setParameters(array())
           ->setQuery("SELECT * FROM ". MarketingLeadsWpForms::getTable().
                      " WHERE ".MarketingLeadsWpForms::getTableField("phone")." IN ('".$conditions->fillByKeys()->implode("','")."')".
                      ";")
           ->makeSiteSqlQuery($this->site);
        //set is_duplicate to YES for the new leads
        while($item = $db->fetchObject('MarketingLeadsWpForms'))
        {
            if (isset($this[$conditions[$item->get('phone')]]))
                $this[$conditions[$item->get('phone')]]->set('is_duplicate','YES');
        }
        return $this;
    }
    /* END */
    
    public function createFromLeadsForMeetings(CustomerMeetingCollection $meetings)
    {
        $requests=new DomoprimeCustomerRequestCollection(null,$meetings->getSite());
        foreach($this as $key=>$lead)
        {
            $request = $lead->createFromLeadForMeeting($meetings[$key]);
            $requests[] = $request;
        }
        
        return $requests;
    }
    
    
    function getUtmSources()
    {
        if ($this->sources===null)
        {
            $this->sources=new mfArray() ;
            foreach ($this as $item)
            {
                if (isset($this->sources[$item->get('utm_source')]))
                    continue;
                $this->sources[$item->get('utm_source')]=$item->get('utm_source');
            }
        }
        return $this->sources;
    }
    
    
    function getUtmCampaigns()
    {
        if ($this->campaigns===null)
        {
            $this->campaigns=new mfArray() ;
            foreach ($this as $item)
            {
                 if (isset($this->campaigns[$item->get('utm_campaign')]))
                    continue;
                $this->campaigns[$item->get('utm_campaign')]=$item->get('utm_campaign');
            }
        }
        return $this->campaigns;
    }
    
    function getMediums()
    {
        if ($this->mediums===null)
        {
            $this->mediums=new mfArray() ;
            foreach ($this as $item)
            {
                if (isset($this->mediums[$item->get('utm_source')]))
                    continue;
                $this->mediums[$item->get('utm_source')]=$item->get('utm_source');
            }
        }
        return $this->mediums;
    }
    
    function getZones()
    {
        if ($this->zones===null)
        {
            $this->zones=new mfArray() ;
            foreach ($this as $item)
            {
                 if (isset($this->zones[$item->get('zone')]))
                    continue;
                $this->zones[$item->get('zone')]=$item->get('zone');
            }
        }
        return $this->zones;
    }
    
     function getMeetings()
    {
        return $this->meetings;
    }
    
    public function fillByStatus($site = null)
    {
        $settings = new MarketingLeadsWpSettings(null, $site);
        if (!$settings->hasDefaultStatus())
            return $this;
        $state = $settings->getDefaultStatus();       
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('state_id' => $state->get("id")))
            ->setQuery("SELECT ".MarketingLeadsWpForms::getFieldsAndKeyWithTable()." FROM " . MarketingLeadsWpForms::getTable() . 
                       " INNER JOIN " . MarketingLeadsWpFormsStatus::getTable() . " ON " . MarketingLeadsWpForms::getTableField('state_id') . " = " . MarketingLeadsWpFormsStatus::getTableField('id') . 
                       " WHERE " . MarketingLeadsWpFormsStatus::getTableField('id') . " = '{state_id}'".
                       ";")
            ->makeSiteSqlQuery($site);
        if (!$db->getNumRows())  
            return null;        
        while ($lead = $db->fetchObject('MarketingLeadsWpForms')) {
            $this[] = $lead;
        }
        return $this;
    }
}

