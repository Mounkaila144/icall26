<?php


class customers_contracts_upgrade_12_Action extends mfModuleUpdate {
 
    function execute()
    {      
       $site=$this->getSite();     
       // Permission Group 
        $permission_group=new PermissionGroup('contracts',$site);
        
        $permission=new Permission('contract_turnover_hidden','admin',$site);
        $permission->set('group_id',$permission_group);
        $permission->save(); 
       
        $permission=new Permission('contract_turnover_with_tax_hidden','admin',$site);
        $permission->set('group_id',$permission_group);
        $permission->save(); 
        
        $permission=new Permission('contract_turnover_without_tax_hidden','admin',$site);
        $permission->set('group_id',$permission_group);
        $permission->save(); 
        
        $permission=new Permission('contract_turnover_tax_rate_hidden','admin',$site);
        $permission->set('group_id',$permission_group);
        $permission->save(); 
        
        $permission=new Permission('contract_turnover_tax_amount_hidden','admin',$site);
        $permission->set('group_id',$permission_group);
        $permission->save(); 
    }
}

