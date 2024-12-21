<?php

class moduleManagerBase extends mfObject2 {
    
    const table="t_modules"; 
    protected static $fields=array('name','logo','title','description','type','status','is_active','is_available','in_site','mode','created_at','updated_at');
    protected static $foreignKeys=array(); 
    protected static $fieldsNull=array(); 
    protected static $_config=null;
    
    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);    
        $this->getDefaults();  
        if ($parameters===null) return $this; 
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {
            if (isset($parameters['id']))
                return $this->loadById((string)$parameters['id']);
            if (isset($parameters['name']))
                return $this->loadByName((string)$parameters['name']); 
            return $this->add($parameters); 
        }   
        else
        {
            if (is_object($parameters))
            {
                if ($parameters instanceof mfModule)
                {
                    $this->site=$parameters->getSite();
                    $this->module=$parameters;
                    $this->loadByName($parameters->get('name'));
                }  
            }    
            elseif (is_numeric((string)$parameters)) 
            {    
                $this->loadbyId((string)$parameters);
            }    
            else
            {    
                $this->loadByName((string)$parameters);   
            }
        }   
    }
    
    protected function loadByName($name)
    {
        $this->set('name',$name);
        $db=mfSiteDatabase::getInstance()->setParameters(array($name));
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE name='%s';")
            ->makeSiteSqlQuery($this->site); 
        return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d ;")
            ->makeSiteSqlQuery($this->site);   
    }
    
    protected function getDefaults()
    {
    	$this->is_active=isset($this->is_active)?$this->is_active:"NO";
	$this->is_available=isset($this->is_available)?$this->is_available:"NO";
        $this->is_enable=isset($this->is_enable)?$this->is_enable:"NO";
        $this->in_site=isset($this->in_site)?$this->in_site:"NO";
        $this->status=isset($this->status)?$this->status:"loaded";
	$this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");       
    }
    
    protected function executeInsertQuery($db)
    {
        $db->makeSiteSqlQuery($this->site);     
    }
    
    function getValuesForUpdate()
    {
          
    }   
    
    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;")
           ->makeSiteSqlQuery($this->site);    
    }
    
    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
            ->makeSiteSqlQuery($this->site);     
    }
    
    protected function executeIsExistQuery($db)    
    {
      
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
        $db->setParameters(array('name'=>$this->name,$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE (name='{name}')".$key_condition)
           ->makeSiteSqlQuery($this->site);   
    }
    
    /*
     * Getter Methods
     */
    function getId()
    {
        return $this->id;
    }
    
    function getName()
    {
        return $this->name;
    }
    
    function getType()
    {
        return $this->type;
    }
    
    function getStatus()
    {
        return $this->status;
    }
    
    function getIsActive()
    {
        return $this->is_active;
    }
    
    function getIsAvailable()
    {
        return $this->is_available;
    }
    
    function getCreatedAt()
    {
        return $this->created_at;
    }
    
    function getUpdatedAt()
    {
        return $this->updated_at;
    }
              
    public function getDirectory()
    {
        return mfConfig::get('mf_modules_dir').'/'.$this->get('name');
    }
    
    /************** Pictures *****************************************************************/
                                        
    public function deleteLogo()
    {
        $this->getLogo()->remove(); 
        $this->set('logo','');
        $this->save();
    }
    
     /* See ModuleCore */
  /*   public function getLogo()
     {
         if (!$this->get('_logo'))      
            $this->_logo=new PictureObject(array(
                 "path"=>mfConfig::get('mf_modules_dir').'/'.$this->get('name').'/common/view/pictures/',
                 "picture"=>$this->get('logo'),
              //   "urlAdmin"=>"restrictive/".$this->getSite()->get('site_host')."/data/moduleManagers/".$this->get('id')."/",
                 "url"=>'/module/'.$this->get('name').'/pictures/',
                 "parameters"=>array("urlType"=>"web")
             ),'frontend',$this->getSite());
         return $this->_logo;     
      }     */  
   
    public function getLogo()
    {
        if (!$this->get('_logo'))      
            $this->_logo=new PictureObject2(array(
                "path"=>mfConfig::get('mf_modules_dir').'/'.$this->get('name').'/common/view/pictures/',
                "picture"=>$this->get('logo'),           
                "url"=>url('/module/'.$this->get('name').'/pictures/'."/".$this->get('logo'),"web")

            ));
        return $this->_logo;     
   }
      
    function getModule()
    {
        if (!$this->module)
        {
            $this->module=new mfModule($this->get('name'),$this->getSite());
            $this->module->setInstallerClass('moduleUpdater');          
        }   
        return $this->module;
    }
   
    function setConfigFromModule()
    {
        if ($this->getModule()->hasConfigFile() )
        {    
            $config=$this->getModule()->getConfig();
            $this->add(array(
                    'title'=>$config->title,
                    'description'=>$config->description,  
                    'logo'=>$config->logo, 
                    'type'=>$config->type
            ));
        } 
        $this->add(array(
            'in_site'=>($this->getModule()->get('in_site')?"YES":"NO")
        ));
    }
   
    function getClass()
    {
        return str_replace(' ','',ucwords(str_replace('_',' ',$this->get('name'))));
    }

    function getClassUtils()
    {
        return $this->getClass()."Utils";
    }

    function getNameI18n()
    {
        return __($this->get('name'),array(),'messages',$this->get('name'));
    }
}



