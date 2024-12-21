<?php


class ProductItemsExportCsvFilterBase extends ExportCsvFilterBase{
   
        const UPPERCASE=1,TRIM=2;
    
    protected $filter=null;
    
    function __construct($filter,$options=array(),$site=null) 
    {
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);      
       $this->filter=$filter;    
       $this->execute();
    }        
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/product/items/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/product/items/exports";        
    }
    
    function getHeader()
    {
        return array(
                    
                $this->encode('product'),
                $this->encode('description'),
                $this->encode('reference'),
                $this->encode('sale_price'),
                $this->encode('input1'),
                $this->encode('input2'),
                $this->encode('unit'),
                $this->encode('content'),
                $this->encode('details'),
                $this->encode('coefficient'),
                $this->encode('thickness'),
                $this->encode('mark'),
                $this->encode('input3'),
                $this->encode('discount_price'),
                $this->encode('tva'),
                $this->encode('is_default'),
          
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
       if ($encode /*| self::UPPERCASE*/)
          $str= mb_strtoupper($str,$this->getOption('charset_from','UTF-8'));
       if ($encode | self::TRIM)
          $str= trim($str);
       if ($this->getOption('charset_to')=='ISO-8859-1')
            $str = str_replace("€", "[128]", $str); // Signe
       $str=mb_convert_encoding( $str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));
       if ($this->getOption('charset_to')=='ISO-8859-1')
            $str = str_replace("[128]",chr(128), $str);
        $str = str_replace("’","'", $str);
       return utf8_encode($str);      
    }        
    
    protected function getItemsFromDatabase($db)
    {      
        if (!$db->getNumRows())            
            return ;  
        while ($items=$db->fetchObjects())
        {  
            //var_dump($items->getProductItem());        $settings= new ProductItemSettings();

            $this->outputLine(array(             
               $this->encode(__($items->getProduct()->get('reference'))),
               $this->encode($items->getProductItem()->get('description')),
               $this->encode(__($items->getProductItem()->get('reference'))),
               $this->encode($items->getProductItem()->getFormatter()->getSalePriceWithoutTax()->getText('#.00')),
               $this->encode($items->getProductItem()->get('input1')),
               $this->encode($items->getProductItem()->get('input2')),
               $this->encode($items->getProductItem()->get('unit')),
               $this->encode($items->getProductItem()->get('content')),
               $this->encode($items->getProductItem()->get('details')),
               $this->encode($items->getProductItem()->get('coefficient')),
               $this->encode($items->getProductItem()->get('thickness')),
               $this->encode($items->getProductItem()->get('mark')),
               $this->encode($items->getProductItem()->get('input3')),
               $this->encode($items->getProductItem()->get('discount_price')),
               $this->encode($items->hasTax()?$items->getTax()->getFormattedTax():__('No tax')),
               $this->encode(__($items->getProductItem()->get('is_default'))),        
            ));
        }
                             
    }        
    
         
    function execute()
    {                               
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$this->getOption('lang')))
                ->setObjects(array('ProductItem','Product','Tax'))
                ->setQuery($this->getFilter()->getQuery())              
                ->makeSiteSqlQuery($this->site); 
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);   
        $this->close();
    }
            
    
    function getName()
    {
         return __('product')."-".__('items')."-".date("Y-m-d").md5(session_id()).".csv";
    }
    
}
