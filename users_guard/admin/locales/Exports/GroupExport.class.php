<?php


class GroupExport extends ExportCsvFilterBase {
    
    const UPPERCASE=1,TRIM=2;
    
    protected $group=null;
    
    function __construct(Group $group,$options=array(),$site=null) 
    {               
       $this->group=$group;           
       parent::__construct(array_merge($options,array('charset_from'=>'UTF-8','charset_to'=>'ISO-8859-1')),$site);              
       $this->execute();
    } 
    
    static function getDirectory()
    {               
        return mfConfig::get('mf_site_app_cache_dir')."/data/users/exports";        
    }
    
    function getGroup()
    {
        return $this->group;
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
               $items->getPermission()->get('name'),              
               ));
           
          
        }        
    }
    
    function execute()
    {                               
        $db=mfSiteDatabase::getInstance()
                ->setParameters(array('group_id'=>$this->getGroup()->get('id')))
                ->setObjects(array('Permission'))                
                ->setQuery("SELECT {fields} FROM ".Permission::getTable().
                            " INNER JOIN ".GroupPermission::getInnerForJoin('permission_id').
                            " WHERE ".Permission::getTableField('application')."='admin'".
                                  " AND ". GroupPermission::getTableField('group_id')."='{group_id}'".
                                  " AND ".Permission::getTableField('name')."!='superadmin'".
                           " ORDER BY ".Permission::getTableField('name')." ASC".
                           ";")               
                ->makeSqlQuery(); 
      //  echo $db->getQuery();
        $this->open();     
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    function getName()
    {
         return __("group")."-".$this->getGroup()->get('name')."-".date("Y-m-d")."-".md5(session_id()).".csv";
    }
  
}
