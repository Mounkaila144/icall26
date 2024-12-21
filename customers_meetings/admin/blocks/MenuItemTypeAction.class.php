<?php

class customers_meetings_MenuItemTypeActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       if (CustomerMeetingSettings::load()->get('has_type')!='YES')
           return mfView::NONE;       
    } 
    
    
}