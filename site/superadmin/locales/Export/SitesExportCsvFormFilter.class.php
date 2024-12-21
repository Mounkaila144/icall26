<?php


class SitesExportCsvFormFilter extends ExportCsvFilterBase {
     const UPPERCASE=1,TRIM=2;
    
    protected $filter=null;
    
    function __construct($filter,$options=array(),$site=null) 
    {
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);
       $this->filter=$filter;              
    }        
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/sites/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/sites/exports";        
    }
    
    function getHeader()
    {
        return array(
                     __("SERVER"),    
                     __("COMPANY"),    
                     __("DATABASE"),                   
                     __("ADMIN THEME"),           
                     __("HOSTS"),
                     __("LAST CONNEXION"),
                    );
    }
    
    function getFilter()
    {
        return $this->filter;
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
       if ($encode | self::UPPERCASE)
          $str= mb_strtoupper($str,$this->getOption('charset_from','UTF-8'));
       if ($encode | self::TRIM)
          $str= trim($str);
       $str=mb_convert_encoding( $str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));
       return $str;       
    }        
    
    protected function getItemsFromDatabase($db)
    {                         
        if (!$db->getNumRows())            
            return ;              
        while ($items=$db->fetchObjects())
        {           
          // echo "<pre>"; var_dump($items->getSite()->get('hosts')); echo "</pre>";                                                      
           $this->outputLine(array(              
               $this->encode(mfCOnfig::getSuperAdmin('host')),   
               $this->encode($items->getSite()->get('site_company'),self::UPPERCASE),   
               $this->encode($items->getSite()->get('site_db_name'),self::UPPERCASE),              
               $this->encode($items->getSite()->get('hosts'),self::UPPERCASE),
               $this->encode($items->getSite()->get('site_admin_theme'),self::UPPERCASE),                                        
               $items->getSite()->get('last_connection')?format_date($items->getSite()->get('last_connection'),array("d","q")):__('No date'),
           ));
           
          
        }        
    }
    
    
         
    function execute()
    {    
                
          $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('Site'))                
                ->setQuery("SELECT {fields}, ".
                                " GROUP_CONCAT(".Site::getTableField('site_host')." SEPARATOR ',') as `Site.hosts` ".
                        " FROM ".Site::getTable().
                        " WHERE ".$this->getFilter()->getWhere().
                        " GROUP BY site_db_name".
                        ";")               
                ->makeSiteSqlQuery($this->site); 
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
         return str_replace(".","-",mfCOnfig::getSuperAdmin('host'))."-".date("Y-m-d-h-i-s").".csv";
    }
}