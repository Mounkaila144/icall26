<?php

class customers_meetings_MenuItemCampaignActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
       if (CustomerMeetingSettings::load()->get('has_campaign')!='YES')
           return mfView::NONE;       
    } 
    
    
}