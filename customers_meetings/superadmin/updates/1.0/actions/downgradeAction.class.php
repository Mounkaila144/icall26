<?php


class customers_meetings_downgrade_10_Action extends mfModuleUpdate {
 
    
    function execute()
    {
       $site=$this->getSite();     
       $permission=new Permission('contract_modify_state','admin',$site); 
       $permission->delete();
    }
    
   
}

