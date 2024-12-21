<?php

class mfObject3 extends mfObject2 {
    
    static function createInstance($data=null);

    function setIfNotNull();  
        
    protected static $foreignKeyMethods=array('tax_id'=>'Tax',                                             
                                );
    
    protected static $fieldsType=array('is_low_stock'=>array('enum','Y','N'),                                       
                                       'picture'=>'ProductPictureFrame',
                                       'height'=>'float',                                         
                                       'created_at'=>'DateTimeFormatter',
                                       'updated_at'=>'DateTimeFormatter',                                    
    );
    
    static function getFieldsWithValue($fields,$value="",$alias="");
}
