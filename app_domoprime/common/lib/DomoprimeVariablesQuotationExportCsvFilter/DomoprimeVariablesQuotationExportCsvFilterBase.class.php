<?php

class DomoprimeVariablesQuotationExportCsvFilterBase extends ExportCsvFilterBase {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $items=null,$user=null;
    
    function __construct($items,$user,$options=array(),$site=null) 
    {      
       $this->user=$user;
       $this->items=$items; 
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);                 
       $this->execute();
    }        
    
    function getUser()
    {
        return $this->user;
    }
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/domoprime/variables/quotations/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/domoprime/variables/quotations/exports";        
    }
    
    function getHeader()
    {
        return array(
                    
               /* $this->encode(__('ID')),*/
                $this->encode(__('NOM')),
          
                    );
    }
    
    function getItems()
    {
        return $this->items;
    }
    
    function outputLine($data)
    {     
        $values=array();
        foreach ($data as $field)
           $values[]=$this->formatField($field);                
        $this->writeLine(implode(";",$values)."\n");       
    }
        
    protected function encode($str,$encode=0)
    {       
        //if ($encode | self::UPPERCASE)
           //$str= mb_strtoupper($str,$this->getOption('charset_from','UTF-8'));
        if ($encode | self::TRIM)
           $str= trim($str);
        $str=mb_convert_encoding( $str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));
        return $str;       
    }        
    
    protected function getItemsFromModel()
    {       
            foreach ($this->getItems() as $key=>$item){ 
                $this->outputLine(array(             
                   /* $this->encode($key),    */       
                    $this->encode($item), 
                ));
           
            }
             
    }        
    
         
    function execute()
    {                               
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromModel();    
        $this->close();
    }
    
    function getName()
    {
         return __("customers")."-".__("contracts")."-".__('iso')."-".__('quotations').__('variables')."-".date("Y-m-d")."-".md5(session_id()).".csv";
    }
}

