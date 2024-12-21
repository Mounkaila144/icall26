<?php


class DashboardUserSessionsExport extends ExportCsvFilterBase{
    
    const UPPERCASE=1,TRIM=2;
    
    protected $filter=null;
    
    function __construct($filter,$options=array(),$site=null) 
    {
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);
       $this->filter=$filter;        
       $this->execute();
    } 
    
    static function getDirectory()
    {               
        return mfConfig::get('mf_site_app_cache_dir')."/data/users/exports";        
    }
    
    
    function getHeader()
    {
        return array($this->encode(__("USERNAME")),
                     $this->encode(__("IP")),
                     $this->encode(__("START")),
                     $this->encode(__("END")),
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
            // var_dump($items->get('products'));                                                     
            $this->outputLine(array(
               $items->getUser()->get('username'),
               $items->getSession()->get('ip'),
               $items->getSession()->get('start_time')?format_date($items->getSession()->get('start_time'),array('d','q')):__('No date'),
               $items->getSession()->get('last_time')?format_date($items->getSession()->get('last_time'),array('d','q')):__('No date'),
            ));
        }        
    }
    
    function execute()
    {                               
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('Session','User'))
                //->setAlias(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2'))
                ->setQuery("SELECT {fields} FROM ".Session::getTable().
                            " INNER JOIN ".Session::getOuterForJoin('user_id').
                            " WHERE ".User::getTableField('application')."='superadmin'".
                                    $this->getFilter()->getWhere('AND').
                           " ORDER BY ".User::getTableField('username')." ASC".
                           ";")               
                ->makeSqlQuerySuperAdmin(); 
      //  echo $db->getQuery();
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
        return __("dashboard-users-sessions")."-".date("Y-m-d")."-".md5(session_id()).".csv";
    }
  
}
