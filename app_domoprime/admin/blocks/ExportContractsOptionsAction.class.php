<?php



class app_domoprime_ExportContractsOptionsActionComponent extends mfActionComponent {

   
    function execute(mfWebRequest $request)
    {                
        $this->user=$this->getUser();
        if (!$this->getUser()->hasCredential(array(array('superadmin','app_domoprime_contracts_list_export_options_cumac'))))
            return mfView::NONE;
        $this->class=$this->getParameter('class');
    } 
    
    
}