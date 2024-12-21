<?php

class CustomerMeetingsFormFilter2 extends mfFormFilterBase {

    protected $language=null,$user=null,$objects=null,$conditions=null,$joins=array();
    
    function __construct($user,$defaults=array())
    {                      
       $this->user = $user;
       $this->language = $user->getCountry();
       $this->_query = new mfQuery();
       $this->conditions = new ConditionsQuery(); 
       $this->settings = CustomerMeetingSettings::load();    
       $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));
       $this->alias = new mfArray();
       $this->objects = new mfArray();
       parent::__construct($defaults);      
    }   
    
    function getAlias()
    {
        return $this->alias;
    }   
    
    function getMfQuery()
    {
        return $this->_query;
    }
    
    function getLanguage()
    {
      return $this->language;    
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    function __getQuery()
    {
        return $this->query;
    }
    
    function setCredentials()
    {              
       if ($this->getUser()->hasCredential(array(array('filter_meeting_telepro','filter_meeting_telepro_list')))) 
       {                  
           $this->conditions->setWhere(CustomerMeeting::getTableField('telepro_id')."='{user_id}' ".
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'");           
       }            
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_commercial','filter_meeting_commercial_list'))))   
       {                  
           $this->conditions->setWhere("(".CustomerMeeting::getTableField('sales_id')."='{user_id}' OR ".
                                       CustomerMeeting::getTableField('sale2_id')."='{user_id}'".
                                       ")".
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'"
                                      );          
       }     
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_telepro_manager','filter_meeting_telepro_manager_list'))))
       {              
           $team_users=$this->getUser()->getGuardUser()->getTeamUsers();                
            $condition=$team_users->isEmpty()?" IS NULL":" IN('".$team_users->getKeys()->implode("','")."')";         
           $this->conditions->setWhere("(".CustomerMeeting::getTableField('telepro_id').$condition." OR ".
                                          CustomerMeeting::getTableField('assistant_id').$condition.")".
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'");                            
       } 
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_sales_manager','filter_meeting_sales_manager_list'))))
       {       
            $team_users=$this->getUser()->getGuardUser()->getTeamUsers();                
            $condition=$team_users->isEmpty()?" IS NULL":" IN('".$team_users->getKeys()->implode("','")."')";               
            $this->conditions->setWhere(
                    "(".CustomerMeeting::getTableField('telepro_id').$condition." OR ".
                        CustomerMeeting::getTableField('sales_id').$condition." OR ".
                        CustomerMeeting::getTableField('sale2_id').$condition.
                    ")".
                    " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'"
                                      );    
       }    
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_meeting_assistant','filter_meeting_assistant_list'))))
       {
           $this->conditions->setWhere("(".CustomerMeeting::getTableField('assistant_id')."='{user_id}' ".
                                       " OR ".CustomerMeeting::getTableField('assistant_id')."=0 ) ".
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE' "
                                      );
       }
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_meeting_assistant_owner'))))
       {
           $this->conditions->setWhere("(".CustomerMeeting::getTableField('assistant_id')."='{user_id}' ".                                     
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE' )"
                                      );
       }
       elseif ($this->getSettings()->hasCallcenter() && $this->getUser()->hasCredential(array(array('filter_meeting_callcenter','filter_meeting_callcenter_list'))) && $this->getUser()->getGuardUser()->hasCallcenter()) 
       {                               
           $this->conditions->setWhere(CustomerMeeting::getTableField('callcenter_id')."=".$this->getUser()->getGuardUser()->get('callcenter_id').
                                        " AND ".CustomerMeeting::getTableField('status')."='ACTIVE'");           
       } 
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_list_confirmed_telepro')))) 
       {             
           $this->conditions->setWhere("((".CustomerMeeting::getTableField('is_confirmed')."='YES' AND ".CustomerMeeting::getTableField('status')."='ACTIVE') OR ".
                                            CustomerMeeting::getTableField('telepro_id')."='{user_id}')"
                                      );           
       } 
       elseif ($this->getUser()->hasCredential(array(array('filter_meeting_list_telepro_of_team')))) 
       {             
           $team_users=$this->getUser()->getGuardUser()->getUsersOfMyTeams();                                              
           $this->conditions->setWhere("(".CustomerMeeting::getTableField('telepro_id')." IN('".$team_users->getKeys()->implode("','")."') ".
                                       " AND ".CustomerMeeting::getTableField('status')."='ACTIVE')");                    
       }         
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meetings.filter.credentials'));                 
       if ($this->getUser()->hasCredential(array(array('filter_meeting_list_creator')))) 
       {                     
           $this->conditions->setWhere(CustomerMeeting::getTableField('created_by_id')."='{user_id}' ","OR");                    
       }
    }
    
    
    function configure()
    {              
      // $this->getAlias()->merge(array('telepro'=>'telepro','sale'=>'sale','sale2'=>'sale2','creator'=>'creator')) ;                
      // $this->getAlias()->set('assistant','assistant');      
              
       $cols=array('id','date','customer','phone','postcode','city','is_confirmed');      
     //  echo "<pre>"; var_dump($this->getUser()->getCredentials()); echo "</pre>";             
       if (!$this->getUser()->hasCredential([['superadmin','admin','meeting_all']]))
       {        
          $this->setCredentials();
       }       
    //   var_dump($this->getUser()->getGuardUser()->getTeamTeleproUsers());
   //    var_dump($this->conditions->debug());
       $this->objects=new mfArray(array('CustomerMeeting',
                            'Customer','CustomerAddress',
                            /*'CustomerMeetingStatus',
                            'CustomerMeetingStatusI18n',                             
                            'assistant'=>'User',
                            'Callcenter',
                            'telepro'=>'User','creator'=>'User',
                            'sale'=>'User','sale2'=>'User'*/));        
       $this->addDefaults(array(               
            'order'=>array(
                            "in_at"=>"asc",                            
            ), 
            'equal'=>array( 'status'=>'ACTIVE'
            ),
            'range'=>array(                 
            ),
            'nbitemsbypage'=>$this->getSettings()->get('filter_numberofitems_by_page',100),          
            'cols'=>$cols,
       ));    
       
       if (!$this->getUser()->hasCredential(array(array('superadmin','filter_meeting_no_default_range_in_at'))))
       {    
          $this->setDefault('range', array("in_at"=>array("from"=>date("Y-m-d")." 00:00:00",
                                                          "to"=>date("Y-m-d")." 23:59:59")));
       }         
       if ($this->getUser()->hasCredential(array(array('superadmin','admin'))))
       {    
          $this->setDefault('equal', array("status"=>"ACTIVE"));
       } 
        if ($this->getSettings()->hasCampaign())
       {          
          // $this->objects[]='CustomerMeetingCampaign';          
       }                     
       if ($this->getSettings()->hasPolluter() && mfModule::isModuleInstalled('partners_polluter'))
       {           
          // $this->objects[]='PartnerPolluterCompany';
          // $polluter_query=" LEFT JOIN ".CustomerMeeting::getOuterForJoin('polluter_id');
         //  $this->_query->left(CustomerMeeting::getOuterForJoin('polluter_id'));
       }       
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_list_opc_range'))))
       {                      
         //  $this->objects[]='CustomerContractRange';
         //  $this->objects[]='CustomerContractRangeI18n';    
        //   $range_query=" LEFT JOIN ".CustomerMeeting::getOuterForJoin('opc_range_id').
          //              " LEFT JOIN ".CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'";        
          //   $this->_query->left( CustomerMeeting::getOuterForJoin('opc_range_id'))
         //                 ->left(CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'");
       } 
        if ($this->getSettings()->hasPartnerLayer() && $this->getUser()->hasCredential(array(array('superadmin','meeting_list_partner_layer'))))
       {                    
          // $this->objects[]='PartnerLayerCompany';            
           //$layer_query=" LEFT JOIN ".CustomerMeeting::getOuterForJoin('partner_layer_id');   
          // $this->_query->left(CustomerMeeting::getOuterForJoin('partner_layer_id'));   
       }  
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_list_meeting_company'))))
       {    
         // $this->objects[]='CustomerContractCompany';                    
        //  $company_query=" LEFT JOIN ".CustomerMeeting::getOuterForJoin('company_id');  
        //  $this->_query->left(CustomerMeeting::getOuterForJoin('company_id'));   
       }       
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_list_contract_exists'))) && $this->getDefault('has_contract')=='true')
       {                            
          //$contract_query="LEFT JOIN ".CustomerCOntract::getInnerForJoin('meeting_id');
         // $this->_query->left(CustomerCOntract::getInnerForJoin('meeting_id'));
       }         
       $this->setClass('CustomerMeeting');
     //  $this->setExcludeFields(array('team_id'));
       $this->setFields(array('lastname'=>'Customer',
                               'mobile'=>'Customer',                               
                                'postcode'=>'CustomerAddress',                                
                                'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'".
                                                 ")")
                                ),
                                'phone'=>array('class'=>'Customer',
                                             'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('phone')." LIKE '%%{phone}%%' OR ".
                                                 Customer::getTableField('mobile')." LIKE '%%{phone}%%'".
                                                 ")")
                                            ),
                              'callcenter'=>array('class'=>'Callcenter','field'=>"name"),
                              'team_id'=>null,
                              'has_mobile'=>null,                                                      
                              'product_id'=>array('class'=>'CustomerMeetingProduct','field'=>'id' ),
                           //   'state_id'=>array('class'=>'CustomerMeetingStatus','field'=>'id'                                               
                           //             ),
                              'state'=>array('class'=>'CustomerMeetingStatusI18n','field'=>'value'),
                              'status_call'=>array('class'=>'CustomerMeetingStatusCallI18n','field'=>'value'),
                              'city'=>array('class'=>'CustomerAddress',
                                            'search'=>array('conditions'=>CustomerAddress::getTableField('city')." COLLATE UTF8_GENERAL_CI LIKE '%%{city}%%'")
                                           ),
                              'query'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%' OR ".
                                                 Customer::getTableField('phone')." LIKE '%%{query}%%' OR ".
                                                 Customer::getTableField('mobile')." LIKE '%%{query}%%' OR ".
                                                 Customer::getTableField('mobile2')." LIKE '%%{query}%%' OR ".
                                                 Customer::getTableField('company')." LIKE '%%{query}%%' OR ".
                                                 CustomerMeeting::getTableField('turnover')." LIKE '%%{query}%%' OR ".
                                                 CustomerAddress::getTableField('city')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%' OR ".
                                                 CustomerAddress::getTableField('address1')." COLLATE UTF8_GENERAL_CI LIKE '%%{query}%%'".
                                                 ")")
                              ),
                              'meeting_id'=>'CustomerContract'
                            ));      
      /* $this->setQuery("SELECT {fields} FROM ".CustomerMeeting::getTable().                         
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').                
                       " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id','sale2'). 
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('created_by_id','creator').     
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').                       
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('campaign_id').
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').   
                       " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id'). " AND ".CustomerMeetingProduct::getTableField('status')."='ACTIVE'".
                       " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_lead_id'). 
                       " LEFT JOIN ".CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusLeadI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".CustomerMeeting::getOuterForJoin('type_id'). 
                       " LEFT JOIN ".CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND ".CustomerMeetingTypeI18n::getTableField('lang')."='{lang}'".
                       " LEFT JOIN ".UserTeamUsers::getTable()." ON ".UserTeamUsers::getTableField('user_id')."=".CustomerMeeting::getTableField('telepro_id').
                       " LEFT JOIN ".UserTeamUsers::getOuterForJoin('team_id').   
                       $polluter_query.
                       $range_query.
                       $layer_query.
                       $contract_query.
                       $company_query.
                       $this->conditions->getWhere(). 
                       " GROUP BY ".CustomerMeeting::getTableField('id').
                       ";");  */
       
       
       $this->_query->select("{fields}")
                    ->from(CustomerMeeting::getTable())
                    ->left(CustomerMeeting::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
//                    ->left(CustomerMeeting::getOuterForJoin('telepro_id','telepro'))
//                    ->left(CustomerMeeting::getOuterForJoin('sales_id','sale'))
//                    ->left(CustomerMeeting::getOuterForJoin('sale2_id','sale2'))  
//                    ->left(CustomerMeeting::getOuterForJoin('assistant_id','assistant'))               
//                    ->left(CustomerMeeting::getOuterForJoin('created_by_id','creator'))     
//                    ->left(CustomerMeeting::getOuterForJoin('campaign_id'))    
//                    ->left(CustomerMeeting::getOuterForJoin('callcenter_id'))    
//                    ->left(CustomerMeeting::getOuterForJoin('state_id'))                            
//                    ->left(CustomerMeetingProduct::getInnerForJoin('meeting_id'). " AND ".CustomerMeetingProduct::getTableField('status')."='ACTIVE'")
//                    ->left(CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'")
//                    ->left(CustomerMeeting::getOuterForJoin('status_call_id')) 
//                    ->left(CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'")
//                    ->left(CustomerMeeting::getOuterForJoin('status_lead_id'))
//                    ->left(CustomerMeetingStatusLeadI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusLeadI18n::getTableField('lang')."='{lang}'")
//                    ->left(CustomerMeeting::getOuterForJoin('type_id'))
//                    ->left(CustomerMeetingTypeI18n::getInnerForJoin('type_id')." AND ".CustomerMeetingTypeI18n::getTableField('lang')."='{lang}'")
//                    ->left(UserTeamUsers::getTable()." ON ".UserTeamUsers::getTableField('user_id')."=".CustomerMeeting::getTableField('telepro_id'))
//                    ->left(UserTeamUsers::getOuterForJoin('team_id'))                   
                    ->where($this->conditions->getWhere(""))
                    ->groupBy(CustomerMeeting::getTableField('id'));
                 
              
       // Validators            
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                        "in_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "state"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "status_call"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                        "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                        "city"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                        "callcenter"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                                                        "turnover"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false))
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "id"=>new mfValidatorString(array("required"=>false)),                            
                             "lastname"=>new mfValidatorString(array("required"=>false)),  
                             "phone"=>new mfValidatorString(array("required"=>false)),                            
                             "city"=>new mfValidatorString(array("required"=>false)),  
                             "query"=>new mfValidatorString(array("required"=>false)),  
                            ),array("required"=>false)), 
          /* 'begin' => new mfValidatorSchema(array(                                
                             "postcode"=>new mfValidatorString(array("required"=>false)),                                                                          
                            ),array("required"=>false)), */
            'begin'=>new mfValidatorSchema(array(                                
                             "postcode"=>new mfValidatorMultiple(new mfValidatorString(array("required"=>false)),array("required"=>false)),                                                                          
                            ),array("required"=>false)), 
            'range' => new mfValidatorSchema(array(                             
                              "in_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                              "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),
                              "treated_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)), 
                              "creation_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                           
                              "callback_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),      
                            ),array("required"=>false)),    
            'in'=>new mfValidatorSchema(array( 
                         'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getTeleproUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'sales_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getSalesUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),                        
                         'sale2_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getSalesUsers2($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'team_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getTeams($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),
                         'state_id'=>new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(                              
                              "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getTeleproUsersForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),          
                              "sales_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsersForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                              "team_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("No team"))+CustomerMeetingUtils::getTeamsForSelect($this->getConditions()),"key"=>true,"required"=>false)),                                           
                              "sale2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getSalesUsers2ForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                              "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("-- Not affected --"))+CustomerMeetingUtils::getStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)),
                              "is_confirmed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"YES","NO"=>"NO"),"key"=>true,"required"=>false)),                                      
                              "product_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__('No product'))+CustomerMeetingUtils::getProductsForSelect('meta_title',$this->getConditions()),"key"=>true,"required"=>false)),
                              "mobile"=>new mfValidatorChoice(array("choices"=>array("IS_NOT_EMPTY"),"required"=>false)),                                      
                              "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)),                              
                              "meeting_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("Empty")),"key"=>true,"required"=>false)),                              
                            ),array("required"=>false)), 
            'sizes' => new mfValidatorSchema(array(                                                                                   
                            ),array("required"=>false)),
            'date_rdv'=>new mfValidatorBoolean(),         
            'has_mobile'=>new mfValidatorBoolean(),  
            'has_no_product'=>new mfValidatorBoolean(),  
            'cols'=>new mfValidatorChoice(array("choices"=>$cols,'multiple'=>true,'required'=>false,'empty_value'=>array())),
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","30"=>"30","50"=>"50","100"=>"100"),"key"=>true)),                    
        ));    
       
       if ($this->getSettings()->hasTreatedDate() && $this->getUser()->hasCredential(array(array('superadmin','admin','meeting_filter_options_date_treated'))))      
           $this->setValidator('date_treated', new mfValidatorBoolean());       
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_filter_options_date_creation'))))       
           $this->setValidator('date_creation', new mfValidatorBoolean());       
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_filter_options_date_callback'))))       
           $this->setValidator('date_callback', new mfValidatorBoolean());            
       foreach (array('customer','date','phone','mobile','postcode','city') as $cols)
       {
           $this->sizes->addValidator($cols,new mfValidatorInteger(array("required"=>false)));
       }    
       if ($this->getUser()->hasGroups('telepro') || $this->getUser()->hasCredential(array(array('filter_meeting_telepro','filter_meeting_telepro_list'))))
       {    
         unset($this->in['telepro_id'],$this->equal['telepro_id'],$this->in['team_id']);
       } 
       elseif ($this->getUser()->hasGroups(array('sales_manager','telepro_manager')) || $this->getUser()->hasCredential(array(array('filter_meeting_telepro_manager','filter_meeting_telepro_manager_list','filter_meeting_sales_manager','filter_meeting_sales_manager_list'))))
       {
          unset($this->in['team_id']);  
       }  
       if ($this->getUser()->hasCredential(array(array('superadmin','admin'))))
       {        
         $this->setValidator("status",new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)));
       }
       if ($this->getSettings()->hasAssistant() && (!$this->getUser()->hasGroups('assistant') || $this->getUser()->hasCredential(array(array('meeting_view_list_assistant')))))
       {
           $this->equal->addValidator("assistant_id",new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getAssistantUsersForSelect2($this->getConditions(),$this->getUSer()),"key"=>true,"required"=>false)));
           $this->in->addValidator('assistant_id',new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getAssistantUsers($this->getConditions(),$this->getUSer()),'multiple'=>true,'key'=>true,'required'=>false)));
       }    
       if ($this->getSettings()->hasCampaign())
       {
           $this->equal->addValidator("campaign_id",new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerMeetingUtils::getCampaignsForSelect($this->getConditions()),"key"=>true,"required"=>false)));
           $this->in->addValidator('campaign_id',new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getCampaigns($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));                               
       } 
        if ($this->getSettings()->hasCallcenter() && !$this->getUser()->getGuardUser()->hasCallcenter())
       {
           $this->equal->addValidator("callcenter_id",new mfValidatorChoice(array("choices"=>array(""=>"")+Callcenter::getCallcentersForSelect($this->getConditions()),"key"=>true,"required"=>false)));
           $this->in->addValidator('callcenter_id',new mfValidatorChoice(array("choices"=>Callcenter::getCallcenters($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));                     
       } 
       if ($this->getSettings()->hasQualification())
       {
          $this->equal->addValidator("is_qualified",new mfValidatorChoice(array("choices"=>array(""=>"","NO"=>__("NO"),"YES"=>__("YES")),"key"=>true,"required"=>false)));
       }
       if ($this->getSettings()->hasCallStatus())
       {
          $this->equal->addValidator("status_call_id",new mfValidatorChoice(array("choices"=>array(""=>"","0"=>__("-- Not affected --"))+CustomerMeetingUtils::getCallStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)));
          $this->in->addValidator('status_call_id',new mfValidatorChoice(array("choices"=>CustomerMeetingStatusCall::getStatusI18nForSelect($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));          
        //  $this->objects[]='CustomerMeetingStatusCall';
        //  $this->objects[]='CustomerMeetingStatusCallI18n';
       }
        if ($this->getSettings()->hasLeadStatus())
       {
          $this->equal->addValidator("status_lead_id",new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("-- Not affected --"))+CustomerMeetingUtils::getLeadStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)));
          $this->in->addValidator('status_lead_id',new mfValidatorChoice(array("choices"=>CustomerMeetingStatusLead::getStatusI18nForSelect($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));          
        //  $this->objects[]='CustomerMeetingStatusLead';
        //  $this->objects[]='CustomerMeetingStatusLeadI18n';
       }
       if ($this->getSettings()->hasType())
       {
          $this->equal->addValidator("type_id",new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("-- Not affected --"))+CustomerMeetingUtils::getTypeForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)));
          $this->in->addValidator('type_id',new mfValidatorChoice(array("choices"=>CustomerMeetingType::getTypesI18nForSelect($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));          
        // $this->objects[]='CustomerMeetingType';
         // $this->objects[]='CustomerMeetingTypeI18n';
       }
        if ($this->getSettings()->hasConfirmedAt())
        {       
            $this->range->addValidator("confirmed_at",new mfValidatorI18nDateRangeCompare(array("required"=>false)));
            if ($this->getUser()->hasCredential(array(array('superadmin','admin','meeting_filter_options_date_confirmed'))))       
                $this->setValidator('date_confirmed', new mfValidatorBoolean());  
        }  
        if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','meeting_view_list_polluter'))))
        {
             if ($this->getUser()->hasCredential(array(array('meeting_list_equal_polluter_with_username'))))
                 $this->equal->addValidator("polluter_id",new mfValidatorChoice(array("choices"=>array(''=>"",'IS_NULL'=>__('----'))+CustomerMeetingUtils::getPollutersForSelect2($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
             else
                 $this->equal->addValidator("polluter_id",new mfValidatorChoice(array("choices"=>array(""=>"",'IS_NULL'=>__('Not defined'))+CustomerMeetingUtils::getPollutersForSelect2($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
            $this->in->addValidator('polluter_id',new mfValidatorChoice(array("choices"=>array('IS_NULL'=>__('Not defined'))+CustomerMeetingUtils::getPolluters($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
        }  
        if ($this->getUser()->hasCredential(array(array('superadmin','meeting_list_opc_range'))))
       {                    
           $this->equal->addValidator('opc_range_id',new mfValidatorChoice(array("choices"=>array(''=>"",'IS_NULL'=>__('----'))+CustomerMeetingUtils::getOpcRangeForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
           $this->in->addValidator('opc_range_id',new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getOpcRanges($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
       } 
        if ($this->getSettings()->hasPartnerLayer() && $this->getUser()->hasCredential(array(array('superadmin','meeting_list_partner_layer'))))
       {                    
           $this->equal->addValidator("partner_layer_id",new mfValidatorChoice(array("choices"=>array(''=>"",'0'=>__('----'))+CustomerMeetingUtils::getLayersForSelect($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
           $this->in->addValidator('partner_layer_id',new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getLayers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','meeting_list_contract_exists'))))
       {                    
           $this->setValidator('has_contract', new mfValidatorBoolean());        
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','meeting_list_meeting_company'))))
       {                    
           $this->equal->addValidator("company_id",new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerMeetingUtils::getCompaniesForSelect($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
           $this->in->addValidator('company_id',new mfValidatorChoice(array("choices"=>CustomerMeetingUtils::getCompanies($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
       
     /*  if ($this->getSettings()->hasCallcenter() && $this->getUser()->getGuardUser()->hasCallcenter())
       {
          unset($this->in['state_id'],$this->equal['state_id']);
       }  */  
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meeting.filter2.config'));  
       $this->setQuery((string)$this->_query);
    }
    
    function getObjectsForPager()
    {
        return $this->objects;
    }
    
    function addObject($object)
    {
        $this->objects[]=$object;
        return $this;
    }
    function hasObject($name)
    {             
        return in_array($name,$this->objects);
    }      
    
    function hasColumn($name)
    {
        return in_array($name,(array)$this['cols']->getValue());
    }
    
     function getConditions()
    {               
        return $this->conditions;
    }
   
      
    function setTimeForDate($name)
    {
        if ($this->values['range'][$name]['to'])
        {    
          $this->values['range'][$name]['to'].=" 23:59:59";              
        }
        if ($this->values['range'][$name]['from'])
        {
           $this->values['range'][$name]['from'].=" 00:00:00";    
        }  
    }
     
    function getDateFilter($name)
    {      
        if ($this['date_rdv']->getValue())
            return $this['range']['created_at'][$name]->getValue();
        if ($this->hasValidator('date_treated') && $this['date_treated']->getValue())
            return $this['range']['treated_at'][$name]->getValue();
        if ($this->hasValidator('date_creation') && $this['date_creation']->getValue())              
            return $this['range']['creation_at'][$name]->getValue();    
        if ($this->hasValidator('date_confirmed') && $this['date_confirmed']->getValue())              
            return $this['range']['confirmed_at'][$name]->getValue(); 
        if ($this->hasValidator('date_callback') && $this['date_callback']->getValue())              
            return $this['range']['callback_at'][$name]->getValue(); 
        return $this['range']['in_at'][$name]->getValue();       
    }
    
    function getQuery()
    {              
        if ($this->query_valid)
            return $this->query;
       if ($this['date_rdv']->getValue())
       {                
           $this->values['range']['created_at']=$this->values['range']['in_at'];        
           unset($this->values['range']['in_at']);
           $this->setTimeForDate('created_at');        
       }   
       elseif ($this->hasValidator('date_treated') && $this['date_treated']->getValue())
       {      
           $this->values['range']['treated_at']=$this->values['range']['in_at'];        
           unset($this->values['range']['in_at']);
           $this->setTimeForDate('treated_at');     
       }   
       elseif ($this->hasValidator('date_creation') && $this['date_creation']->getValue())
       {      
           $this->values['range']['creation_at']=$this->values['range']['in_at'];        
           unset($this->values['range']['in_at']);
           $this->setTimeForDate('creation_at');     
       }  
        elseif ($this->hasValidator('date_confirmed') && $this['date_confirmed']->getValue())
       {      
           $this->values['range']['confirmed_at']=$this->values['range']['in_at'];        
           unset($this->values['range']['in_at']);
           $this->setTimeForDate('confirmed_at');     
       }  
         elseif ($this->hasValidator('date_callback') && $this['date_callback']->getValue())
       {      
           $this->values['range']['callback_at']=$this->values['range']['in_at'];        
           unset($this->values['range']['in_at']);
           $this->setTimeForDate('callback_at');     
       }  
       else
       {    
          unset($this->values['range']['created_at']); 
          $this->setTimeForDate('in_at');         
       }   
       if (isset($this->values['in']['team_id']))
       {                          
           $this->insertTeleproAndSaleFromTeamsInQuery();
       }    
       if (isset($this->values['equal']['team_id']))
       {
           $this->insertTeleproAndSaleFromTeamsEqualQuery();
       }    
       if ($this['has_mobile']->getValue())
       {                
           $this->values['equal']['mobile']='IS_NOT_EMPTY';
       } 
       if ($this['has_no_product']->getValue())
       {                
           $this->values['equal']['product_id']='IS_NULL';
       } 
       if ($this->hasValidator('has_contract') && $this['has_contract']->getValue())
       {                
           $this->values['equal']['meeting_id']='IS_NULL';
       } 
       return parent::getQuery();
    }
    
    
    function _extractParameterForUrl($name) 
    {              
        if ($name=='range')
        {               
            $values=$this['range']->getValue();          
            if ($this['date_rdv']->getValue())
            {             
                  if (isset($values['created_at']))
                  {
                      foreach ($values['created_at'] as $name=>$value)               
                           $values['in_at'][$name]=format_date(date("Y-m-d",strtotime($value)),"a");  // Remove time
                      unset($values['created_at']);
                  }                
            }   
            elseif ($this->hasValidator('date_treated') && $this['date_treated']->getValue())
            {               
                  if (isset($values['treated_at']))
                  {
                      foreach ($values['treated_at'] as $name=>$value)               
                           $values['in_at'][$name]=format_date(date("Y-m-d",strtotime($value)),"a");  // Remove time    
                       unset($values['treated_at']);
                  } 
            }  
            elseif ($this->hasValidator('date_creation') && $this['date_creation']->getValue())
            {
                  if (isset($values['creation_at']))
                  {
                      foreach ($values['creation_at'] as $name=>$value)               
                           $values['in_at'][$name]=format_date(date("Y-m-d",strtotime($value)),"a");  // Remove time                   
                       unset($values['creation_at']);
                  }  
            }  
            elseif ($this->hasValidator('date_confirmed') && $this['date_confirmed']->getValue())
            {                 
                  if (isset($values['confirmed_at']))
                  {
                      foreach ($values['confirmed_at'] as $name=>$value)               
                           $values['in_at'][$name]=format_date(date("Y-m-d",strtotime($value)),"a");  // Remove time 
                      unset($values['confirmed_at']);
                  }  
            }   
            elseif ($this->hasValidator('date_callback') && $this['date_callback']->getValue())
            {
                  if (isset($values['callback_at']))
                  {
                      foreach ($values['callback_at'] as $name=>$value)               
                           $values['in_at'][$name]=format_date(date("Y-m-d",strtotime($value)),"a");  // Remove time                   
                       unset($values['callback_at']);
                  }  
            } 
            else
            {                
                  if (isset($values['in_at']))
                  {
                      foreach ($values['in_at'] as $name=>$value)               
                           $values['in_at'][$name]=$values['in_at'][$name]?format_date(date("Y-m-d",strtotime($value)),"a"):""; // 
                  } 
            }               
            return $values;
        }    
        return parent::_extractParameterForUrl($name);
    }
    
    protected function hasNoTeamInRange()
    {
        foreach ($this['in']['team_id']->getValue() as $team)
        {
            if ($team=='IS_NULL')
                return true;
        }    
        return false;
    }        
    
    protected function insertTeleproAndSaleFromTeamsInQuery()
    {         
          $params=array();               
           // Telepro         
           $telepros=UserTeamUtils::getTeleproUsersByIdFromTeams($this['in']['team_id']->getValue());
           if ($telepros)
              $params[]=CustomerMeeting::getTableField('telepro_id')." IN('".implode("','",$telepros)."')";           
           // Sale1 & Sale2
           $sales=UserTeamUtils::getSalesUsersByIdFromTeams($this['in']['team_id']->getValue());
           if ($sales)
           {
               $params[]=CustomerMeeting::getTableField('sales_id')." IN('".implode("','",$telepros)."')"; 
               $params[]=CustomerMeeting::getTableField('sale2_id')." IN('".implode("','",$telepros)."')"; 
           }             
           // Assistant ?
           if ($params)
           {    
                $where="(".implode(" OR ",$params).")";               
                //var_dump($where);                   
                $this->replaceWhereParameters($where);
                //  echo "output=".$this->query."<br/>";
           }           
    }    
    
    
    protected function insertTeleproAndSaleFromTeamsEqualQuery()
    {         
          $params=array();               
           // Telepro         
          $telepros=UserTeamUtils::getTeleproUsersByIdFromTeam($this['equal']['team_id']->getValue());
           if ($telepros)
              $params[]=CustomerMeeting::getTableField('telepro_id')." IN('".implode("','",$telepros)."')"; 
           if ($params)
           {    
                $where="(".implode(" OR ",$params).")";                               
                $this->replaceWhereParameters($where);              
           } 
    }  
    
    
    function getStatusStates()
    {
        return CustomerMeetingStatus::getStatusForSelect()->unshift(array("0"=>__("Not defined")));
    }
    
    function getStatusCallStates()
    {
        return CustomerMeetingStatusCall::getStatusCallForSelect()->unshift(array("0"=>__("Not defined")));                         
    }
}

