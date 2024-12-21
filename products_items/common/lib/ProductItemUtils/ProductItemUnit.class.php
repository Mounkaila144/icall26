<?php


class ProductItemUnit {
    
    
    static function getUnitsForSelect()
    {
        return new mfArray(array(            
            'hours'=>__("Hours",array(),'messages','products_items'),
            'square_meter'=>__("m²",array(),'messages','products_items'),
        ));        
    }
    
    
}
