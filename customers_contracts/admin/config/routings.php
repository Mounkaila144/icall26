<?php

return array(
    "customers_contracts"=>array("pattern"=>'/customers/contracts/admin/{action}',"module"=>"customers_contracts","action"=>"{action}","requirements"=>array("action"=>".*")),
    
    "customers_contracts_ajax"=>array("pattern"=>'/module/customers/contracts/admin/{action}',"module"=>"customers_contracts","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    
    "customers_contracts_api"=>array("pattern"=>'/api/customers/contracts/admin/{action}',"module"=>"customers_contracts","action"=>"api{action}","requirements"=>array("action"=>".*")),
);

