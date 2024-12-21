<?php


class mfFormatter extends mfString {
    
    
      static $fields=array('created_at'=>'DateTimeFormatter',
                         'updated_at'=>'DateTimeFormatter',
                         'submitting_at'=>'DateFormatter',
                         'sale_price_with_tax_max'=>array('FloatFormatter'=>array('currency')),
                         'language'=>array('lang','LanguageFormatter')
                        );
    
     function __construct($value) {
        parent::__construct($value,array('currency'=>'MAD'));
    } 
}
