<?php


class customers_contracts_downgrade_12_Action extends mfModuleUpdate {
 
    
    function execute()
    {
       $site=$this->getSite();     
       $permission=new Permission('contract_turnover_hidden','admin',$site); 
       $permission->delete();
    }
    
   
}

