<?php


class partners_layer_SelectWithContactsForFormsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
        $this->selected=$this->getParameter('layer');        
        $this->partner_layers=PartnerLayerCompany::getLayersWithContacts();
    } 
    
    
}

