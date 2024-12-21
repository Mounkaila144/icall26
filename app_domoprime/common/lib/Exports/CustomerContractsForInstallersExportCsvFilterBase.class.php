<?php

class CustomerContractsForInstallersExportCsvFilterBase extends ExportCsvFilterBase {
    
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
        return mfConfig::get('mf_site_app_cache_dir')."/data/domoprime/exports";        
    }
    
    function getHeader()
    {
        return array(               
                    __('FIRSTNAME'),
                    __('LASTNAME'),
                    __('PHONE'),
                    __('MOBILE'),
                    __('POSTCODE'),
                    __('CITY'),
                    __('INSTALL DATE'),
                    __('PRODUCT'),                  
                    __('CUMAC'),                  
                    __('ARTICLE'),  
                    __('SURFACE'), 
                    __('INSTALLER'),
                    __('CUSTOMER BONUS'),
                    __('STATE')
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
              
               $this->encode($items->getCustomer()->get('lastname'),self::UPPERCASE),
               $this->encode($items->getCustomer()->get('firstname'),self::UPPERCASE),
               $items->getCustomer()->get('phone'),
               $items->getCustomer()->get('mobile'),             
               $this->encode($items->getCustomerAddress()->get('postcode'),self::UPPERCASE),
               $this->encode($items->getCustomerAddress()->get('city'),self::UPPERCASE), 
               $items->getCustomerContract()->hasOpcAt()?$items->getCustomerContract()->getFormatter()->getOpcAt()->getText():__("NOT DEFINED"),
               $items->hasProduct()?$this->encode($items->getProduct()->get('reference'),self::UPPERCASE):__("NOT DEFINED"),  
               $items->getDomoprimeProductCalculation()->getFormatter()->getCumac(),                    
               $items->hasProductItem()?$this->encode($items->getProductItem()->get('reference'),self::UPPERCASE):__("NOT DEFINED"), 
               $items->hasDomoprimeQuotationProductItem()?$items->getDomoprimeQuotationProductItem()->getFormattedQuantity():__("---"),
               $items->hasPartner()?$this->encode($items->getPartner()->get('name'),self::UPPERCASE):__("NOT DEFINED"),
               $items->hasDomoprimeQuotation()?$items->getDomoprimeQuotation()->getFormatter()->getPrime():__("---"),  
               $items->hasCustomerContractStatus() && $items->hasCustomerContractStatusI18n()?$this->encode((string)$items->getCustomerContractStatusI18n(),self::UPPERCASE):__("---") ,  
           ));
           
          
        }        
    }
         
    function execute()
    {                               
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lang'=>$this->getOption('lang',mfContext::getInstance()->getUser()->getCountry())))
                ->setObjects(array('Customer',
                                   'CustomerContract',
                                   'CustomerAddress',
                                   'DomoprimeProductCalculation',
                                   'Product',
                                   'DomoprimeQuotation',
                                   'DomoprimeQuotationProduct',
                                   'DomoprimeQuotationProductItem',
                                   'ProductItem',
                                 //  'ProductInstallerSchedule',
                                   'CustomerContractStatus','CustomerContractStatusI18n',
                                   'Partner'
                                  ))
               // ->setAlias(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2'))
                ->setQuery("SELECT {fields} ".                                
                           " FROM ".CustomerContract::getTable().
                           " INNER JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " INNER JOIN ".CustomerAddress::getInnerForJoin('customer_id').   
                           //" INNER JOIN ".CustomerContract::getOuterForJoin('meeting_id').
                           " INNER JOIN ".DomoprimeCalculation::getInnerForJoin('contract_id').
                           " INNER JOIN ".DomoprimeProductCalculation::getInnerForJoin('calculation_id').
                         //  " INNER JOIN ".DomoprimeProductCalculation::getOuterForJoin('product_id').
                           " LEFT JOIN ".DomoprimeQuotation::getInnerForJoin('contract_id')." AND ".DomoprimeQuotation::getTableField('status')."='ACTIVE'".
                           " LEFT JOIN ".DomoprimeQuotationProduct::getInnerForJoin('quotation_id')." AND ".DomoprimeProductCalculation::getTableField('product_id')."=".DomoprimeQuotationProduct::getTableField('product_id').
                           " LEFT JOIN ".DomoprimeQuotationProduct::getOuterForJoin('product_id').
                           " LEFT JOIN ".DomoprimeQuotationProductItem::getInnerForJoin('quotation_product_id').
                           " LEFT JOIN ".DomoprimeQuotationProductItem::getOuterForJoin('item_id').
                        //   " INNER JOIN ".ProductInstallerSchedule::getInnerForJoin('contract_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'".
                           " WHERE ". 
                           DomoprimeCalculation::getTableField('isLast')."='YES' AND ".
                           DomoprimeProductCalculation::getTableField('qmac')." >0 AND ".    
                        //   DomoprimeQuotation::getTableField('status')."='ACTIVE' AND ".
                         //  ProductInstallerSchedule::getTableField('status')."='ACTIVE' AND ".
                           CustomerContract::getTableField('status')."='ACTIVE' ".
                           $this->getFilter()->getWhere('AND').                        
                           " ORDER BY ".CustomerContract::getTableField('opc_at')." ASC".
                           ";")               
                ->makeSiteSqlQuery($this->site); 
    // echo $db->getQuery(); die(__METHOD__);
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
         return __("contracts")."-".__('installations')."-".date("Y-m-d")."-".md5(session_id()).".csv";
    }
}

