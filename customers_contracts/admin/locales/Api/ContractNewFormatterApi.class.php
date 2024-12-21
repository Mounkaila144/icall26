<?php

require_once __DIR__."/Forms/ContractApiNewForm.class.php";

class ContractNewFormatterApi extends mfFormatterApi {
    
    protected $data=array(),$item=null,$form=null,$user=null;
    
    function __construct($action) {
        $this->user = $action->getUser();
        $this->action=$action;
        $this->item=new CustomerContract();        
        $this->form=new ContractApiNewForm($this->getUser());        
        parent::__construct();
    }
    
     
    function getUser()
    {
        return $this->user;
    }
    
    function getAction()
    {
        return $this->action;
    }
    
    function getItem() 
    {
        
        return $this->item;
    }
    
    function getForm()
    {
        return $this->form;
    }

    function getSettings()
    {
        return $this->settings=$this->settings===null?new UserSettings():$this->settings;
    }
    
    function getCustomerFormatter()
    {
        return $this->customer_formatter=$this->customer_formatter===null?new CustomerNewFormatterApi($this->getItem()->getCustomer(), $this->getForm()):$this->customer_formatter;
    }
       
    function getData()
    {
        if ($this->isFromTheme()){                                        
                    $this->_data=$this->_data===null?$this->theme_api->getData():$this->data; 
        }else{                
                $this->_data=$this->_data===null?new mfArray( array(           
                            'id'=>array('properties'=>array('style'=>'display:none')),
                            'polluter_id'=>array(
                                'style'=>array(
                                    'method'=>'Polluter',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'sav_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'quoted_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'opened_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'billing_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'doc_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'apf_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'closed_at'=>array(
                                'style'=>array(
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),                                
                            'has_tva',
                            'company_id'=>array(
                                'style'=>array(
                                    'method'=>'Company',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),
                            'remarks',
                            'partner_layer_id'=>array(
                                'style'=>array(
                                    'method'=>'PartnerLayer',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),
                            'state_id'=>array(
                                'style'=>array(
                                    'method'=>'Status',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',  
                                        'default'=>__('No state')),
                            )),
                            'opc_range_id'=>array(
                                'style'=>array(
                                    'method'=>'OpcRange',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),
                            'reference',
                            'admin_status_id'=>array(
                                'style'=>array(
                                    'method'=>'AdminStatus',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),
                            'time_state_id'=>array(
                                'style'=>array(
                                    'method'=>'TimeState',
                                    'parameters'=>array(
                                        'true'=>'content:fa-check;color:#00ff00',
                                        'false'=>'content:fa-uncheck;color:#ff0000',                                    
                            ))),

                )):$this->_data;                 
            }
           
            return $this->_data;
    }
    
    
    
    function process()
    {     
        try
        {
            $this->getAction()->getEventDispather()->notify(new mfEvent($this, 'contract.new.form.api')); 
            $this->loadTheme();
            
            parent:: process();         
            
            
            $this->data['schema']=$this->getForm()->getValidatorSchema()->getMapping();     
                 
            
             
            /*$this->data['data']= array_merge($this->getData(), $this->getCustomerFormatter()->getData());*/
            
            /*  $index=0;
             foreach ($this->getData() as $field=>$options)
             {
                 if (!$this->getForm()->getMapping()->hasItemByKey(is_numeric($field)?$options:$field))
                         continue;
                 $this->data['data'][$index++]['schema']=$this->getForm()->getMapping()->getItemByKey(is_numeric($field)?$options:$field);
             } */   
        }
        catch (mfException $e)
        {
            $this->data['errors']=$e->getMessage();
        }       
        return $this;
    }



}



