<?php



class SystemTabBase extends mfObject3 {
 
    protected static $fields=array('tab','name','module','position','created_at','updated_at');
    const table="t_system_tab";
    protected $tabs=null;
    protected static $instance=array();
            
    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);
        $this->getDefaults(); 
        if ($parameters===null) return $this; 
        if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['id']))
                return $this->loadById((string)$parameters['id']);
            return $this->add($parameters); 
        }              
    }  
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
    
    protected function executeIsExistQuery($db)    
    {
       $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
        $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' ".$key_condition)
           ->makeSqlQuery();  
    }
    
    static function load($name)
    {
       if (self::$instance[$name]===null) 
       { 
          self::$instance[$name]=new self();
          self::$instance[$name]->loadTabs($name);
       }
       return self::$instance[$name];
    }
    
    function getTabManager()
    {
        return $this->tab_manager;
    }
    
     function loadTabs($tab){
        if ($this->tabs===null)
        {    
            $this->tab_name=$tab;         
           // var_dump(mfConfig::get('mf_site_app_cache_dir')."/i18n/".mfcontext::getInstance()->getRequest()->getCulture()."/system.tab.".$this->tab_name);
           // die(__METHOD__);           
            mfContext::getInstance()->getI18n()->addExternalMessageSources(
                    mfConfig::get('mf_site_app_cache_dir')."/i18n/tabs/".mfcontext::getInstance()->getRequest()->getCulture()."/system.tab.".$this->tab_name);
                        
            // test cache
           $cache= new mfCacheFile('tabs.'.$tab,'admin');
            if ($cache->isCached())       
            {             
                $this->tabs=unserialize($cache->read());  
                $this->translate($this->tabs);   	
                return $this->tabs;
            }                   
            $this->tabs=new mfArray();                        
            $this->tab_manager= TabsManager::getInstance($tab)->getSortedTabs();         
            $this->build($tab);                                     
            foreach ($this->getSystemTabs()->getAll() as $item){
               $this->tabs[$item->get('name')]=$this->tab_manager[$item->get('name')];
            }             
          
            $this->translate($this->tabs);   	
            // mise en cache          
            $cache->register(serialize($this->tabs));                 
        }
        return $this;
    }          
    
    function getTabs()
    {
      return $this->tabs;
    }
    
    function getSortedTabs()
    {     
      return $this->tabs;
    }
    
    function hasTabs()
    {
        return !empty($this->tabs);
    }      
    
    function build($tab_name){ 
                
        $tab_names=array_keys($this->tab_manager);        
                
        $db = mfSiteDatabase::getInstance()
           ->setQuery("DELETE FROM ". SystemTab::getTable()." WHERE name NOT IN ('".implode("','",$tab_names)."');")
           ->makeSqlQuery();        
        // get existing tabs
        $db->setQuery("SELECT * FROM ".SystemTab::getTable()." WHERE name IN ('".implode("','",$tab_names)."');")
           ->makeSqlQuery(); 
        // Update existing tabs
                        
        if ($db->getNumRows())
        {    
          while ($item=$db->fetchObject('SystemTab'))
          {      
              if (($key=array_search($item->get('name'), $tab_names)) !== false)  // unset($tabs_names[$item->get('name')]);              
                  unset($tab_names [$key]);
          }       
        }
        // New tabs       
        $collection=new SystemTabCollection();
                
        foreach ($tab_names as $name=>$tab)
        {                  
            $item=new SystemTab();            
            $collection[]=$item->add(['tab'=>$tab_name,'name'=>$tab,'position'=>$name+1,'module'=>(isset($this->tab_manager[$tab]['module'])?$this->tab_manager[$tab]['module']:NULL)]);
            //var_dump($item->get('name'));
        }    
        $collection->save();                
        if(mfConfig::get('mf_i18n')){                   
            $this->translator=new SystemTabTranslator(array('culture'=>mfcontext::getInstance()->getRequest()->getCulture(),'name'=>'system.tab.'.$tab_name,'type'=>'tabs'));
            $this->translator->translate($this->tab_manager);
         //   $this->translator->setI18nSource();                
        }         
        return $this;
    }
    
    
    static function updatePositions($tab,mfArray $positions,SystemTabCollection $tabs)
    {            
         if ($positions->isEmpty())
            return ;
         $db=mfSiteDatabase::getInstance();
         foreach ($positions as $position=>$id)
         {    
                $db->setParameters(array('position'=>$position+1,'tab'=>$tab,'id'=>$id))
                   ->setQuery("UPDATE ". SystemTab::getTable()." SET position={position} ".
                              " WHERE id={id} AND tab='{tab}'".                       
                              ";")               
                ->makeSqlQuery(); 
         }                        
         self::removeCache($tab);
         $tabs->clear()->getAll();
        return $this;
    }
   
    function getSystemTabs()
    {
        return $this->system_tabs=$this->system_tabs===null?new SystemTabCollection($this->tab_name):$this->system_tabs;
    } 
    
    function getComponents()
    {
        if ($this->components===null)
        {    
            $this->components=array();
            foreach ($this->tabs as $name=>$tab)
            {
                if (isset($tab['component']))
                    $this->components[$name]=$tab;
            }
        }
        return $this->components;
    }
    
    function getModules()
    {
        if ($this->modules==null)
        {    
            $this->modules=new mfArray();
            foreach ($this->getComponents() as $tab) 
            {
                $module=basename(dirname($tab['component']));               
                if (isset($this->modules[$module]))
                    continue;
                $this->modules[$module]=$module;
            }    
        }
        return $this->components;
    }
       
    static function removeCache($tab,$site=null)
    {        
         mfCacheFile::removeCache('tabs.'.$tab,'admin',$site);      
    } 
    
    
    function __toString() {
        return (string)$this->getI18n();
    }
    
    function getI18n()
    {
        return __($this->get('name'));
    }
    
    function loadI18n()
    {       
        mfContext::getInstance()->getI18n()->addExternalMessageSources(mfConfig::get('mf_site_app_cache_dir')."/i18n/tabs/".mfcontext::getInstance()->getRequest()->getCulture()."/system.tab.".$this->tab_name);
        return $this;
    }
    
     function translate($tabs=null){
        
        if(mfConfig::get('mf_i18n')){                   
            $this->translator=new SystemTabTranslator(array('culture'=>mfcontext::getInstance()->getRequest()->getCulture(),'name'=>'system.tab.'.$this->tab_name,'type'=>'tabs'));
            $this->translator->translate($tabs);
         //   $this->translator->setI18nSource();                
        } 
        return $this;
    }
    
}

