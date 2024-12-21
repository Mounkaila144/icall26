<?php

class customers_meetings_emailChangesForSaleActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       $meeting=$this->getParameter('meeting');       
       $model_i18n=$this->getParameter('model_i18n');
       $user=$this->getParameter('user');          
       $this->user=$user->toArray();                                
       $this->body=$model_i18n->get('body');         
       CustomerMeetingModelParameters::loadParametersWithChangesForEmail($meeting,$this);           
       $this->getEventDispather()->notify(new mfEvent($this, 'customers.meetings.email.build','sale'));   
    } 
    
    
}