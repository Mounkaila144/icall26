<?php

class CustomerMeetingViewFormatterApi extends mfFormatterApi {
    
     protected $items=null, $data=array(),$item=null,$client=null;
    
    function __construct(CustomerMeeting $item,$form) {
        $this->item=$item;
        $this->form=$form;           
        parent::__construct();      
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
        return $this->settings=$this->settings===null?new CustomerMeetingSettings():$this->settings;
    }                            
    
    function getAction(){
        return  mfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    }
            
    function getData()
    {       
        
        if ($this->isFromTheme() && get_called_class()==__CLASS__)                                          
            return $this->theme_api->getData();          
            $this->items= new mfArray(array('meeting'=>array(
                            'polluter_id'=>array(
                                    'label'=>__("polluter"),    
                                    'condition'=>($this->getSettings()->hasPolluter() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_polluter','meeting_modify_polluter']]) && $this->getForm()->meeting->hasValidator('polluter_id'))
                                ),
                            'partner_layer_id'=>array(
                                    'label'=>__("Partner layer"),    
                                    'condition'=>($this->getSettings()->hasPartnerLayer() && ($this->getUser()->hasCredential([['meeting_view_partner_layer']]) || $this->getForm()->meeting->hasValidator('partner_layer_id')))
                                ),
                            'company_id'=>array(
                                    'label'=>__("Company"),    
                                    'default'=>__('No company'),
                                    'condition'=> ($this->getItem()->hasCompany() && $this->getUser()->hasCredential([['superadmin','meeting_display_meeting_company','meeting_modify_meeting_company']]))
                                ),
                            'telepro_id'=>array(
                                    'label'=>__("telepro_id"),    
                                    'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','meeting_modify','meeting_view_telepro','meeting_modify_telepro']]) && $this->getForm()->meeting->hasValidator('telepro_id'))
                                ),
                            'assistant_id'=>array(
                                    'label'=>__("assistant_id"),    
                                    'default'=>__('No assistant'),
                                    'condition'=> ($this->getSettings()->hasAssistant() &&$this->getUser()->hasCredential([['superadmin','admin','meeting_view_assistant','meeting_modify_assistant']]) && $this->getForm()->meeting->hasValidator('assistant_id'))
                                ),
                            'sales_id'=>array(
                                    'label'=>__("commercial_1"),    
                                    'default'=>__('No commercial'),
                                    'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','meeting_modify','meeting_view_sale1','meeting_modify_sale1']]) && $this->getForm()->meeting->hasValidator('sales_id'))
                                ),
                            'sale2_id'=>array(
                                    'label'=>__("commercial_2"),    
                                    'default'=>__('No commercial'),
                                    'condition'=> ($this->getUser()->hasCredential([['superadmin','admin','meeting_modify','meeting_view_sale2','meeting_modify_sale2']]) && $this->getForm()->meeting->hasValidator('sale2_id'))
                                ),
                           'in_at'=>array(
                                    'label'=>__('date_meeting'),
                                    'format'=>array('method'=>'InAt','output'=>array('method'=>'getFormatted','options'=>'a')),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_in_at','meeting_display_in_at']]) && $this->getForm()->meeting->hasValidator('in_at'))
                                ),  // formatter               
                           'in_at_range_id'=>array(
                                    'label'=>__('In At range'),
                                    'condition'=>($this->getForm()->meeting->hasValidator('in_at_range_id'))
                                ),                 
                           'in_at.hour'=>array(
                                    'label'=>__('Meeting Time'),
                                    'method'=>'Hour',
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_in_at']]) && $this->getForm()->meeting->hasValidator('in_at'))
                                ),              
                           'in_at.minute'=>array(
                                    'label'=>__('Meeting Time'),
                                    'method'=>'minute',
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_in_at']]) && $this->getForm()->meeting->hasValidator('in_at'))
                                ),    
                            'confirmed_at'=>array(
                                    'label'=>__('Confirmation date'),
                                    'format'=>array('method'=>'ConfirmedAt','output'=>array('method'=>'getFormatted','options'=>'H')),
                                    'condition'=>($this->getSettings()->hasConfirmedAt() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_confirmed_at']]))
                                ),  // formatter                      
                            'callback_at'=>array(
                                    'label'=>__('Callback Date'),
                                    'format'=>array('method'=>'CallbackAt','output'=>array('method'=>'getFormatted','options'=>'a')),
                                    'condition'=>($this->getSettings()->hasCallback() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_callback','meeting_modify_callback']]) && $this->getForm()->meeting->hasValidator('callback_at'))
                                ),  // formatter                      
                            'callback_at.hour'=>array(
                                    'label'=>__('Callback Time'),
                                    'method'=>'CallbackHour',
                                    'condition'=>($this->getSettings()->hasCallback() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_callback','meeting_modify_callback']]) && $this->getForm()->meeting->hasValidator('callback_at'))
                                ),                       
                            'callback_at.minute'=>array(
                                    'label'=>__('Callback Time'),
                                    'method'=>'CallbackMinute',
                                    'condition'=>($this->getSettings()->hasCallback() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_callback','meeting_modify_callback']]) && $this->getForm()->meeting->hasValidator('callback_at'))
                                ),                        
                            'campaign_id'=>array(
                                    'label'=>__('Campaign'),
                                    'default'=>__('No campaign'),
                                    'method'=>'Campaign',
                                    'condition'=>($this->getSettings()->hasCampaign())
                                ),                     
                            'remarks'=>array(
                                    'label'=>__('Remarks'),
                                    'format'=>array('method'=>'CensoredRemarks'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify']]))
                                ),                       
                            'state_id'=>array(
                                    'label'=>__('sale_state'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_display_state','meeting_modify_state']]) && $this->getForm()->meeting->hasValidator('state_id'))
                                ),                       
                            'callcenter_id'=>array(
                                    'label'=>__('callcenter'),
                                    'default'=>__('No callcenter'),
                                    'condition'=>($this->getSettings()->hasCallcenter() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_callcenter','meeting_modify_callcenter']]) && $this->getForm()->meeting->hasValidator('callcenter_id'))
                                ),                       
                            'status_lead_id'=>array(
                                    'label'=>__('Status lead'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_display_lead_status','meeting_modify_lead_status']]) && $this->getForm()->meeting->hasValidator('status_lead_id') )
                                ),                       
                            'status_call_id'=>array(
                                    'label'=>__('status_call'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_display_callstatus','meeting_modify_callstatus']]) && $this->getForm()->meeting->hasValidator('status_call_id') )
                                ),                       
                            'opc_at'=>array(
                                    'label'=>__('Installation date1'),
                                    'defeult'=>__('Not defined'),
                                    'format'=>array('method'=>'OpcAt','output'=>array('method'=>'getFormatted','options'=>'a')),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_opc_at','meeting_display_opc_at']]) && $this->getForm()->meeting->hasValidator('opc_at') )
                                ),                       
                            'opc_at.hour'=>array(
                                    'label'=>__('Installation date1'),
                                    'method'=>'OpcAtHour',
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_opc_at','meeting_display_opc_at','meeting_modify_opc_at_datetime']]) && $this->getForm()->meeting->hasValidator('opc_at') )
                                ),                       
                            'opc_at.minute'=>array(
                                    'label'=>__('Installation date1'),
                                    'method'=>'OpcAtMinute',
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_opc_at','meeting_display_opc_at','meeting_modify_opc_at_datetime']]) && $this->getForm()->meeting->hasValidator('opc_at') )
                                ),                       
                            'opc_at.minute'=>array(
                                    'label'=>__('Installation date1'),
                                    'method'=>'OpcAtMinute',
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','admin','meeting_modify_opc_at','meeting_display_opc_at','meeting_modify_opc_at_datetime']]) && $this->getForm()->meeting->hasValidator('opc_at') )
                                ),                       
                            'opc_range_id'=>array(
                                    'label'=>__('Opc range'),
                                    'condition'=>($this->getUser()->hasCredential([['superadmin','meeting_modify_opc_range','meeting_display_opc_range']]) && $this->getForm()->meeting->hasValidator('opc_range_id') )
                                ),                       

                        ),

                ));
               
        return $this->items;
    }
    
    
    
    function process()
    {        
        try
        {
            $this->data=new mfArray();
            if ($this->getItem()->isNotLoaded())
                throw new mfException('Item is invalid');
            
            $this->loadTheme();
            $this->getAction()->getEventDispather()->notify(new mfEvent($this, 'meeting.view.api.form'));  
            foreach ($this->getData() as $key=>$data){
                //var_dump($key);
                parent:: process($key,$data);   
            }               
            
            $this->data['schema']=$this->getForm()->getMapping()->getValues()->toArray();     
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

