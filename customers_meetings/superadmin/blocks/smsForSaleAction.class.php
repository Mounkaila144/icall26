<?php

class customers_meetings_smsForSaleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $meeting=$this->getParameter('meeting');      
       $model_i18n=$this->getParameter('model_i18n');
       $user=$this->getParameter('user');          
       $this->user=$user->toArray();                                
       $this->message=$model_i18n->get('message');           
       CustomerMeetingModelParameters::loadParametersForSms($meeting,$this);                  
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.meetings.sms.build','sale'));   
    } 
    
    
}