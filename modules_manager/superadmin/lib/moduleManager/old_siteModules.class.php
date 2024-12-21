<?php


class old_siteModules {
    
    protected $site=null,$site_uptodate=null,$modules=array(),$coreModules=array(),$modulesUpdated=array();
    
    function __construct(Site $site)
    {
        $this->site=$site;
        $this->configure();
    }
    
    protected function configure()
    {
        $this->getInstalledModulesForSite();
        $this->coreModules=moduleManagerAdminUtils::getCoreModules();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getCoreModules()
    {
       return $this->coreModules; 
    }
    
    function update()
    {
        $this->modulesUpdated=array();
        $this->site_uptodate=false;      
        foreach ($this->getCoreModules() as $module)
        {            
            if ($module->getInstaller($this->getSite())->isUpToDate())
                 continue;
            $module->getInstaller()->upGrade();           
            $this->modulesUpdated[]=$module->get('name');
        }       
        foreach ($this->getModules() as $module)
        {            
            if ($module->getInstaller()->isUpToDate())
                 continue;
            $module->getInstaller()->upGrade();          
            $this->modulesUpdated[]=$module->get('name');
        }        
        if (empty($this->modulesUpdated))
        {
            $this->site_uptodate=true;          
        }    
    }
    
    function isUptodate()
    {     
        if ($this->site_uptodate===null)
        {              
            foreach ($this->getCoreModules() as $module)
            {            
                if (!$module->getInstaller($this->getSite())->isUpToDate())
                {   
                     $this->site_uptodate=false;         
                     return $this->site_uptodate;
                }     
            }            
            foreach ($this->getModules() as $module)
            {            
                if (!$module->getInstaller()->isUpToDate())
                {   
                     $this->site_uptodate=false;         
                     return $this->site_uptodate;
                }        
            }
        }
        $this->site_uptodate=true;         
        return $this->site_uptodate;
    }
    
    protected function getInstalledModulesForSite()
    {
        $this->modules=array();
        $db=mfSiteDatabase::getInstance()
                ->setQuery("SELECT * FROM ".moduleManager::getTable()." WHERE status='installed';")               
                 ->makeSiteSqlQuery($this->getSite());         
        if (!$db->getNumRows())            
            return ;       
        while ($row=$db->fetchObject('moduleManager'))
        {
            $row->site=$this->getSite();
            $this->modules[]=$row;
        }          
    }
    
    public function getModules()
    {
        return $this->modules;
    }             
    
    public function getModulesUpdated()
    {
        return $this->modulesUpdated;
    } 
    
    public function hasModulesUpdated()
    {
        return !empty($this->modulesUpdated);
    } 
}
