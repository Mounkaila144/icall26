<?php

class marketing_leads_importLinkActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
    }
}