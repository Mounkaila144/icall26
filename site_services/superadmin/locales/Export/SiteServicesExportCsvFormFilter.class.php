<?php


class SiteServicesExportCsvFormFilter extends ExportCsvFilterBase {
     
    const UPPERCASE=1,TRIM=2;
    
    protected $filter=null;
    
    function __construct($filter,$options=array()) 
    {
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);
       $this->filter=$filter;              
    }        
    
    static function getDirectory()
    {               
        return mfConfig::get('mf_site_app_cache_dir')."/data/sites/exports";        
    }
    
    function getHeader()
    {
        return array(
                     __("SERVER"),    
                     __("COMPANY"),    
                     __("DESCRIPTION"),  
                     __("DATABASE"),              
                     __("HOSTS"),
                     __("ADMIN THEME"),                               
                     __("LAST CONNEXION"),
                     __("SITE SIZE"),
                     __("DB SIZE"),
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
               $this->encode($items->getSiteServicesServer()->get('name')),   
               $this->encode($items->getSiteServicesSite()->get('company'),self::UPPERCASE),   
               $this->encode($items->getSiteServicesSite()->get('description')),   
               $this->encode($items->getSiteServicesSite()->get('db_name'),self::UPPERCASE),              
               $this->encode($items->getSiteServicesSite()->get('hosts'),self::UPPERCASE),
               $this->encode($items->getSiteServicesSite()->get('admin_theme'),self::UPPERCASE),                                        
               $items->getSiteServicesSite()->hasLastConnection()?format_date($items->getSiteServicesSite()->get('last_connection'),array("d","q")):__('NO DATE'),
               $items->getSiteServicesSite()->getSiteSize(),                                    
               $items->getSiteServicesSite()->getDatabaseSize(),
           ));         
        }        
    }
    
    
         
    function execute()
    {    
                
          $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('SiteServicesSite','SiteServicesServer'))                
                ->setQuery("SELECT {fields}, ".
                                " GROUP_CONCAT(".SiteServicesSite::getTableField('host')." SEPARATOR ',') as `SiteServicesSite.hosts` ".
                        " FROM ".SiteServicesSite::getTable().
                        " INNER JOIN ".SiteServicesSite::getOuterForJoin('server_id').
                        $this->getFilter()->getWhere().                       
                        " GROUP BY db_name".
                        " ORDER BY ".SiteServicesServer::getTableField('name')." ASC".
                        ";")               
                ->makeSqlQuerySuperAdmin();   
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
         return "sites"."-".date("Y-m-d-h-i-s").".csv";
    }
}