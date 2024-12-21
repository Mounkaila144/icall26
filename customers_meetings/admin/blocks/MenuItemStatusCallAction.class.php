<?php

class customers_meetings_MenuItemStatusCallActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       if (CustomerMeetingSettings::load()->get('has_callcenter')!='YES')
           return mfView::NONE;       
    } 
    
    
}