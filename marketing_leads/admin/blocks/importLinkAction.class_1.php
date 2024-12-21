<?php

class marketing_leads_importLink1ActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request)
    {        
        $this->user=$this->getUser();
    }
}