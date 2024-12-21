<?php


class ThemeBase extends mfObject2 {

    protected static $fields=array('id','name','preview','is_active','application','created_at','updated_at');
    const table="t_theme";
    protected $theme=null;
    
    function __construct($parameters=null,$application=null,$site=null) 
    {
      parent::__construct($application,$site);
      $this->getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['id']))
                $this->loadById((string)$parameters['id']);
            $this->add($parameters); 
       }  
       else {
           if (is_numeric((string)$parameters))
                return $this->loadById((string)$parameters); 
        //   return $this->loadByName((string)$parameters);
       } 
    }
        
     protected function executeLoadById($db)
     {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d AND application@@IN_APPLICATION@@;")
           ->makeSqlQuery($this->application,$this->site);  
     }
    
    protected function getDefaults()
    {
       $this->created_at=date("Y-m-d H:i:s");  
       $this->updated_at=date("Y-m-d H:i:s");
       $this->is_active=isset($this->is_active)?$this->is_active:"NO";
    }
     
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuery($this->application,$this->site);   
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }   
    
    protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
          ->makeSqlQuery($this->application,$this->site); 
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);   
    }
      
    
    public function isExist()
    {
        return is_dir($this->getDirectory())&&is_readable($this->getDirectory());
    }
    
    protected function _getDirectory($application,$name)
    {
        return mfConfig::get('mf_sites_dir')."/themes/".$application."/".$name;
    }
    
     // Directory data if necessary
    public function getDirectory()
    {
        return $this->_getDirectory($this->get('application'),$this->get('name'));
       // return mfConfig::get('mf_sites_dir')."/themes/".$this->get('application')."/".$this->get('name');
    }
        
    
    public function getStyles()
    {
        if (!$this->_styles)
        {    
            foreach (glob($this->getDirectory()."/styles/*",GLOB_ONLYDIR) as $file)
                $this->_styles[basename($file)]=basename($file);
        }        
        return $this->_styles;
    }
    
    public function getDesigns()
    {
        if (!$this->_designs)
        {    
            foreach (glob($this->getDirectory()."/designs/*",GLOB_ONLYDIR) as $file)
                $this->_designs[basename($file)]=basename($file); 
        }    
        return $this->_designs;
    }
    
    
    protected function getThemesDirectory($value)
    {
      return mfConfig::get('mf_sites_dir')."/themes".DIRECTORY_SEPARATOR.$this->get('application').DIRECTORY_SEPARATOR.$value;
    }
    
    protected function getCommonDirectory($value="")
    {
        return mfConfig::get('mf_sites_dir')."/themes/common/".$value;
    }
    
    protected function getLayoutsDirectory($value="")
    {
        switch ($value)
        {
            case 'all':$dirs=array();
                       foreach (array('default','base','common.base','theme') as $type)
                            $dirs[]=$this->getLayoutsDirectory($type);
                       return $dirs;
            case 'all.default':$dirs=array();
                       foreach (array('default','base','common.base') as $type)
                            $dirs[]=$this->getLayoutsDirectory($type);
                       return $dirs;
            case 'base':$dir=$this->getThemesDirectory("base/default/designs/layouts"); break;   // Base
            case 'default':$dir=$this->getThemesDirectory($this->get('name')."/designs/default/layouts"); break;   // Default
            case 'common.base':$dir=$this->getCommonDirectory("base/default/designs/layouts"); break; // Common Base
            case 'theme.default':$dir=$this->getThemesDirectory($this->get('name')."/designs/default"); break;
            case 'theme':$dir=$this->getThemesDirectory($this->get('name')."/designs"); break;
            default: break;  
        }
        return $dir;
    }
    
     public function getLayouts($path="",$design="*")
    {
         $files=array();
         if ($path && $path[0]!='/')
              $path="/".$path;
          
         //  Get defaults
         foreach ($this->getLayoutsDirectory("all.default") as $dir)
         {
             foreach (glob($dir.$path."/*") as $file)
             {        
                  if (is_file($file))
                    $files[basename($file)]=basename($file);
             }     
         }
         // Default theme
         foreach ($this->getLayoutsDirectory("theme.default") as $dir)
         {
             foreach (glob($dir.$path."/*") as $file)
             {
                 if (is_file($file))
                    $files[basename($file)]=basename($file);
             }    
         }
         // Designs on theme
         foreach (glob($this->getLayoutsDirectory("theme")."/".$design."/layouts".$path."/*") as $file)
         {      
             if (is_file($file))
                $files[basename($file)]=basename($file);
         }  
         return $files;
    }
    
    function getTheme()
    {
        if (!$this->theme)
        {
            $this->theme=new ThemeCore($this->get('name'),$this->get('application'));
        }
        return $this->theme;
    }
    
    function getName()
    {
        $this->getTheme()->loadTextI18nStatic();
        return $this->get('name');
    }
    
    function setTheme($theme)
    {
        foreach (array('name','preview') as $name)
        {
            $this->$name=$theme->get($name);
        }    
        return $this;
    }
    
}

