<?php

class CustomerMeetingExportCsvFilterBase extends ExportCsvFilterBase {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $filter=null,$settings=null;
    
    function __construct($filter,$options=array(),$site=null) 
    {           
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);
       $this->filter=$filter;              
       $this->settings= CustomerMeetingSettings::load($site);
       $this->objects=new mfArray(array('Customer','CustomerMeeting','CustomerAddress','Callcenter',
                                   'CustomerMeetingStatusI18n','CustomerMeetingStatus',
                                   'CustomerMeetingStatusCall','CustomerMeetingStatusCallI18n',
                                   'telepro'=>'User','sale1'=>'User','sale2'=>'User','assistant'=>'User','creator'=>'User'));
       $this->alias=new mfArray(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2','assistant'=>'assistant','creator'=>'creator'));
       $this->_query=new mfQuery();
       $this->execute();
    }   
    
    function getMfQuery()
    {
        return $this->_query;
    }
    
    function getSettings()
    {
        return $this->settings;
    }
    
    static function getDirectory($site=null)
    {       
        if ($site)
        {    
            $site_name=($site instanceof Site)?$site->get('site_host'):mfConfig::get('mf_site_host');
            return mfConfig::get('mf_site_app_cache_dir')."/".$site_name."/data/meetings/exports"; 
        }
        return mfConfig::get('mf_site_app_cache_dir')."/data/meetings/exports";        
    }
    
    function getHeader()
    {        
        $header_fields=array();
        $header_fields[]=__("ID");
        $header_fields[]=__("DATE");
        $header_fields[]=__("HOUR");
        $header_fields[]=__("LASTNAME");
        $header_fields[]=__("FIRSTNAME");
        $header_fields[]=__("PHONE");
        $header_fields[]=__("MOBILE");
        $header_fields[]=__("EMAIL");
        $header_fields[]=__("ADDRESS");
        $header_fields[]=__("POSTCODE");
        $header_fields[]=__("CITY");
        $header_fields[]=__("SALE1");
        $header_fields[]=__("SALE2");
        $header_fields[]=__("TELEPRO");
        if ($this->getSettings()->hasAssistant())       
            $header_fields[]=__("ASSISTANT");          
        $header_fields[]=__("TEAM");
         if ($this->getUser()->hasCredential(array(array('superadmin','meeting_export_csv_callcenter'))))   
        {           
            $header_fields[]=__("CALLCENTER");           
        }
        if ($this->getUser()->hasCredential(array(array('superadmin','meeting_export_csv_callcenter_status')))) 
        {                  
           $header_fields[]=__("CALLCENTER STATUS");         
        }
        $header_fields[]=__("STATE");
        $header_fields[]=__("REMARKS");     
        if ($this->getUser()->hasCredential(array('superadmin','meeting_export_csv_created_date')))   
        {
            $header_fields[]=__("TAKE AT");
            $header_fields[]=__("AT");
        }
        $header_fields[]=__("PRODUCTS");
        $header_fields[]=__("DETAILS");
        if ($this->getSettings()->hasTreatedDate() && $this->getUser()->hasCredential(array('superadmin','meeting_export_csv_treated_date'))) 
        {    
            $header_fields[]=__("TREATMENT AT");
            $header_fields[]=__("AT");
        }   
        $header_fields[]=__("CREATED AT");
        $header_fields[]=__("AT");
        $header_fields[]=__("CREATED BY");
        if ($this->getUser()->hasCredential(array('superadmin','meeting_export_csv_status')))        
            $header_fields[]=__("STATUS");                  
        return $header_fields;       
    }
    
    function getUser()
    {
       return $this->getFilter()->getUser();    
    }
    
    function getFilter()
    {        
        return $this->filter;
    }
    
    function outputLine($data)
    {     
       // var_dump($data); die(__METHOD__);
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
         /*  if ($items->getCustomerMeeting()->hasCallcenter())     
           {                     
                echo "<pre>"; var_dump($items->getCallcenter(),$items->hasCallcenter());   echo "<pre>"; 
                die(__METHOD__);
           }*/
           $fields=array();
           $fields[]= $items->getCustomerMeeting()->get('id');
           $fields[]= $items->getCustomerMeeting()->get('in_at')?format_date($items->getCustomerMeeting()->get('in_at'),"a"):__('no date');
           $fields[]= $items->getCustomerMeeting()->get('in_at')?date("H:i",strtotime($items->getCustomerMeeting()->get('in_at'))):__("no time");
           $fields[]=  $this->encode($items->getCustomer()->get('lastname'),self::UPPERCASE);
           $fields[]= $this->encode($items->getCustomer()->get('firstname'),self::UPPERCASE);
           $fields[]= $items->getCustomer()->get('phone');
           $fields[]= $items->getCustomer()->get('mobile');
           $fields[]= $items->getCustomer()->get('email');                                       
           $fields[]= $this->encode($items->getCustomerAddress()->get('address1')." ".$items->getCustomerAddress()->get('address2'),self::UPPERCASE);
           $fields[]= $this->encode($items->getCustomerAddress()->get('postcode'),self::UPPERCASE);
           $fields[]= $this->encode($items->getCustomerAddress()->get('city'),self::UPPERCASE);           
           $fields[]= $this->encode($items->hasSale1()?$items->getSale1():__("no sale"),self::UPPERCASE);
           $fields[]= $this->encode($items->hasSale2()?$items->getSale2():__("no sale"),self::UPPERCASE);
           $fields[]= $this->encode($items->hasTelepro()?$items->getTelepro():__("no telepro"),self::UPPERCASE);
           if ($this->getSettings()->hasAssistant())       
                $fields[]= $this->encode($items->hasAssistant()?$items->getAssistant():__("no assistant"),self::UPPERCASE);
           $fields[]=$this->encode($items->team?$items->team:__("No team"),self::UPPERCASE);
           if ($this->getUser()->hasCredential(array(array('superadmin','meeting_export_csv_callcenter')))) 
           {                  
                $fields[]=$this->encode(($items->hasCallcenter()?$items->getCallcenter()->get('name'):__("no callcenter")),self::UPPERCASE);      
           }
           if ($this->getUser()->hasCredential(array(array('superadmin','meeting_export_csv_callcenter_status')))) 
           {                  
               $fields[]=$this->encode($items->hasCustomerMeetingStatusCall()?$items->getCustomerMeetingStatusCallI18n()->get('value'):__("Not defined"),self::UPPERCASE); 
           }
           $fields[]= $this->encode($items->hasCustomerMeetingStatus()?$items->getCustomerMeetingStatusI18n()->get('value'):__("Not defined"),self::UPPERCASE);
           $fields[]= $this->encode($items->getCustomerMeeting()->get('remarks'));        
           if ($this->getUser()->hasCredential(array('superadmin','meeting_export_csv_created_date')))   
           {
                $fields[]= $items->getCustomerMeeting()->get('created_at')?format_date($items->getCustomerMeeting()->get('created_at'),"a"):__('no date');
                $fields[]= $items->getCustomerMeeting()->get('created_at')?date("H:i",strtotime($items->getCustomerMeeting()->get('created_at'))):__("no time");           
           }
           $fields[]= $items->get('products',__('no product'));   
           $fields[]=""; // DETAILS
           if ($this->getSettings()->hasTreatedDate() && $this->getUser()->hasCredential(array('superadmin','meeting_export_csv_treated_date')))   
           {    
               $fields[]=$items->getCustomerMeeting()->get('treated_at')?format_date($items->getCustomerMeeting()->get('treated_at'),"a"):__('no date');    
               $fields[]= $items->getCustomerMeeting()->get('treated_at')?date("H:i",strtotime($items->getCustomerMeeting()->get('treated_at'))):__("no time");           
           }
           $fields[]= $items->getCustomerMeeting()->get('creation_at')?format_date($items->getCustomerMeeting()->get('creation_at'),"a"):__('no date');
           $fields[]= $items->getCustomerMeeting()->get('creation_at')?date("H:i",strtotime($items->getCustomerMeeting()->get('creation_at'))):__("no time");           
           $fields[]= $this->encode($items->hasCreator()?$items->getCreator():__("unknown creator"),self::UPPERCASE);
           if ($this->getUser()->hasCredential(array('superadmin','meeting_export_csv_status','meeting_export_csv_deleted_status')))     
                $fields[]= $this->encode(__($items->getCustomerMeeting()->get('status')),self::UPPERCASE);
           $this->outputLine($fields);                     
        }        
    }
         
    function execute()
    {              
        $db=new mfSiteDatabase();
                $db->setParameters(array('lang'=>$this->getOption('lang')))
                ->setObjects(array('Customer','CustomerMeeting','CustomerAddress',
                                   'CustomerMeetingStatusI18n','CustomerMeetingStatus',
                                   'telepro'=>'User','sale1'=>'User','sale2'=>'User', 
                                   'assistant'=>'User','creator'=>'User','Callcenter'
                                  ))
                ->setAlias(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2','assistant'=>'assistant','creator'=>'creator'))
                ->setQuery("SELECT {fields} ".
                                ",(SELECT GROUP_CONCAT(UPPER(meta_title) ORDER BY meta_title SEPARATOR ',') FROM ".Product::getTable().
                                   " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('product_id').
                                   " WHERE ".CustomerMeetingProduct::getTableField('meeting_id')."=".CustomerMeeting::getTableField('id').
                                  ") as products ".
                           " FROM ".CustomerMeeting::getTable().
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('customer_id').  
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('telepro_id','telepro'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('assistant_id','assistant'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sales_id','sale1'). 
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('sale2_id','sale2').     
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('created_by_id','creator').   
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('callcenter_id').    
                           " LEFT JOIN ".CustomerMeeting::getOuterForJoin('status_call_id'). 
                           " LEFT JOIN ".CustomerMeetingStatusCallI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusCallI18n::getTableField('lang')."='{lang}'".
                         //  " LEFT JOIN ".CustomerContract::getOuterForJoin('team_id').
                           " LEFT JOIN ".CustomerMeetingProduct::getInnerForJoin('meeting_id'). 
                           " LEFT JOIN ".CustomerMeetingStatusI18n::getInnerForJoin('status_id')." AND ".CustomerMeetingStatusI18n::getTableField('lang')."='{lang}'".  
                           " WHERE ". 
                           CustomerMeeting::getTableField('status')."='ACTIVE'".
                           $this->getFilter()->getWhere('AND').
                           " ORDER BY in_at ASC".
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
         return __("customers")."-".__("meetings")."-".date("Y-m-d")."-".md5(session_id()).".csv";
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

