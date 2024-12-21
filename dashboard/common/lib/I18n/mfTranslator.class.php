<?php


abstract class mfTranslator {
    
    protected   $translator,
                $messagesTranslated=array(),
                $culture="",
                $site=null,
                $type="translator",
                $name="",
                $filename="";
    
    abstract   protected  function translateItems($items);
    
    function __construct($options=array(),$site=null) {
        $this->site=$site;         
        if (isset($options['culture']))
            $this->culture=$options['culture'];
        if (isset($options['type']))                   
            $this->type= $options['type'];        
        if (isset($options['name']))
            $this->setName($options['name']);        
    }       
    
    function getSite()
    {
        return $this->site;
    }
    
    public function getMessagesPath()
    {
        return $this->dirname;
    }
    
    protected function translateMessage($text, $module,$catalog='messages') {      
        if (!isset($this->messagesTranslated[$text])) {            
            // Load module messages  to translate               
            if ($module)
            {                   
              //  $this->translator->setMessageAllSourcesModule($module);
            //    var_dump($module);
                $this->translator->setMessageSourcesModule($module);
            }             
            $texteTranslated = $this->translator->__($text,array(),$catalog); 
            if ($text != $texteTranslated)
                $this->messagesTranslated[$text] = $texteTranslated;
        }
    }      
       
    
    protected function convertCSV()
    {
        $messagesCSV="";        
        foreach ($this->messagesTranslated as $name=>$texte)
        {
            $messagesCSV.='"'.$name.'";"'.$texte."\"\n";
        }   
        return $messagesCSV;
    }
    
     
    protected function setName($name)
    {       
        $this->name=$name;
        if ($this->site)
        {           
            $name=$this->name."/".$this->getSite()->get('site_host');        
        }    
        $this->dirname=mfConfig::get('mf_site_app_cache_dir')."/i18n/".$this->type."/".$this->culture."/".$name;
        $this->filename=$this->dirname."/messages.csv";    
    }
    
    function getMessageCacheDirectory()
    {
        if ($this->site)
        {           
            $name=$this->name."/".$this->getSite()->get('site_host');        
        }   
        else
        {
            $name=$this->name;
        }    
        return self::getI18nDirectory()."/".$this->type."/".$this->culture."/".$name."/";
    }
    
    function translate($items)
    {                   
        if (is_readable($this->filename))
            return $this;
        $i18n=mfContext::getInstance()->getI18n();
        $this->translator=clone $i18n;
        $this->translateItems($items);        
        $this->save();      
        return $this;
    }
    
    protected function save()
    {       
       if (($messagesTranslated=$this->convertCSV())) {              
            mfFileSystem::mkdirs($this->dirname);                  
            file_put_contents($this->filename, $messagesTranslated);
        } 
    }
    
    function setI18nSource()
    {
       // var_dump($this->getMessageCacheDirectory());
        $i18n=mfContext::getInstance()->getI18n();         
        $i18n->addExternalMessageSources($this->getMessageCacheDirectory());
    }
    
    static function getI18nDirectory()
    {
        return mfConfig::get('mf_site_app_cache_dir')."/i18n";
    }
        
    static function removeCache($type='translator',$site=null)
    {                    
      if ($site==null)
          $site=mfContext::getInstance()->getSite()->getSite();
      $dirs=array_merge(glob(mfConfig::get('mf_cache_dir').'/sites/'.$site->getHost()."/*/*/i18n/".$type."/*",GLOB_ONLYDIR),
              glob(mfConfig::get('mf_cache_dir').'/sites/'.mfConfig::getSuperAdmin('host')."/*/*/i18n/".$type."/*",GLOB_ONLYDIR)
              );    
      mfFilesystem::net_rmdirs($dirs);   
    }
    
}

