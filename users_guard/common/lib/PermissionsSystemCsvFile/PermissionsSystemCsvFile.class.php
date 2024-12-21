<?php


class PermissionsSystemCsvFile extends CsvFile {
    
    
    function __construct( $options = null) {        
        parent::__construct(mfConfig::get('mf_modules_dir').'/users_guard/common/i18n/fr/permissions.csv', "r");
    }
    
    
     function getData($delimiter=";"){
       $this->open();
       $list=new mfArray();
         if ($this->handler !== FALSE) {
            while (($data = fgetcsv($this->handler, 1045, $delimiter)) !== FALSE)
                $list[$data[0]]=$data[1];                      
        } 
        $this->close();
        return $list;
   }
    
}
