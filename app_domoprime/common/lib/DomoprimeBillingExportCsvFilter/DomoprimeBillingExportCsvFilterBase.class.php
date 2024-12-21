<?php

class DomoprimeBillingExportCsvFilterBase extends ExportCsvFilterBase {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $filter=null,$user=null;
    
    function __construct($filter,$user,$options=array(),$site=null) 
    {
       $this->user=$user;
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);      
       $this->filter=$filter;               
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
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/contracts/billings/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/contracts/billings/exports";        
    }
    
    function getHeader()
    {
        return array(
             
                $this->encode(__('Customer')),
               $this->encode(__('Phone')),
                $this->encode(__('Date')),
                $this->encode(__('Billing date')),
                $this->encode(__('Polluter')),
                $this->encode(__('Reference')),             
                $this->encode(__('Total Sale HT')),
                $this->encode(__('Tax amount')),
                $this->encode(__('Total Sale TTC')),
                $this->encode(__('Created at')),
                $this->encode(__('Last')),
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
           $this->outputLine(array(              
               $this->encode($items->getCustomer()->get('lastname'),self::UPPERCASE)." ".$this->encode($items->getCustomer()->get('firstname'),self::UPPERCASE),
               $this->encode($items->getCustomer()->get('phone'),self::UPPERCASE),
               (string)$items->getDomoprimeBilling()->getFormatter()->getDatedAt()->getFormatted(),
               (string)$items->getCustomerContract()->getFormatter()->getBillingAt()->getFormatted(),
               (string)$items->getPartnerPolluterCompany()->get('name'),
               $this->encode($items->getDomoprimeBilling()->get('reference')),
               $this->encode($items->getDomoprimeBilling()->getTotalSaleWithoutTax()),
               $this->encode($items->getDomoprimeBilling()->getTotalSaleTax()),
               $this->encode($items->getDomoprimeBilling()->getTotalSaleWithTax()),  
               (string)$items->getDomoprimeBilling()->getFormatter()->getCreatedAt()->getText(),
                $this->encode($items->getDomoprimeBilling()->get('is_last')=='YES'?__("Last"):""),  
           ));
           
          
        }        
    }
         
    function execute()
    {                               
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$this->getOption('lang')))
                ->setObjects(array('DomoprimeBilling','Customer','PartnerPolluterCompany','CustomerContract'                          
                                  ))
               // ->setAlias(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2'))
                ->setQuery($this->getFilter()->getQuery())               
                ->makeSiteSqlQuery($this->site); 
        $this->number_of_items=$db->getNumRows();    
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
         return __("customers")."-".__("contracts")."-".__('billings')."-".date("Y-m-d").".csv";
    }
}
