<?php


class users_emailForPasswordActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
        $this->user=$this->getParameter('user');
        $this->company=SiteCompanyUtils::getSiteCompany($this->user->getSite());           
    } 
    
    
}


