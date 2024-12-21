<?php


class CustomerContractsFormFilter2 extends mfFormFilterBase {

    protected $language=null,$user=null,$objects=array(),$conditions=null,$_query=null,$alias=null,$_columns=null;
    
    public $values=null;
    
    function __construct($user,$defaults=array())
    {                      
       $this->user=$user;
       $this->language=$user->getCountry();
       $this->conditions=new ConditionsQuery(); 
       $this->settings=CustomerContractSettings::load();             
       $this->conditions->setParameters(array('user_id'=>$this->getUser()->getGuardUser()->get('id')));             
       $this->_query=new mfQuery();
       $this->alias=new mfArray();
       $this->today= new DateFormatter(date('Y-m-d'));
       parent::__construct($defaults);      
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
    
    function getMfQuery()
    {
        return $this->_query;
    }
    
    function getAlias()
    {
        return $this->alias;
    }   
    
    function getColumns()
    {        
       return $this->_columns=$this->_columns===null?new mfArray(array(
              'id'=>'0000_column-id',
            'customer'=>'0001_column-customer',
            'postcode'=>'0002_column-postcode',
           'phone'=>'0003_column-phone',
           'city'=>'0004_column-city',
            'date'=>'0006_column-date',
           'actions'=>'0007_column-actions',           
           'team'=>'0008_column-team',
            'sale1'=>'0009_column-sale1',
            'sale2'=>'0010_column-sale2',
           'telepro_id'=>'0013_column-telepro_id',
           'financial_partner_id'=>'0014_column-financial_partner_id',
           'state'=>'0016_column-state',
           'is_hold'=>'0029_column-is_hold',
           'is_confirmed'=>'0031_column-is_confirmed',
           'is_hold_quote'=>'0032_column-is_hold_quote',
           'is_billable'=>'0034_column-is_billable', 
           'amount'=>'0035_column-amount',                                    
            'status'=>'column-status'
         )):$this->_columns; 
    }
    
    function configure()
    {                 
       $polluter_query="";
       $query_install_state="";     
       if ($this->getUser()->hasCredential(array(array('filter_contract_telepro'))))    
       {                  
           $this->conditions->setWhere(CustomerContract::getTableField('telepro_id')."='{user_id}' AND ".
                                       CustomerContract::getTableField('status')."='ACTIVE'"
                                      );           
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_commercial'))))   
       {                  
           $this->conditions->setWhere("(".CustomerContract::getTableField('sale_1_id')."='{user_id}' OR ".
                                       CustomerContract::getTableField('sale_2_id')."='{user_id}'".
                                       ") AND ".CustomerContract::getTableField('status')."='ACTIVE'"
                                      );         
       }      
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_telepro_manager'))))
       {       
            $team_users=$this->getUser()->getGuardUser()->getTeamUsers();                
            $condition=empty($team_users)?" IS NULL":" IN('".implode("','",array_keys($team_users))."')";      
            $this->conditions->setWhere(CustomerContract::getTableField('telepro_id').$condition." AND ".CustomerContract::getTableField('status')."='ACTIVE'"
                                      );    
       } 
      // elseif ($this->getUser()->hasGroups('sales_manager'))
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_sales_manager'))))
       {       
            $team_users=$this->getUser()->getGuardUser()->getTeamUsers();                
            $condition=empty($team_users)?" IS NULL":" IN('".implode("','",array_keys($team_users))."')"; 
            $this->conditions->setWhere(CustomerContract::getTableField('telepro_id').$condition." AND ".CustomerContract::getTableField('status')."='ACTIVE'"
                                      );    
       } 
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_contract_assistant'))))
       {
           $this->conditions->setWhere("(".CustomerContract::getTableField('assistant_id')."='{user_id}' ".
                                       " OR ".CustomerContract::getTableField('assistant_id')."=0 ) ".
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE' "
                                      );
       }
       elseif ($this->getSettings()->hasAssistant() && $this->getUser()->hasCredential(array(array('filter_contract_assistant_owner'))))
       {
           $this->conditions->setWhere("(".CustomerContract::getTableField('assistant_id')."='{user_id}' ".                                      
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE' )"
                                      );
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_financial_partner'))))
       {
           $this->conditions->setWhere("(".CustomerContract::getTableField('financial_partner_id')."='{user_id}' ".                                      
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE' )"
                                      );
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_contract_list_telepro_of_team')))) 
       {             
           $team_users=$this->getUser()->getGuardUser()->getUsersOfMyTeams();                                              
           $this->conditions->setWhere("(".CustomerContract::getTableField('telepro_id')." IN('".$team_users->getKeys()->implode("','")."') ".
                                       " AND ".CustomerContract::getTableField('status')."='ACTIVE')");                    
       }                     
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contracts.filter.credentials'));   
       if ($this->getUser()->hasCredential(array(array('filter_contract_list_creator')))) 
       {                                                             
           $this->conditions->setWhere(CustomerContract::getTableField('created_by_id')."='{user_id}' ","OR");                    
       }       
         $this->objects=new mfArray(array('CustomerContract',
                            'Customer','CustomerAddress',
                         //   'CustomerContractStatus',
                         //   'CustomerContractStatusI18n',
                         //   'Partner',                             
                         //   'telepro'=>'User','sale1'=>'User','sale2'=>'User','assistant'=>'User',
                           // 'creator'=>'User',
                        //    'UserTeam','Tax'
                        ));       
         $this->alias=new mfArray(array(
             //'telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2','assistant'=>'assistant','creator'=>'creator',
         ));
    
         if (!$this->getDefaults())
         {    
            $this->addDefaults(array(               
                 'order'=>array(
                                 "opened_at"=>"desc",                            
                 ),            
                 'range'=>array(
                    //  "in_at"=>array("from"=>date("Y-m-d H:i:s")),
                 ),
                'equal'=>array(
                         'status'=>'ACTIVE',                      
                ),                 
                 'nbitemsbypage'=>$this->getSettings()->get('filter_numberofitems_by_page',100),          
            ));
         }       
       if ($this->getUser()->hasCredential(array(array('filter_contact_default_range_opened_at_today'))))
       {              
          $this->defaults['range']["opened_at"]=array("from"=>date("Y-m-d")." 00:00:00","to"=>date("Y-m-d")." 23:59:59");
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_contact_default_range_opc_at_today'))))
       {              
          $this->defaults['range']["opc_at"]=array("from"=>date("Y-m-d")." 00:00:00","to"=>date("Y-m-d")." 23:59:59");
       }
       elseif ($this->getUser()->hasCredential(array(array('filter_contact_default_range_sav_at_today'))))
       {              
          $this->defaults['range']["sav_at"]=array("from"=>date("Y-m-d")." 00:00:00","to"=>date("Y-m-d")." 23:59:59");
       }
        elseif ($this->getUser()->hasCredential(array(array('filter_contact_default_range_created_at_today'))))
       {              
          $this->defaults['range']["created_at"]=array("from"=>date("Y-m-d")." 00:00:00","to"=>date("Y-m-d")." 23:59:59");
       }
       $this->setClass('CustomerContract');
       $this->setFields(array(//'lastname'=>'Customer',
                              'postcode'=>'CustomerAddress',
                              "postcode_zone"=>array('class'=>'CustomerAddress','name'=>'postcode'),
                              'product_id'=>'CustomerContractProduct',   
                              'zone_id'=>null,
                              'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('company')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 CustomerContract::getTableField('reference')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%'".
                                                 ")")
                              ),                          
                              'phone'=>array('class'=>'Customer',
                                             'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('phone')." LIKE '%%{phone}%%' OR ".
                                                 Customer::getTableField('mobile')." LIKE '%%{phone}%%'".
                                                 ")")
                                            ),                           
                              'city'=>array('class'=>'CustomerAddress',
                                            'search'=>array('conditions'=>CustomerAddress::getTableField('city')." COLLATE UTF8_GENERAL_CI LIKE '%%{city}%%'"))
                              ));            
       $this->_query->select("{fields}")
                    ->from(CustomerContract::getTable())
                    ->left(CustomerContract::getOuterForJoin('customer_id'))
                    ->left(CustomerAddress::getInnerForJoin('customer_id'))
               //     ->left(CustomerContract::getOuterForJoin('telepro_id','telepro'))
               //     ->left(CustomerContract::getOuterForJoin('sale_1_id','sale1'))
               //     ->left(CustomerContract::getOuterForJoin('sale_2_id','sale2'))
               //     ->left(CustomerContract::getOuterForJoin('assistant_id','assistant'))
               //     ->left(CustomerContract::getOuterForJoin('state_id'))
               //     ->left(CustomerContractProduct::getInnerForJoin('contract_id'))
               //     ->left(CustomerContract::getOuterForJoin('financial_partner_id'))
               //     ->left(CustomerContract::getOuterForJoin('team_id'))
              //      ->left(CustomerContract::getOuterForJoin('tax_id'))             
               //     ->left(CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'")
                    ->where($this->conditions->getWhere(""))
                    ->where(CustomerContract::getTableField('status')."!='INPROGRESS'")
                    ->groupBy(CustomerContract::getTableField('id'));
       if ($this->getSettings()->hasPolluter() && mfModule::isModuleInstalled('partners_polluter') && !$this->getUser()->hasCredential([['contract_list_partner_polluter_remove']]))
       {           
       //  $this->objects[]='PartnerPolluterCompany';      
      //   $this->_query->left(CustomerContract::getOuterForJoin('polluter_id'));
         $this->getColumns()->set('polluter',__('column-polluter'));
         $this->getDefaultColumns()->push('polluter');
       }    
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_list_install_state'))))
       {                    
        //   $this->objects[]='CustomerContractInstallStatus';
        //   $this->objects[]='CustomerContractInstallStatusI18n';            
        //   $this->_query->left(CustomerContract::getOuterForJoin('install_state_id'))
         //                 ->left(CustomerContractInstallStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractInstallStatusI18n::getTableField('lang')."='{lang}'");
             $this->getColumns()->set('install_state','0018_column-install_state');
       } 
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_view_list_time_state'))))
       {                    
          // $this->objects[]='CustomerContractTimeStatus';
          // $this->objects[]='CustomerContractTimeStatusI18n';          
         //  $this->_query->left(CustomerContract::getOuterForJoin('time_state_id'))
          //                ->left(CustomerContractTimeStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractTimeStatusI18n::getTableField('lang')."='{lang}'");           
           $this->getColumns()->set('time_state_id','0019_column-time_state_id');
       } 
         if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_list_opc_range'))))
       {                    
         //  $this->objects[]='CustomerContractRange';
         //  $this->objects[]='CustomerContractRangeI18n';          
        //   $this->_query->left(CustomerContract::getOuterForJoin('opc_range_id'))
        //                ->left(CustomerContractRangeI18n::getInnerForJoin('range_id')." AND ".CustomerContractRangeI18n::getTableField('lang')."='{lang}'");
       
       } 
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_list_opc_status'))))
       {                    
//           $this->objects[]='CustomerContractOpcStatus';
//           $this->objects[]='CustomerContractOpcStatusI18n';          
//           $this->_query->left(CustomerContract::getOuterForJoin('opc_status_id'))
//                        ->left(CustomerContractOpcStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractOpcStatusI18n::getTableField('lang')."='{lang}'");           
              $this->getColumns()->set('opc_status_id','0020_column-opc_status_id');          
       } 
       if ($this->getSettings()->hasLayer() && $this->getUser()->hasCredential(array(array('superadmin','contract_list_partner_layer'))))
       {                      
//           $this->objects[]='PartnerLayerCompany';            
//           $this->_query->left(CustomerContract::getOuterForJoin('partner_layer_id'));   
         $this->getColumns()->set('partner_layer_id','0015_column-partner_layer_id'); 
            $this->getDefaultColumns()->push('partner_layer_id');
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_list_admin_status'))))
       {                    
//           $this->objects[]='CustomerContractAdminStatus';
//           $this->objects[]='CustomerContractAdminStatusI18n';          
//           $this->_query->left(CustomerContract::getOuterForJoin('admin_status_id'))
//                        ->left(CustomerContractAdminStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractAdminStatusI18n::getTableField('lang')."='{lang}'");
          $this->getColumns()->set('admin_status_id','0017_column-admin_status_id');
          $this->getDefaultColumns()->push('admin_status_id');
       } 
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_created_by'))))
       {                    
//           $this->objects['creator']='User';                    
//           $this->_query->left(CustomerContract::getOuterForJoin('created_by_id','creator'));  
              $this->getColumns()->set('creator','0011_column-creator');
       } 
       if ($this->getUser()->hasCredential(array(array('superadmin_debug','contract_list_attributions'))))
       {    
//           $this->objects[]='CustomerContractContributor';                    
//           $this->_query->left(CustomerContractContributor::getInnerForJoin('contract_id'));       
          $this->getColumns()->set('contributor_id',__('column-contributor_id'));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_company'))))
       {    
//          $this->objects[]='CustomerContractCompany';                    
//          $this->_query->left(CustomerContract::getOuterForJoin('company_id'));       
          $this->getColumns()->set('company_id','0036_column-company_id');
       }
       // Validators        
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(                                                                         
                            "opened_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "total_price_with_taxe"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "total_price_without_taxe"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),     
                            "postcode"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            "phone"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),     
                            "city"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(                                                   
                             "lastname"=>new mfValidatorString(array("required"=>false)),                             
                             "phone"=>new mfValidatorString(array("required"=>false)),                             
                             "city"=>new mfValidatorString(array("required"=>false)), 
                             "id"=>new mfValidatorString(array("required"=>false)),  
                             "advance_payment"=>new mfValidatorString(array("required"=>false)), 
                            ),array("required"=>false)),            
            'begin'=>new mfValidatorSchema(array(                                
                             "postcode"=>new mfValidatorMultiple(new mfValidatorString(array("required"=>false)),array("required"=>false)),                                                                          
                            ),array("required"=>false)), 
            'range' => new mfValidatorSchema(array(                             
                              "opened_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                              "opc_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),
                              "sav_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),
                            ),array("required"=>false)),   
            'rangeOr' => new mfValidatorSchema(array(                             
                              "opened_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),   
                              "opc_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),
                              "sav_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),
                            ),array("required"=>false)),   
            'in'=>new mfValidatorSchema(array(                
                          'telepro_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTeleproUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'sale_1_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSalesUsers1($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'sale_2_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSalesUsers2($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'state_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),                          
                          'product_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getProducts($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),
                          'team_id'=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTeams($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)),
                          "financial_partner_id"=>new mfValidatorChoice(array("choices"=>CustomerContractUtils::getFinancialPartners($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)),                          
                    ),array("required"=>false)),   
            'equal' => new mfValidatorSchema(array(                 
                                "reference"=>new CustomerContractReferenceValidator(array("required"=>false)),
                                "opc_at"=>new mfValidatorI18nDate(array("required"=>false)),
                                "opened_at"=>new mfValidatorI18nDate(array("required"=>false)),
                                "telepro_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getTeleproUsersForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),          
                                "sale_1_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers1ForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                                "sale_2_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getSalesUsers2ForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)),                                           
                                "state_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__('Not defined'))+CustomerContractUtils::getStatusForSelect($this->getLanguage(),$this->getConditions()),"key"=>true,"required"=>false)),
                                "product_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__('No product'))+CustomerContractUtils::getProductsForSelect('meta_title',$this->getConditions()),"key"=>true,"required"=>false)),
                                "team_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getTeamsForSelect($this->getConditions()),"key"=>true,"required"=>false)),
                                "status"=>new mfValidatorChoice(array("choices"=>array(""=>"","ACTIVE"=>"ACTIVE","DELETE"=>"DELETE"),"key"=>true,"required"=>false)),
                                "is_hold"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                                "is_hold_quote"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                                "is_confirmed"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                                "financial_partner_id"=>new mfValidatorChoice(array("choices"=>array(''=>'','0'=>__('Not defined'))+CustomerContractUtils::getFinancialPartnersForSelect($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)),                                
                                "is_billable"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),
                            ),array("required"=>false)), 
            'date_install'=>new mfValidatorBoolean(),                     
            'date_null'=>new mfValidatorBoolean(),              
            'sizes' => new mfValidatorSchema(array(),array("required"=>false)),
            'options'=>new mfValidatorSchema(array(),array("required"=>false)),           
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100"),"key"=>true)),                    
        ));                 
        if ($this->getSettings()->hasAssistant() && (!$this->getUser()->hasGroups('assistant') || $this->getUser()->hasCredential(array(array('contract_view_list_assistant')))))
        {
            $this->equal->addValidator("assistant_id",new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getAssistantUsersForSelect2($this->getConditions(),$this->getUser()),"key"=>true,"required"=>false)));
            $this->in->addValidator('assistant_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getAssistantUsers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
               $this->getColumns()->set('assistant_id','0012_column-assistant_id');
            $this->getDefaultColumns()->push('assistant_id');
        } 
         if ($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential(array(array('superadmin','admin','contract_view_list_polluter')) && !$this->getUser()->hasCredential([['contract_list_partner_polluter_remove']])))
       {
           $this->equal->addValidator("polluter_id",new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__('Not defined'))+CustomerContractUtils::getPollutersForSelect2($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
           $this->in->addValidator('polluter_id',new mfValidatorChoice(array("choices"=>array('IS_NULL'=>__('Not defined'))+CustomerContractUtils::getPolluters($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
       }  
       if ($this->getUser()->hasCredential(array(array('filter_telepro','contract_list_remove_telepro'))))   
           unset($this->in['telepro_id'],$this->equal['telepro_id']);           
       if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_list_install_state'))))
       {                    
           $this->equal->addValidator('install_state_id',new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerContractUtils::getInstallStateForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
            $this->in->addValidator('install_state_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getInstallStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_view_list_time_state'))))
       {                    
           $this->equal->addValidator('time_state_id',new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerContractUtils::getTimeStateForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
           $this->in->addValidator('time_state_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getTimeStates($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
           $this->getColumns()->set('time_state_id','0019_column-time_state_id');
           $this->getDefaultColumns()->push('time_status_id');
       }
         if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_opc_range'))))
       {                    
           $this->equal->addValidator('opc_range_id',new mfValidatorChoice(array("choices"=>array(''=>"",'IS_NULL'=>__('----'))+CustomerContractUtils::getOpcRangeForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
           $this->in->addValidator('opc_range_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getOpcRanges($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
       } 
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_filter_sav_at_range'))))
       {                    
           $this->equal->addValidator('sav_at_range_id',new mfValidatorChoice(array("choices"=>array(''=>"",'0'=>__('----'))+CustomerContractUtils::getSavAtRangeForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
           $this->in->addValidator('sav_at_range_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getSavAtRanges($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
       } 
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_list_opc_status'))))
       {                    
           $this->equal->addValidator('opc_status_id',new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerContractUtils::getOpcStatusForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
          $this->in->addValidator('opc_status_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getOpcStatuses($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
         $this->getColumns()->set('opc_status_id','0020_column-opc_status_id');
        $this->getDefaultColumns()->push('opc_status_id');
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','admin','contract_view_list_admin_status'))))
       {                    
           $this->equal->addValidator('admin_status_id',new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerContractUtils::getAdminStatusForSelect($this->getLanguage(),$this->getConditions()),'key'=>true,'required'=>false)));
           $this->in->addValidator('admin_status_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getAdminStatuses($this->getLanguage(),$this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_view_sav_at'))))
       {                    
          $this->setValidator('date_sav',new mfValidatorBoolean());
          $this->equal->addValidator('sav_at',new mfValidatorI18nDate(array("required"=>false)));
          $this->range->addValidator('sav_at',new mfValidatorI18nDateRangeCompare(array("required"=>false)));
       }
       if ($this->getSettings()->hasLayer() && $this->getUser()->hasCredential(array(array('superadmin','contract_list_partner_layer'))))
       {                    
           $this->equal->addValidator("partner_layer_id",new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerContractUtils::getLayersForSelect($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
           $this->in->addValidator('partner_layer_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getLayers($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_company'))))
       {                    
           $this->equal->addValidator("company_id",new mfValidatorChoice(array("choices"=>array(''=>'','IS_NULL'=>__('Not defined'))+CustomerContractUtils::getCompaniesForSelect($this->getConditions(),$this->getUser()),'key'=>true,'required'=>false)));
           $this->in->addValidator('company_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getCompanies($this->getConditions(),$this->getUser()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_created_by'))))
       {                    
           $this->equal->addValidator("created_by_id",new mfValidatorChoice(array("choices"=>array(""=>"")+CustomerContractUtils::getCreatedByUsersForSelect($this->getConditions()),"key"=>true,"required"=>false)));
           $this->in->addValidator('created_by_id',new mfValidatorChoice(array("choices"=>CustomerContractUtils::getCreatedByUsers($this->getConditions()),'multiple'=>true,'key'=>true,'required'=>false)));
       }
       if ($this->getUser()->hasCredential(array(array('contract_list_date_install_remove'))))
       {
           unset($this['date_install']);
       }
       if ($this->getUser()->hasCredential(array(array('superadmin_debug','contract_list_attributions'))))
       {    
           foreach (array('team','telepro','sale_1','sale_2','assistant','manager') as $type)
           {
               
           }                                        
       }
       if ($this->getUser()->hasCredential(array(array('superadmin_debug','contract_list_postcode_zone'))))
       {    
            $this->begin->addValidator("postcode_zone",new mfValidatorMultiple(new mfValidatorString(array("required"=>false)),array("required"=>false)));
            $this->equal->addValidator("zone_id",new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>CustomerContractZone::getActiveZonesForSelect()->unshift(array(""=>__("Zone"))))));
            $this->in->addValidator("zone_id",new mfValidatorChoice(array('required'=>false,'key'=>true,'multiple'=>true,'choices'=>CustomerContractZone::getActiveZones()->unshift(array(""=>__("Zone"))))));
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_view_created_at'))))
       {                    
          $this->setValidator('date_created',new mfValidatorBoolean());
          $this->equal->addValidator('created_at',new mfValidatorI18nDate(array("required"=>false)));
          $this->range->addValidator('created_at',new mfValidatorI18nDateRangeCompare(array("required"=>false)));
       }       
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_has_no_product'))))
       {                    
          $this->setValidator('has_no_product',new mfValidatorBoolean());         
       }
       if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_is_document'))))
       {                
            $this->equal->addValidator("is_document",new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(''=>'','Y'=>__('YES'),'N'=>__("NO")))));         
             $this->getColumns()->set('is_document','0039_column-is_document');
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_is_photo'))))
       {                
            $this->equal->addValidator("is_photo",new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(''=>'','Y'=>__('YES'),'N'=>__("NO")))));         
             $this->getColumns()->set('is_photo','0037_column-is_photo');
       }
        if ($this->getUser()->hasCredential(array(array('superadmin','contract_list_is_quality'))))
       {                
            $this->equal->addValidator("is_quality",new mfValidatorChoice(array('required'=>false,'key'=>true,'choices'=>array(''=>'','Y'=>__('YES'),'N'=>__("NO")))));         
            $this->getColumns()->set('is_quality','0038_column-is_quality');
       }
       if ($this->getUser()->hasCredential(array(array('superadmin_debugx','contract_list_default_date_install'))))    
           $this->setDefault('date_install',true);    
       if ($this->getUser()->hasCredential(array(array('superadmin_debugx','contract_list_default_date_created'))))     
           $this->setDefault('date_created',true);     
       if ($this->getUser()->hasCredential(array(array('superadmin_debugx','contract_list_default_date_sav'))))    
           $this->setDefault('date_sav',true);             
       $this->validatorSchema->setPostValidator(new mfValidatorCallbacks(new mfArray()));       
       $this->setValidator('cols',new mfValidatorChoice(array("choices"=>$this->getColumns(),'key'=>true,'multiple'=>true,'required'=>false,'empty_value'=>array())));      
        mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.filter2.config'));   
       $this->updateFilterColumns();    
       $this->setQuery((string)$this->_query);               
    }
    
    
    function updateFilterColumns()
    {
        foreach ($this->getColumns()->getKeys() as $cols)
       {
           $this->sizes->addValidator($cols,new mfValidatorInteger(array("required"=>false)));
       }       
       if (($cols=$this->getUser()->getStorage()->read('contract_cols_2')) && !$this->getDefault('cols'))
       {                           
         $this->setDefault('cols',$cols);
         $this->setDefault('sizes',$this->getUser()->getStorage()->read('contract_sizes_2'));         
       }   
       elseif (($properties=UserProperty::load('list_contract_2',$this->getUser()->getGuardUser())) && !$this->getDefault('cols'))
       {           
           $this->setDefault('cols',$properties->getData()->getColumns());
           $this->setDefault('sizes',$properties->getData()->getSizes());                        
       }             
       elseif (!$this->getDefault('cols'))
       {                      
           UserProperty::register('list_contract_2',$this->getUser()->getGuardUser(),$this->getDefaultColumns()->toArray(),$this['sizes']->getValue());           
           $this->setDefault('cols',$this->getDefaultColumns()->toArray());         
       }             
       return $this;
    }
    
    function getDefaultColumns()
    {
       return $this->defaults_columns=$this->defaults_columns===null?new mfArray(array(
            'date','customer','phone','postcode','city','state','id','team',
            'telepro_id','actions','financial_partner_id',
           )):$this->defaults_columns;
    }
   
    
    function getObjectsForPager()
    {
        return $this->objects;
    }
    
    function addObject($object,$alias=null)
    {
        if ($alias)
            $this->objects[$alias]=$object;
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
    
    
     function setTimeForDateByCondition($condition,$name)
     {
          if ($this->values[$condition][$name]['to'])
          {    
            $this->values[$condition][$name]['to'].=" 23:59:59";              
          }
          if ($this->values[$condition][$name]['from'])
          {
             $this->values[$condition][$name]['from'].=" 00:00:00";    
          }  
     }
     
    function getQuery()
    {               
       if ($this->query_valid)
            return $this->query;                    
         if ($this->hasValidator('date_install') && $this->hasValidator('date_sav') && $this->values['date_sav'] && $this->values['date_install'])
        {                      
            if ($this->values['date_null'])
            {                
                $this->values['equal']['sav_at']='IS_NULL';
                $this->values['equal']['opc_at']='IS_NULL';
            }   
            else
            {                    
                 $this->values['rangeOr']['sav_at']=$this->values['range']['opened_at'];                  
                 $this->values['rangeOr']['opc_at']=$this->values['range']['opened_at'];  
                 $this->setTimeForDateByCondition('rangeOr','sav_at');        
                 $this->setTimeForDateByCondition('rangeOr','opc_at');        
            }
            unset($this->values['range']['opened_at']);
        }
        elseif ($this->hasValidator('date_install') && $this->values['date_install'])
        {                
            if ($this->values['date_null'])
            {
                $this->values['equal']['opc_at']='IS_NULL';
            }   
            else
            {    
                 $this->values['range']['opc_at']=$this->values['range']['opened_at'];                  
                 $this->setTimeForDateByCondition('range','opc_at');        
            }
            unset($this->values['range']['opened_at']);
        }            
       elseif ($this->hasValidator('date_sav') && $this->values['date_sav'])
       {          
           if ($this->values['date_null'])
           {
               $this->values['equal']['sav_at']='IS_NULL';
           }   
           else
           {    
                $this->values['range']['sav_at']=$this->values['range']['opened_at'];                  
                $this->setTimeForDateByCondition('range','sav_at');        
           }
           unset($this->values['range']['opened_at']);
       }  
       elseif ($this->hasValidator('date_created') && $this->values['date_created'])
       {                       
            $this->values['range']['created_at']=$this->values['range']['opened_at'];                  
            $this->setTimeForDateByCondition('range','created_at');                  
            unset($this->values['range']['opened_at']);
       } 
       else
       {          
           if ($this->values['date_null'])
           {
               $this->values['equal']['opened_at']='IS_NULL';
           }  
           else
           {    
              $this->setTimeForDateByCondition('range','opened_at');  
           }
       }       
       if ($this->equal->hasValidator('zone_id'))
       {
           if ($this->values['equal']['zone_id'])
           {           
              $this->values['begin']['postcode_zone']=$this->getZone()->getPostCodes();
           }    
       }    
        if ($this->in->hasValidator('zone_id'))
       {
           if ($this->values['in']['zone_id'])
           {           
             //  var_dump($this->getZones()->getPostCodes());
             $this->values['begin']['postcode_zone']=$this->getZones()->getPostCodes();
           }    
       } 
       if ($this->hasValidator('has_no_product'))
       {                          
           if ($this->values['has_no_product'])
           {                   
                $this->values['equal']['product_id']='IS_NULL';               
           }     
       }              
       if ($this->hasValidator('has_quotation'))
       {                                    
           if (!$this->isReady() && $this->defaults['has_quotation'])
           {                               
                $this->defaults['equal']['has_quotation']='IS_NOT_NULL';               
           }
           elseif ($this->values['has_quotation'])
           {                               
                $this->values['equal']['has_quotation']='IS_NOT_NULL';               
           }
       }          
       mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'contract.filter.query'));                   
       return parent::getQuery();
    }
       
    
    function _getParametersForUrl($values,$token="")    
    {           
        return parent::_getParametersForUrl($this->__getParameters($values), $token);
    }
    
    function _extractParameterForUrl($name) 
    {       
        if ($name=='range')
        {
            $values=$this['range']->getValue(); 
            if ($this->hasValidator('date_install') && $this['date_install']->getValue())
            {             
                  if (isset($values['opc_at']))
                  {
                      foreach ($values['opc_at'] as $name=>$value)          
                      {                           
                         $values['opened_at'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                      }     
                      unset($values['opc_at']);
                  }                
            }            
            elseif ($this->hasValidator('date_sav') && $this['date_sav']->getValue())
            {
                
                  if (isset($values['sav_at']))
                  {
                      foreach ($values['sav_at'] as $name=>$value)          
                      {                           
                         $values['opened_at'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                      }     
                      unset($values['sav_at']);
                  }   
            } 
            elseif ($this->hasValidator('date_created') && $this['date_created']->getValue())
            {
                if (isset($values['created_at']))
                  {
                      foreach ($values['created_at'] as $name=>$value)          
                      {                           
                         $values['opened_at'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                      }     
                      unset($values['created_at']);
                  }   
            } 
            else
            {
                  if (isset($values['opened_at']))
                  {
                      foreach ($values['opened_at'] as $name=>$value)               
                           $values['opened_at'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time                     
                  }   
            }              
            return $values;
        }    
        return parent::_extractParameterForUrl($name);
    }
    
    function getDateFilter($name)
    {      
        if ($this->hasValidator('date_sav') && $this['date_sav']->getValue() && $this->hasValidator('date_install'))
        {
           if ($this['date_install']->getValue())
                return $this['rangeOr']['opc_at'][$name]->getValue();    
        }
        if ($this->hasValidator('date_install'))
        {
            if ($this['date_install']->getValue())
                return $this['range']['opc_at'][$name]->getValue();        
        }    
        if ($this->hasValidator('date_sav')  && $this['date_sav']->getValue())
            return $this['range']['sav_at'][$name]->getValue();       
         if ($this->hasValidator('date_created')  && $this['date_created']->getValue())
            return $this['range']['created_at'][$name]->getValue();     
        return $this['range']['opened_at'][$name]->getValue();       
    }
   
    
    
    function getZone()
    {
        return $this->_zone_id=$this->_zone_id===null?new CustomerContractZone($this['equal']['zone_id']->getValue()):$this->_zone_id;
    }
    
    
    function getZones()
    {
        return $this->zones=$this->zones===null?CustomerContractZone::getItemsBySelection($this['in']['zone_id']->getArray()):$this->zones;
    }

    
    function getValuesForOptions()
    {
        return $this['options']->getArray();
    }
    
    
    function getArray($fields=array(),$token="")
    {        
         $values=$this->_extractParametersForUrl($fields,$token);                 
         if ($values)
               return new mfArray(array_merge($this->__getParameters($values),array('token'=>$this->getCSRFToken())));     
         return new mfArray();       
    }
    
    
    function __getParameters($values)    
    {
        if ($this->hasValidator('date_install'))
        {    
            if ($this->hasValidator('date_sav') && $this['date_sav']->getValue() && $this['date_install']->getValue() && isset($values['rangeOr']['opc_at']))
            {                          
                    foreach ($values['rangeOr']['opc_at'] as $name=>$value)          
                    {                           
                       $values['range']['opened_at'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                    }                                                      
                    unset($values['rangeOr']);                    
            }
        }
        elseif ($this->hasValidator('date_sav') && $this['date_sav']->getValue() && isset($values['rangeOr']['opc_at']))
        {                          
                foreach ($values['rangeOr']['opc_at'] as $name=>$value)          
                {                           
                   $values['range']['opened_at'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                }                                                      
                unset($values['rangeOr']);                    
        }          
        return $values;
    }
    
    
     function updateColumns()
     {                    
        $this->getUser()->getStorage()->write('contract_cols_2',$this['cols']->getValue());         
        $this->getUser()->getStorage()->write('contract_sizes_2',$this['sizes']->getValue());  
        UserProperty::register('list_contract_2',$this->getUser()->getGuardUser(),$this['cols']->getValue(),$this['sizes']->getValue()); 
        return $this;
     }
     
     function getEqualPolluter()
     {
         if ($this->polluter_equal===null)
         {
             if ($this->values['equal']['polluter_id'])
                 $this->polluter_equal=new PartnerPolluterCompany($this->values['equal']['polluter_id']);
             else
                $this->polluter_equal=false;  
         }   
         return $this->polluter_equal;
     }
     
     function toArrayForColsAndSizes()
     {
         return new mfArray(array('cols'=>$this['cols']->getValue(),'sizes'=>$this['sizes']->getValue()));
     }
     
     
     function getReferences()
     {
         return CustomerContractUtils::getReferencesForSelect($this->getConditions(),$this->getUser(),10)->unshift(array(''=>''))->toArray();
     }
     
     function getToday()
     {
         return $this->today;
     }
}

