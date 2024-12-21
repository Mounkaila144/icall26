<?php



class SystemMenuCore extends treeNode {
 
    protected static $fields=array('name','menu','level','module','lb','rb','type','status','created_at','updated_at');
    const table="t_system_menu";
    protected $menus=null;
    protected static $instance=array();
            
     function __construct($parameters=null,$site=null) {
        parent::__construct($parameters,null,$site);       
    }  
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
        $this->status=isset($this->status)?$this->status:'ACTIVE';
        $this->type=isset($this->type)?$this->type:'SYSTEM';
        parent::getDefaults();
    }
    
    function getValuesForUpdate()
    {        
        $this->set('updated_at',date("Y-m-d H:i:s"));   
    }
    
  
    
    function getRoot()
    {                     
      if ($this->lb==1 && $this->level==0 && $this->name=='root')
          return $this;
      if ($this->_root)
          return $this->_root;     
      $db=mfSiteDatabase::getInstance()
            ->setParameters(array())
            ->setQuery("SELECT * FROM ".static::getTable()." WHERE lb=1 AND level=0;")
            ->makeSqlQuery();
      if (!$db->getNumRows())
            return false; 
      $this->_root=$db->fetchObject(get_class($this))->loaded();
      return $this->_root;
    }
    
    protected function _getRoot()
    {           
       $db=mfSiteDatabase::getInstance()
            ->setParameters(array())
            ->setQuery("SELECT * FROM ".static::getTable()." WHERE lb=1 AND level=0;")
            ->makeSqlQuery();
       if ($db->getNumRows())
       {    
          $this->_root=$db->fetchObject(get_class($this))->loaded();               
       }  
       else
       {             
          $this->_root=$this->createRoot();    // Root doesn't exist
       }           
       return $this->_root;
    }
    
    
    /* protected function getRootDefaults()
    {
        $this->add(array(
            'lb'=>1,
            'rb'=>2,
            'level'=>0,     
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
        ));    
        parent::getRootDefaults();
    }*/
    
}

