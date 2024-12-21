<?php

 
class marketing_leads_ajaxTestRecoveryWpLandingPageSiteAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();     
        try
        {            
            $this->item=new MarketingLeadsWpLandingPageSite($request->getPostParameter('WpLandingPageSite')); 
            if($this->item->isNotLoaded())
            {
                $messages->addError(__('Item not loaded'));
                return;
            } 
            
            $this->item->getLeadsFromWpTable();
            echo "Recovery success!<br />";
        }
        catch (mfException $e)
        {
            echo "Error "+$e->printStackTrace();
        }
        return mfView::NONE;
   }

}

