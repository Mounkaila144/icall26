<?php


class ThemeCore extends mfObjectCore {
   
    protected $name=null,$application=null,$preview=null;
    
    function __construct($name,$application)
    {
        $this->name=$name;
        $this->application=$application;
        $this->findPreview();
    }
    
    function getDirectory()
    {        
      return mfConfig::get('mf_sites_dir')."/themes/".$this->get('application')."/".$this->get('name');    
    }
    
    public function loadTextI18nStatic()
    {              
        if (($i18n= mfcontext::getInstance()->getI18n()))
        {            
          //  $i18n->addMessageI18nSources($this->getDirectory()."/i18n");         
            $i18n->addMessageI18nSources($this->getDirectory()."/i18n");  
        }                   
    }   
      
    protected function findPreview()
    {           
        foreach (glob($this->getDirectory()."/config/preview.*") as $file)
        {               
            if (is_readable($file))
            {             
              return $this->set('preview',basename($file));
            }
        }   
    }  
    
    public function getPreview()
    {                
        return $this->get('preview');
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
    
    public function create()
    {
        mfFileSystem::mkdirs($this->getDirectory());
        mfFilesystem::xcopy(dirname(__FILE__)."/../../../superadmin/data/theme_skeleton",$this->getDirectory());
        return $this;        
    }        
    
}

