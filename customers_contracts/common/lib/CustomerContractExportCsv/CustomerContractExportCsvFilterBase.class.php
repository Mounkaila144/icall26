<?php

class CustomerContractExportCsvFilterBase extends ExportCsvFilterBase {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $filter=null,$user=null;
    
    function __construct($filter,$user,$options=array(),$site=null) 
    {              
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-15')),$site);
       $this->filter=$filter;        
       $this->user=$user;
       $this->_query=new mfQuery();
       $this->alias=new mfArray(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2'));
        $this->objects=new mfArray(array('Customer','CustomerContract','CustomerAddress',
                                   'CustomerContractStatusI18n','CustomerContractStatus',
                                   'telepro'=>'User','sale1'=>'User','sale2'=>'User',                                
                                   'Partner','UserTeam',
                                  ));
       $this->setOption('lang',$this->getUser()->getCountry());      
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
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/contracts/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/contracts/exports";        
    }
    
    function getHeader()
    {
        return array(
                     __("ID"),
                     __("MEETING ID"),
                     __("DATE"),
                     __("INSTALL DATE"),
                     __("LASTNAME"),
                     __("FIRSTNAME"),
                     __("PHONE"),
                     __("MOBILE"),
                     __("PRODUCTS"),
                     __("DETAILS"),
                     __("HT"),
                     __("TVA Amount"),
                     __("TVA"),
                     __("TTC"),  
                     __("ADDRESS"),
                     __("POSTCODE"),
                     __("CITY"),
                     __("SALE1"),
                     __("SALE2"),
                     __("TELEPRO"),
                     __("TEAM"),                   
                     __("STATE"),
                     __("PAYMENT"),
                     __("INSTALL DATE"),
                     __("CREATION")
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
       if ($this->getOption('charset_to')=='ISO-8859-15')
            $str = str_replace("€", "[128]", $str); // Signe
       $str=mb_convert_encoding( $str ,$this->getOption('charset_to','UTF-8'),$this->getOption('charset_from','UTF-8'));
       if ($this->getOption('charset_to')=='ISO-8859-15')
            $str = str_replace("[128]",chr(128), $str);
       return $str;       
    }        
    
    protected function getItemsFromDatabase($db)
    {                         
        if (!$db->getNumRows())            
            return ;              
        while ($items=$db->fetchObjects())
        {           
          // var_dump($items->get('products'));          
           if ($items->hasTax())          
              $items->getCustomerContract()->set('tax_id',$items->getTax());                                           
           $this->outputLine(array(
               $items->getCustomerContract()->get('id'),
               $items->getCustomerContract()->get('meeting_id'),
               $items->getCustomerContract()->get('opened_at')?format_date($items->getCustomerContract()->get('opened_at'),"a"):__('no date'),
               $items->getCustomerContract()->get('opc_at')?format_date($items->getCustomerContract()->get('opc_at'),"a"):__('no date'),
               $this->encode($items->getCustomer()->get('lastname'),self::UPPERCASE),
               $this->encode($items->getCustomer()->get('firstname'),self::UPPERCASE),
               $items->getCustomer()->get('phone'),
               $items->getCustomer()->get('mobile'),
               $this->encode($items->get('products',__('no product')),self::UPPERCASE),
               $items->getCustomerContract()->get('remarks'),
               format_number($items->getCustomerContract()->get('total_price_without_taxe',"0,00"),"#.00"),  // HT,
               format_number(($items->hasTax()?$items->getCustomerContract()->getTaxAmount():0),"#.00"), // TVA amount
               ($items->hasTax()?$items->getCustomerContract()->getFormattedTaxRate():__("No tax")),  // TVA rate     
               format_number($items->getCustomerContract()->get('total_price_with_taxe',"0,00"),"#.00"),  //TTC
               $this->encode($items->getCustomerAddress()->get('address1')." ".$items->getCustomerAddress()->get('address2'),self::UPPERCASE),
               $this->encode($items->getCustomerAddress()->get('postcode'),self::UPPERCASE),
               $this->encode($items->getCustomerAddress()->get('city'),self::UPPERCASE),               
               $this->encode($items->hasSale1()?$items->getSale1():__("no sale"),self::UPPERCASE),
               $this->encode($items->hasSale2()?$items->getSale2():__("no sale"),self::UPPERCASE),
               $this->encode($items->hasTelepro()?$items->getTelepro():__("no telepro"),self::UPPERCASE),
               $this->encode($items->hasUserTeam()?$items->getUserTeam()->get('name'):__("no team"),self::UPPERCASE),               
               $this->encode($items->hasCustomerContractStatus()?$items->getCustomerContractStatusI18n():__("Not defined"),self::UPPERCASE),
               $this->encode($items->hasPartner()?$items->getPartner()->get('name'):__("Not defined"),self::UPPERCASE),               
               $items->getCustomerContract()->get('sav_at')?format_date($items->getCustomerContract()->get('sav_at'),"a"):__('no date'),
               format_date($items->getCustomerContract()->get('created_at'),"a"),
           ));
           
          
        }        
    }
         
    function getMfQuery()
    {
        return $this->_query;
    }
    
    function execute()
    {                     
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$this->getOption('lang'),'user_id'=>$this->getUser()->getGuardUser()->get('id')))
                ->setObjects($this->getObjects()->toArray())
                ->setAlias($this->getAlias()->toArray())
                ->setQuery("SELECT {fields} ".
                                ",(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerContractProduct::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                                  ") as products ".
                           " FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id','telepro'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id','sale1'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id','sale2').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('team_id').
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id'). 
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'".  
                           " WHERE ". 
                           CustomerContract::getTableField('status')."='ACTIVE'".
                           $this->getFilter()->getWhere('AND').
                           " ORDER BY opened_at ASC".
                           ";")               
                ->makeSiteSqlQuery($this->site); 
        $this->number_of_items=$db->getNumRows();
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
         return __("customers")."-".__("contracts")."-".date("Y-m-d")."-".md5(session_id()).".csv";
    }
    
     function getObjects()
    {
        return $this->objects;
    }
    
    function getAlias()
    {
        return $this->alias;
    }
}

