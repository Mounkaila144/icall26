<?php


class TextEmailI18nLoader {
        
    static $instances=array(),$translator=null;
    
    protected   $messages=array(),
                $culture="",
                $site,
                $module=null,
                $key=null,
                $filename="";
    
    static function getInstance($module,$key,$site=null,$culture=null)
    {
        $culture= $culture ? $culture : mfContext::getInstance()->getUser()->getCulture();   
        $id=$module.".".$key.".".$culture;
        if (!self::$translator)
             self::$translator=mfContext::getInstance()->getI18N();
        if (!isset(self::$instances[$id]))            
            self::$instances[$id]=new self($module,$key,$culture,$site);
        return self::$instances[$id];   
    }
    
    function __construct($module,$key,$culture="",$site=null)
    {
       $this->module=$module;
       $this->key=$key;
       $this->culture= $culture;       
       $this->site=$site;
       $this->filename=mfConfig::get('mf_site_app_cache_dir')."/i18n/".$this->culture."/emails/".$this->module."/".$this->key."/messages.csv";          
       $this->getText();                    
    }        
    
    protected function load()
    {
        $this->messages=array();       
        $db=mfSiteDatabase::getInstance();        
        $language=explode("_",$this->culture);                     
        $db->setParameters(array('lang'=>$language[0],'module'=>$this->module,"key"=>$this->key))
           ->setQuery("SELECT * FROM ".TextEmailI18n::getTable()." WHERE `module`='{module}' AND `key`='{key}' AND `lang`='{lang}';")
           ->makeSiteSqlQuery($this->site);                         
        if (!$db->getNumRows())
            return ;       
        while ($row=$db->fetchArray())
        {        
            $this->messages[$row['key']."_BODY"]=$row['body'];         
            $this->messages[$row['key']."_SUBJECT"]=$row['subject'];         
        }       
    }            
    
    function getText()
    {      
        if (is_readable($this->getFilename()))
        {                           
            self::$translator->addExternalMessageSources(dirname($this->getFilename()));
            return ;
        }    
        $this->load();       
        $this->save();        
        self::$translator->setMessages($this->messages);         
    }
    
    protected function save()
    {       
        if (($messages=$this->convertToCSV()))
        {
            if (!is_dir(dirname($this->getFilename())))
                @mkdir(dirname($this->getFilename()), 0777, true);
            file_put_contents($this->getFilename(), $messages);
        } 
    }
    
    function getFilename()
    {          
       return $this->filename;
    }
    
    protected function escape($text)
    {
        return str_replace(array('"'),array('""'),$text);
    }   
    
    protected function convertToCSV()
    {
        $messages="";
        foreach ($this->messages as $name=>$texte)
            $messages.='"'.$name.'";"'.$this->escape($texte)."\"\n";
        return $messages;
    }
    
  /*  function remove($culture="*")
    {
       $dir=mfConfig::get('mf_site_app_cache_dir')."/i18n/".$culture."/".$this->class;
       foreach (glob($dir."/messages.csv") as $file)
       {
           if (is_readable($file))
               unlink($file);
       }
       
    }*/
}


