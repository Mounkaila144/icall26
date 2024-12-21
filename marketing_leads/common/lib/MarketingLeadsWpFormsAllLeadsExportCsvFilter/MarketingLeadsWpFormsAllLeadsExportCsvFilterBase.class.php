<?php

class MarketingLeadsWpFormsAllLeadsExportCsvFilterBase extends ExportCsvFilterBase {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $filter=null,$query=null;
    
    function __construct($filter,$options=array(),$site=null) 
    {
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-15')),$site);
       $this->filter=$filter;        
       $this->query=new  mfQuery();
       $this->execute();
    }        
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/wordpress/leads/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/wordpress/leads/exports";        
    }
    
    function getHeader()
    {
        //'id_wp','site_id','firstname','lastname','income','number_of_people','owner','energy',
//                                   'phone','email','address','postcode','city','country','is_active','created_at'
        //campaign
        return array(//__("WP ID"),
                     __("CAMPAIGN"),
                     __("LASTNAME"),
                     __("FIRSTNAME"),
                     __("PHONE"),
                     __("EMAIL"),
                     __("INCOME"),
                     __("NUMBER OF PEOPLE"),
                     __("OWNER"),
                     __("ENERGY"),
                     __("ADDRESS"),
                     __("POSTCODE"),
                     __("COUNTRY"),
                     __("CITY"),
                     __("CREATED AT")
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
       
        $str = str_replace("€", "[128]", $str);
        
        $str = mb_convert_encoding($str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));
        $str = str_replace("[128]",chr(128), $str);
        return $str;       
    }     
    
    protected function getItemsFromDatabase($db)
    {                         
        if (!$db->getNumRows())            
            return ;              
        while ($items=$db->fetchObjects())
        {           
            $this->outputLine(array(
                //$items->getMarketingLeadsWpForms()->get('id_wp'),//.iconv("UTF-8", "ISO-8859-1//TRANSLIT", " €"),
                $this->encode($items->hasMarketingLeadsWpLandingPageSite()?$items->getMarketingLeadsWpLandingPageSite()->get('campaign'):__('no campaign'),self::UPPERCASE), 
                $this->encode($items->getMarketingLeadsWpForms()->get('lastname'),self::UPPERCASE),
                $this->encode($items->getMarketingLeadsWpForms()->get('firstname'),self::UPPERCASE),
                $items->getMarketingLeadsWpForms()->get('phone')?$items->getMarketingLeadsWpForms()->get('phone'):"",
                $items->getMarketingLeadsWpForms()->get('email')?$items->getMarketingLeadsWpForms()->get('email'):"",
                format_number($items->getMarketingLeadsWpForms()->get('income',"0,00"),"#.00"),
                $items->getMarketingLeadsWpForms()->get('number_of_people'),
                __(ucfirst($items->getMarketingLeadsWpForms()->get('owner'))),
                __(ucfirst($items->getMarketingLeadsWpForms()->get('energy'))),
                $this->encode($items->getMarketingLeadsWpForms()->get('address'),self::UPPERCASE),
                $this->encode($items->getMarketingLeadsWpForms()->get('postcode'),self::UPPERCASE),
                $this->encode($items->getMarketingLeadsWpForms()->get('country'),self::UPPERCASE),
                $this->encode($items->getMarketingLeadsWpForms()->get('city'),self::UPPERCASE),
                $items->getMarketingLeadsWpForms()->get('created_at')?format_date($items->getMarketingLeadsWpForms()->get('created_at'),array("a","q")):__('no date'),
            ));
        }        
    }
         
    function execute()
    {                               
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setObjects(array('MarketingLeadsWpForms','MarketingLeadsWpLandingPageSite'
                                  ))
                ->setQuery("SELECT {fields} FROM ".MarketingLeadsWpForms::getTable().
                           " LEFT JOIN ".MarketingLeadsWpForms::getOuterForJoin('site_id').
                           " WHERE ". 
                           MarketingLeadsWpForms::getTableField('status')."='ACTIVE' ".
                           $this->getFilter()->getWhere('AND').                            
                           $this->getFilter()->getConditions()->getWhere("AND").  
                           " GROUP BY ".MarketingLeadsWpForms::getTableField('id').
                           " ORDER BY ".MarketingLeadsWpForms::getTableField("id")." ASC".
                           ";")              
                ->makeSiteSqlQuery($this->site); 
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
        return __("leads")."-".__("contacts")."-".date("Y-m-d").".csv";
    }
}

