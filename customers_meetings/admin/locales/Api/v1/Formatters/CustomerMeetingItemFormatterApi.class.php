<?php

class CustomerMeetingItemFormatterApi extends mfFormatterFilterItemApi  {        
     
    function getDefaultsData()
    {
        return $this->getItem()->toArray(array());
    }
    
    function getData()
    {    
        if ($this->isFromThemeFormatter())       
        {                                                 
            return $this->theme_formatter_api->getData();                 
        }
        return array(  'id'=>array('properties'=>array('style'=>'display:none'),
                                    'label'=>__('id')
                                  ),
                       "line1"=>array(                           
                            'fields'=>array(                                                                                           
//                                'is_hold'=>array(
//                                    'label'=>__('Hold'),
//                                    'condition'=>$this->getItem()->isHold()
//                                    ),
//                                'is_locked'=>array(
//                                    'label'=>__('Locked'),
//                                    'condition'=>($this->getFilter()->getSettings()->hasLock() && ($this->getItem()->isLocked()|| !$this->getItem()->isLockOwner()))
//                                    ),
                                'in_at'=>array(
                                                'label'=>__('In at'),
                                                'method'=>'Date',
                                                'condition'=>$this->getItem()->get('in_at')
                                ), 
//                                'callback_at'=>array( 
//                                    'label'=>__("Callback at"),
//                                    'method'=>'CallbackDate',
//                                    'condition'=>($this->getItem()->hasCallbackAt() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_callback_datetime']]))
//                                ),
                                'created_at'=>array(
                                    'label'=>__("Booked in"),
                                    'format'=>array(
                                        'method'=>'CreatedAt',
                                        'output'=>array(
                                            'method'=>'getFormatted',
                                            'options'=>'p'
                                        )
                                    ),
                                    'condition'=> $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_created_date']])
                                ),
                                'creation_at'=>array(
                                    'label'=>__("Created at"),
                                    'format'=>array(
                                        'method'=>'CreationAt',
                                        'output'=>array(
                                            'method'=>'getFormatted',
                                            'options'=>'p'
                                        )
                                    ),
                                    'condition'=> $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_creation_date']])
                                ),
                                'treated_at'=>array(
                                    'label'=>__("Treated at"),
                                    'format'=>array(
                                        'method'=>'TreatedAt',
                                        'output'=>array(
                                            'method'=>'getFormatted',
                                            'options'=>'p'
                                        )
                                    ),
                                    'condition'=> ($this->getFilter()->getSettings()->hasTreatedDate() && $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_treatment_date']]))
                                ),
                                'opc_at'=>array(
                                    'label'=>__("Install"),
                                    'format'=>array(
                                        'method'=>'OpcAt',
                                        'output'=>array(
                                            'method'=>'getText'
                                    )
                                    ),
                                    'condition'=>  $this->getUser()->hasCredential([['superadmin','meeting_list_view_opc_range']])
                                ),
                            ),                                                      
                       ),
                       
                       "line2"=>array(
                            'fields'=>array(                                                              
                                'customer'=>array('label'=>__('Customer'),   
                                                  'method'=>'Customer',
                                                'condition'=> $this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_lastname']])
                                    ),
//                                'company'=>array(    
//                                    'label'=>__('Company'),
//                                    'method'=>'Company',
//                                    'condition'=> $this->getItem()->hasCompany()
//                                    ),
                                'phone'=>array(
                                    'label'=>__("phone"),
                                    'method'=>'Customer',
                                    'output'=>array(
                                        'field'=>'phone'
                                    ),
                                    'condition'=> ($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_phone']]))
                                ),
                                'mobile'=>array(
                                    'label'=>__("mobile"),
                                    'method'=>'Customer',
                                    'output'=>array(
                                        'field'=>'mobile'
                                    ),
                                    'condition'=> ($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_phone']]))
                                ),
                                'postcode'=>array(
                                    'label'=>__("postcode"),
                                    'format'=>array(
                                            'method'=>'Output',
                                            'parameters'=>'{customer.address.postcode}'
                                            ),
                                    'condition'=> ($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_postcode']]))
                                ),
                                'city'=>array(
                                    'label'=>__("city"),
                                    'format'=>array(
                                            'method'=>'Output',
                                            'parameters'=>'{customer.address.city}'
                                            ),
                                    'style'=>array('uppercase'),
                                    'condition'=> ($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_city']]))
                                ),
                                'address1'=>array(
                                    'label'=>__("address1"),
                                    'format'=>array(
                                            'method'=>'Output',
                                            'parameters'=>'{customer.address.address1}'
                                            ),
                                    'style'=>array('uppercase'),
                                    //'condition'=> ($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_city']]))
                                ),
//                                'surface_top'=>array(
//                                    'label'=>__("surface_101"),
//                                    'format'=>array(
//                                            'method'=>'Output',
//                                            'parameters'=>'{surfaces.surfaceTop.text}'
//                                            ),
//                                    'condition'=> ($this->getItem()->hasSurfaces() && $this->getItem()->getSurfaces()->hasSurfaceTop()  && $this->getUser()->hasCredential([['superadmin','app_domoprime_iso_meeting_list_surface_from_form_101']]))
//                                ),
//                                'surface_wall'=>array(
//                                    'label'=>__("surface_102"),
//                                    'format'=>array(
//                                            'method'=>'Output',
//                                            'parameters'=>'{surfaces.surfaceWall.text}'
//                                            ),
//                                    'condition'=> ($this->getItem()->hasSurfaces() && $this->getItem()->getSurfaces()->hasSurfaceWall()  && $this->getUser()->hasCredential([['superadmin','app_domoprime_iso_meeting_list_surface_from_form_102']]))
//                                ),
//                                'surface_floor'=>array(
//                                    'label'=>__("surface_103"),
//                                    'format'=>array(
//                                            'method'=>'Output',
//                                            'parameters'=>'{surfaces.surfaceFloor.text}'
//                                            ),
//                                    'condition'=> ($this->getItem()->hasSurfaces() && $this->getItem()->getSurfaces()->hasSurfaceFloor()  && $this->getUser()->hasCredential([['superadmin','app_domoprime_iso_meeting_list_surface_from_form_103']]))
//                                ),
//                                'team_id'=>array(
//                                    'label'=>__("team_id"),
//                                    'default'=>__('No team'),
//                                    'format'=>array(
//                                            'method'=>'Output',
//                                            'parameters'=>'{user.team}'
//                                    ),
//                                    'style'=>array('uppercase'),
//                                    'condition'=>  ( $this->getFilter()->equal->hasValidator('team_id') || $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_team']]))&&($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_team']])) && $this->getItem()->hasTeam()
//                                ),
//                                'campaign_id'=>array(
//                                    'label'=>__("Campaign"),
//                                    'format'=>array(
//                                            'method'=>'Output',
//                                            'parameters'=>'{user.campaign}'
//                                    ),
//                                    'style'=>array('uppercase'),
//                                    'condition'=>  ( $this->getFilter()->equal->hasValidator('campaign_id') || $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_campaign']]))&&($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_campaign']]))
//                                ),
                            ),                                                      
                       ),                     
                       "line3"=>array(
                            'fields'=>array(
                                'sales_id'=>array(
                                        'label'=>__("commercial_1"),
                                        'format'=>array(
                                                'method'=>'Output',
                                                'parameters'=>'{user.sales}'
                                        ),
                                        'style'=>array('uppercase'),
                                        'condition'=>  ($this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_sale1']]))&&($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_sale']])) && $this->getItem()->hasSale()
                                ),
                                'sale2_id'=>array(
                                    'label'=>__("commercial_2"),
                                    'format'=>array(
                                            'method'=>'Output',
                                            'parameters'=>'{user.sale2}'
                                    ),
                                    'style'=>array('uppercase'),
                                    'condition'=>  ($this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_sale2']]))&&($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_sale2']])) && $this->getItem()->hasSale2()
                                ),
                               'telepro_id'=>array(
                                    'label'=>__("telepro_id"),
                                    'format'=>array(
                                            'method'=>'Output',
                                            'parameters'=>'{user.telepro}'
                                    ),
                                    'style'=>array('uppercase'),
                                    'condition'=>  ( $this->getFilter()->equal->hasValidator('telepro_id') || $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_telepro']]))&&($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_telepro']])) && $this->getItem()->hasTelepro()
                                ),
                                'assistant_id'=>array(
                                    'label'=>__("assistant_id"),
                                    'format'=>array(
                                            'method'=>'Output',
                                            'parameters'=>'{user.assistant}'
                                    ),
                                    'style'=>array('uppercase'),
                                    'condition'=>  ( $this->getFilter()->equal->hasValidator('assistant_id') || $this->getUser()->hasCredential([['superadmin','admin','meeting_view_list_assistant']]))&&($this->getItem()->isAuthorized() || $this->getUser()->hasCredential([['meeting_list_view_assistant']])) && $this->getItem()->hasAssistant()
                                ),                                
                            ),                                                      
                       ),
                       "line4"=>array(
                            'fields'=>array(                                                              
                                'status'=>array('label'=>__('State'),
                                                    'choices'=>array(
                                                        array(
                                                            'value'=>'YES',
                                                            'icon'=>'ion-icon-checkmark-outline',
                                                            'color'=>'green'
                                                        ),
                                                        array(
                                                            'value'=>'NO',
                                                            'icon'=>'ion-icon-close-outline',
                                                            'color'=>'red'
                                                        ),
                                                        
                                                    )
                                    ),                                                           
                            ),                                                      
                        ), 
                            
                                                    
            
                 
                    );
    }
    
    
    function process()
    {
        ///$this->loadTheme();
        $this->loadFormatterTheme();
        parent::process();
        return $this;
    }
  
}
