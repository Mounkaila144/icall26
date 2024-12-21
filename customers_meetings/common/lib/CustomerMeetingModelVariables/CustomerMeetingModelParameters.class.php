<?php


class CustomerMeetingModelParameters  {
    
    
    static function loadParametersForEmail(CustomerMeeting $meeting,$action)
    {        
       $action->today=CustomerModelEmailI18n::format_date(date("Y-m-d"));  
       // COmpany
       $action->company= SiteCompanyUtils::getSiteCompany($meeting->getSite())->toArray();    
       // Customer
       $action->customer=$meeting->getCustomer()->toArray();      
       // Meeting
       $action->meeting=$meeting->toArray();    
       $action->meeting['created_at']=CustomerModelEmailI18n::format_date($meeting->get('created_at'));  
       $action->meeting['updated_at']=CustomerModelEmailI18n::format_date($meeting->get('updated_at'));  
       $action->meeting['in_at']=CustomerModelEmailI18n::format_date($meeting->get('in_at'));  
       $action->meeting['in_at']['time']=format_date($meeting->get('in_at'),"t");
       $action->meeting['state']=$meeting->hasStatus()?(string)$meeting->getStatus()->getI18n():"";
       // proposed products (separate with ,)
       $action->meeting['products']=$action->getComponent('/customers_meetings/products', array('COMMENT'=>false,'meeting'=>$meeting))->getContent();                       
    }
    
     static function loadParametersForSms($meeting,$action)
    {
        self::loadParametersForEmail($meeting, $action);
    }
    
    static function loadParametersWithChangesForEmail(CustomerMeeting $meeting,$action)
    {        
        self::loadParametersForEmail($meeting, $action);
        $action->meeting['changes']=array(
            'state'=>(string)$meeting->getOldStatus()->getI18n()
        );
    }
        
}


