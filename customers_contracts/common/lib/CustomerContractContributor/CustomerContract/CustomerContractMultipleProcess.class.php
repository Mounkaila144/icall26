<?php

class CustomerContractMultipleProcess extends MultipleProcessCore {
   
    
    function process()
    {
        $query=array();
        $params=array('is_hold'=>'NO');              
         if (in_array('state',$this->getActions()))
        {
            $params['state_id']=$this->parameters['state_id'];
            $query[]=CustomerContract::getTableField("state_id")."='{state_id}'";
        }                  
        if (in_array('sms_customer',$this->getActions()))
        {
          // echo "<pre>"; var_dump($this->selection,$this->parameters); echo "<pre>";
           CustomerContractUtils::sendSmsModelMultipleContracts($this->getSelection(),new CustomerModelSmsI18n($this->parameters['sms_customer_model_id']),$this->getSite());
        }                
        if (in_array('products_by_default',$this->getActions()))
        {
            CustomerContractUtils::createDefaultProductsForMultipleContracts($this->getSelection(),$this->getSite());  
            $this->messages[]=__("Products have been created.");
        } 
        if (in_array('reference',$this->getActions()))
        {
            CustomerContractUtils::updateReferenceForMultipleContracts($this->parameters['reference'],$this->getSelection(),$this->getSite());  
            $this->messages[]=__("Reference have been updated.");
        } 
         if (in_array('assistant',$this->getActions()))
        {                       
            $params['assistant_id']=$this->parameters['assistant_id'];
            $query[]=CustomerContract::getTableField("assistant_id")."='{assistant_id}'";
            $this->messages[]=__("Assistants have been updated.");
            mfCacheFile::removeCache('users.assistant','admin',$this->getSite());         
        } 
        if (in_array('telepro',$this->getActions()))
        {                       
            $params['telepro_id']=$this->parameters['telepro_id'];
            $query[]=CustomerContract::getTableField("telepro_id")."='{telepro_id}'";
            $this->messages[]=__("Telepro have been updated.");
            mfCacheFile::removeCache('users.telepro','admin',$this->getSite());      
        } 
         if (in_array('sale1',$this->getActions()))
        {                       
            $params['sale_1_id']=$this->parameters['sale1_id'];
            $query[]=CustomerContract::getTableField("sale_1_id")."='{sale_1_id}'";
            $this->messages[]=__("Sales 1 have been updated.");
            mfCacheFile::removeCache('users.sale1','admin',$this->getSite());      
        } 
        if (in_array('sale2',$this->getActions()))
        {                       
            $params['sale_2_id']=$this->parameters['sale2_id'];
            $query[]=CustomerContract::getTableField("sale_2_id")."='{sale_2_id}'";
            $this->messages[]=__("Sales 2 have been updated.");
            mfCacheFile::removeCache('users.sale','admin',$this->getSite());      
        } 
        if (in_array('team_from_telepro',$this->getActions()))
        {                       
           CustomerContractUtils::updateTeamsFromTelepro($this->getSelection(),$this->getSite());
            $this->messages[]=__("Teams from telepro have been updated.");            
        } 
         if (in_array('polluter',$this->getActions()))
        {           
            $params['polluter_id']=$this->parameters['polluter_id'];
            $query[]=CustomerContract::getTableField("polluter_id")."='{polluter_id}'";
            $this->messages[]=__("Polluter has been updated.");
              mfCacheFile::removeCache('polluters','admin',$this->getSite());      
        }  
         if (in_array('remove_opc_at_date',$this->getActions()))
        {
            //$params['state_id']=$this->parameters['state_id'];
            $query[]=CustomerContract::getTableField("opc_at")."=NULL";
            $this->messages[]=__("Opc dates have been removed.");
        } 
         if (in_array('hold',$this->getActions()))
        {            
            $query[]=CustomerContract::getTableField("is_hold")."='YES'";
            $params['is_hold']='NO';
            $this->messages[]=__("Selection has been hold.");
        } 
         if (in_array('unhold',$this->getActions()))
        {            
            $query[]=CustomerContract::getTableField("is_hold")."='NO'";
            $params['is_hold']='YES';
            $this->messages[]=__("Selection has been unhold.");
        } 
         if (in_array('opc_at_range',$this->getActions()))
        {            
            CustomerContractUtils::updateRange($this->getSelection(),$this->getSite());
            $this->messages[]=__("Date/Time have been transformed to range.");
        } 
         if (in_array('financial_partner',$this->getActions()))
        {            
            $params['financial_partner_id']=$this->parameters['financial_partner_id'];
            $query[]=CustomerContract::getTableField("financial_partner_id")."='{financial_partner_id}'";
            $this->messages[]=__("Financial partner has been updated.");
            mfCacheFile::removeCache('contract_financial_partner','admin',$this->getSite());      
        } 
          if (in_array('opc_status',$this->getActions()))
        {            
            $params['opc_status_id']=$this->parameters['opc_status_id'];           
            $query[]=CustomerContract::getTableField("opc_status_id")."=".($this->parameters['opc_status_id']==null?"NULL":"'{opc_status_id}'");
            $this->messages[]=__("Opc status has been updated.");
            mfCacheFile::removeCache('contract_opc_status','admin',$this->getSite());      
        }    
        if (in_array('range_opc_at',$this->getActions()))
        {            
            $params['opc_at']=$this->parameters['opc_at'];     
            $params['opc_range_id']=$this->parameters['opc_range_id'];           
            $query[]=CustomerContract::getTableField("opc_range_id")."='{opc_range_id}'";
            $query[]=CustomerContract::getTableField("opc_at")."=".($this->parameters['opc_at']==null?"NULL":"'{opc_at}'");
            $this->messages[]=__("Opc date has been updated.");
            mfCacheFile::removeCache('contract_range.opc','admin',$this->getSite());      
        }  
        if (in_array('datetime_opc_at',$this->getActions()))
        {                  
            $params['opc_at']=$this->parameters['opc_at'];           
            $query[]=CustomerContract::getTableField("opc_at")."=".($this->parameters['opc_at']==null?"NULL":"'{opc_at}'");
            $this->messages[]=__("Opc date/time has been updated.");         
        }  
        if (in_array('date_opc_at',$this->getActions()))
        {                  
            $params['opc_at']=$this->parameters['opc_at'];           
            $query[]=CustomerContract::getTableField("opc_at")."=".($this->parameters['opc_at']==null?"NULL":"'{opc_at}'");
            $this->messages[]=__("Opc date has been updated.");
        }  
           if (in_array('opened_at',$this->getActions()))
        {            
            $params['opened_at']=$this->parameters['opened_at'];           
            $query[]=CustomerContract::getTableField("opened_at")."=".($this->parameters['opened_at']==null?"NULL":"'{opened_at}'");
            $this->messages[]=__("Contract date has been updated.");
        }  
          if (in_array('admin_status',$this->getActions()))
        {            
            $params['admin_status_id']=$this->parameters['admin_status_id'];           
            $query[]=CustomerContract::getTableField("admin_status_id")."=".($this->parameters['admin_status_id']==null?"NULL":"'{admin_status_id}'");
            $this->messages[]=__("Admin status has been updated.");
            mfCacheFile::removeCache('contract_admin_status','admin',$this->getSite());      
        }  
           if (in_array('sav_at_equal_opc_at',$this->getActions()))
        {                           
            $query[]=CustomerContract::getTableField("sav_at")."=".CustomerContract::getTableField("opc_at");
            $this->messages[]=__("AH Date = OPC date has been updated.");
        }  
            if (in_array('opc_at_equal_sav_at',$this->getActions()))
        {                           
            $query[]=CustomerContract::getTableField("opc_at")."=".CustomerContract::getTableField("sav_at");
            $this->messages[]=__("OPC date = AH Date has been updated.");
        }  
         if (in_array('meeting_sale2',$this->getActions()))
        {            
            CustomerContractUtils::updateSale2ForMeetings($this);
            $this->messages[]=__("Sale2 of meeting has been updated.");
        }     
        if (in_array('date_doc_at',$this->getActions()))
        {                  
            $params['doc_at']=$this->parameters['doc_at'];           
            $query[]=CustomerContract::getTableField("doc_at")."=".($this->parameters['doc_at']==null?"NULL":"'{doc_at}'");
            $this->messages[]=__("AH Date has been updated.");
        }  
          if (in_array('time_state',$this->getActions()))
        {            
            $params['time_state_id']=$this->parameters['time_state_id'];           
            $query[]=CustomerContract::getTableField("time_state_id")."=".($this->parameters['time_state_id']==null?"NULL":"'{time_state_id}'");
            $this->messages[]=__("Time state has been updated.");
        }  
          if (in_array('pre_meeting_at',$this->getActions()))
        {            
            $params['pre_meeting_at']=$this->parameters['pre_meeting_at'];           
            $query[]=CustomerContract::getTableField("pre_meeting_at")."=".($this->parameters['pre_meeting_at']==null?"NULL":"'{pre_meeting_at}'");
            $this->messages[]=__("Pre meeting date/hour has been updated.");
        }  
        
         if (in_array('generate_coordinates',$this->getActions()))
        {                       
            $messages=CustomerContractUtils::generateCoordinates($this->getSelection(),$this->getSite());
            $this->messages->merge($messages);
        } 
         if (in_array('status_delete',$this->getActions()))
        {                      
            $query[]=CustomerContract::getTableField("status")."='DELETE'";
            $this->messages[]=__("Status delete has been updated.");
        }
          if (in_array('status_active',$this->getActions()))
        {                      
            $query[]=CustomerContract::getTableField("status")."='ACTIVE'";
            $this->messages[]=__("Status active has been updated.");
        }
        if (in_array('install_state',$this->getActions()))
        {            
            $params['install_state_id']=$this->parameters['install_state_id'];           
            $query[]=CustomerContract::getTableField("install_state_id")."=".($this->parameters['install_state_id']==null?"NULL":"'{install_state_id}'");
            $this->messages[]=__('Install State has been updated.');
          //  mfCacheFile::removeCache('contract_install_states','admin',$this->getSite());      
        } 
        
      //  echo "<pre>"; var_dump($query,$params,$selection); echo "</pre>";
        if ($query)
        {           
           $db=mfSiteDatabase::getInstance()
                ->setParameters($params)                
                ->setQuery("UPDATE ".CustomerContract::getTable().
                           " SET ".implode(",",$query).
                           " WHERE id IN('".$this->getSelection()->implode("','")."')".
                           " AND is_hold='{is_hold}'".
                           ";")                        
                ->makeSiteSqlQuery($this->getSite()); 
       //    echo $db->getQuery();
        }  
        
        CustomerContractMultipleProcess::setCacheForContractMultipleUpdate($params,$this->getSite());
        return $this;
    }
    
    
    
    static function setCacheForContractMultipleUpdate($params,$site=null){
               
        foreach (array(
            'state_id'=>'contract_status',
            'financial_partner_id'=>'contract_financial_partner',
            'team_id'=>'users.teams',
            'telepro_id'=>'users',
            'sale_1_id'=>'users',
            'sale_2_id'=>'users',
            'manager_id'=>'users',
            'admin_status_id'=>'contract_admin_status',
            'opened_at_range_id'=>'contract_range',
            'sav_at_range_id'=>'contract_range',
            'partner_layer_id'=>'layers',
            'opc_status_id'=>'contract_opc_status',
            'polluter_id'=>'polluters',
            'callcenter_id'=>'callcenters',
            'install_state_id'=>'contract_install_states',
            'time_state_id'=>'contract_time_status', 
            'opc_range_id'=>'contract_range',
            'company_id'=>'contract_companies',
            'assistant_id'=>'users',
            'created_by_id'=>'users'
        ) as $name=>$cache)
        {
            if(!array_key_exists($name, $params))
                continue;
               // echo "Name=".$name."<br/>";
            mfCacheFile::removeCache($cache,'admin',$site);                
                 
        } 
    }
}

