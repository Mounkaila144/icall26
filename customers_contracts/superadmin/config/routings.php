<?php

return array(
    "customers_contracts"=>array("pattern"=>'/customers/contracts/admin/{action}',"module"=>"customers_contracts","action"=>"{action}","requirements"=>array("action"=>".*")),
    "customers_contracts_ajax"=>array("pattern"=>'/module/site/customers/contracts/admin/{action}',"module"=>"customers_contracts","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
);

