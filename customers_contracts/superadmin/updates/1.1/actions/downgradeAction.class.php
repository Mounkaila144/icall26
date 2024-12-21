<?php


class customers_contracts_downgrade_11_Action extends mfModuleUpdate {
 
    
    function execute()
    {
       $site=$this->getSite();     
       $permission=new Permission('contract_modify_state','admin',$site); 
       $permission->delete();
    }
    
   
}

