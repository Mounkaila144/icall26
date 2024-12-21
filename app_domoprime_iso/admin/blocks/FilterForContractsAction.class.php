<?php



class app_domoprime_iso_FilterForContractsActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                        
        $this->user=$this->getUser();        
        if (!$this->getUser()->hasCredential(array(array('superadmin_debug','app_domoprime_iso_contract_list_filter_class_energy_sector'))))
            return mfView::NONE;        
    } 
    
    
}