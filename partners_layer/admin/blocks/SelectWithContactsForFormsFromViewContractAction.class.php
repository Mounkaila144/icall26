<?php


class partners_layer_SelectWithContactsForFormsFromViewContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {
        $this->selected=$this->getParameter('layer');        
        $this->partner_layers=PartnerLayerCompany::getLayersWithContacts();
    } 
    
    
}

