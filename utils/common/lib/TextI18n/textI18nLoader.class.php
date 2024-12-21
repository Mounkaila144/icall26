<?php


class TextI18nLoader {
    
    static protected $instance=null;
    
    protected   $translator=null,
                $messages=array(),
                $culture="",
                $site,
                $class=null,
                $filename="";
    
    function getInstance($class,$culture=null,$site=null)
    {
       if (self::$instance==null)
           self::$instance=new self($class,$culture,$site);
       return self::$instance;
    }
    
    function __construct($class,$culture,$site=null)
    {
       $this->class=$class;
       $this->culture= $culture ? $culture : mfContext::getInstance()->getUser()->getCulture();        
       $this->site=$site;
       $this->filename=mfConfig::get('mf_site_app_cache_dir')."/i18n/".$this->culture."/".$this->class."/messages.csv";
       $this->translator=mfContext::getInstance()->getI18N();
       $this->getText();                    
    }        
    
    protected function load()
    {
        $this->messages=array();
        $class=$this->class;
        $db=mfSiteDatabase::getInstance();        
        $language=explode("_",$this->culture);           
        $db->setParameters(array('lang'=>$language[0]))
           ->setQuery("SELECT * FROM ".$class::getTable()." WHERE lang='{lang}';")
           ->makeSiteSqlQuery($this->site);                         
        if (!$db->getNumRows())
            return ;       
        while ($row=$db->fetchArray())
            $this->messages[$row['key']]=$row['text'];                 
    }            
    
    function getText()
    {      
        if (is_readable($this->getFilename()))
        {                       
            $this->translator->addExternalMessageSources(dirname($this->getFilename()));
            return ;
        }    
        $this->load();       
        $this->save();        
        $this->translator->setMessages($this->messages);        
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
    
    protected function convertToCSV()
    {
        $messages="";
        foreach ($this->messages as $name=>$texte)
            $messages.='"'.$name.'";"'.str_replace(array('"'),array('""'),$texte)."\"\n";
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


