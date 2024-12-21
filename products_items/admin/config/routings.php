<?php

return array(
    
    "products_items_ajax"=>array("pattern"=>'/module/site/products/item/admin/{action}',"module"=>"products_items","action"=>"ajax{action}","requirements"=>array("action"=>".*")),
    "products_items"=>array("pattern"=>'/module/products/item/admin/{action}',"module"=>"products_items","action"=>"{action}","requirements"=>array("action"=>".*")),
    "products_items_api"=>array("pattern"=>'/api/products/item/admin/{action}',"module"=>"products_items","action"=>"api{action}","requirements"=>array("action"=>".*")),
    );

