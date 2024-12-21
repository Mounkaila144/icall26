<?php

class SiteClient extends mfObject2 {

    const table="t_sites_clients";
    protected static $fields=array('name','lang','design','banner','favicon','favicon_ico','style','is_active','keywords','description',
                                   'is_default','params','is_tablet','is_mobile','application',
                                   // 'company_id',
                                    'created_at','updated_at');      
    //protected static $foreignKeys=array('company_id'='SiteCompany'); // By default        
    
    function __construct($parameters=null,$application=null,$site=null) 
    {
      parent::__construct($application,$site);
      $this->getDefaults();
      if ($parameters===null) return $this; 
      if (is_array($parameters)||$parameters instanceof ArrayAccess) {           
            if (isset($parameters['id']))
               return $this->loadById((string)$parameters['id']);
            return $this->add($parameters); 
       }  
       else {
          if (is_numeric((string)$parameters))
             $this->loadById((string)$parameters); 
       } 
    }           
    
     protected function executeLoadById($db)
     {
        $db->setQuery("SELECT * FROM ".self::getTable()."                      
                       WHERE id=%d AND application@@IN_APPLICATION@@;")
            ->makeSqlQuery($this->application,$this->site);   
     }
    
    function getValuesForUpdate() 
    {
       $this->set('updated_at',date("Y-m-d H:i:s"));   
    } 
    
     protected function executeUpdateQuery($db)
    {
       $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d;")
          ->makeSqlQuery($this->application,$this->site);      
    }
    
    protected function getDefaults()
    {
        $this->name=isset($this->name)?$this->name:"default";
        $this->design=isset($this->design)?$this->design:"default";
        $this->style=isset($this->style)?$this->style:"default";
        $this->is_active=isset($this->is_active)?$this->is_active:"NO";
        $this->is_mobile=isset($this->is_mobile)?$this->is_mobile:"NO";
        $this->is_tablet=isset($this->is_tablet)?$this->is_tablet:"NO";
        $this->is_default=isset($this->is_default)?$this->is_default:"NO";
        $this->created_at=date("Y-m-d H:i:s");
        $this->updated_at=date("Y-m-d H:i:s");  
    }   
    
    protected function executeInsertQuery($db)
    {
       $db->makeSqlQuery($this->application,$this->site);   
    }
    
    protected function executeDeleteQuery($db)
    {
       if ($this->is_default=="YES")
            throw new mfException("delete is not allowed");    
       $db->setQuery("DELETE FROM ".self::getTable()." WHERE id=%d;") 
          ->makeSqlQuery($this->application,$this->site);
    }
    
    /*********************  M E T H O D S   ****************************/
    
    // Directory data
    public function getDirectory()
    {
        return mfConfig::get('mf_sites_dir')."/".$this->getSiteName()."/".$this->getApplication()."/view/pictures/".$this->get('lang');
    }
    
  /*  public function getBanner()
    {
      if (!$this->get('_banner'))      
         $this->_banner=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('banner'),
                 "url"=>"/pictures/".$this->get('lang')."/",
                 "parameters"=>array("urlType"=>"web")
             ),$this->application,$this->getSite());
      return $this->_banner;     
    }*/
    
 /*   public function getFavicon()
    {
      if (!$this->get('_favicon'))      
         $this->_favicon=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('favicon'),
                 "url"=>"/pictures/".$this->get('lang')."/",
                 "parameters"=>array("urlType"=>"web")
             ),$this->application,$this->getSite());
      return $this->_favicon;     
    }
    
    public function getFaviconIco()
    {
      if (!$this->get('_favicon_ico'))      
         $this->_favicon_ico=new PictureObject(array(
                 "path"=>$this->getDirectory(),
                 "picture"=>$this->get('favicon_ico'),
                 "url"=>"/pictures/".$this->get('lang')."/",
                 "parameters"=>array("urlType"=>"web")
             ),$this->application,$this->getSite());
      return $this->_favicon_ico;     
    }*/
    
    public function deleteFavicon()
    {
        $this->getFavicon()->remove(); 
        $this->set('favicon','');
        $this->save();
    }
    
    public function deleteFaviconIco()
    {
        $this->getFaviconIco()->remove(); 
        $this->set('favicon_ico','');
        $this->save();
    }
    
    public function deleteBanner()
    {
        $this->getBanner()->remove(); 
        $this->set('banner','');
        $this->save();
    }
    
   /*  function getSiteCompany()
    {
        if ($this->isNotLoaded())
            return null;                                 
        $db=mfSiteDatabase::getInstance()
                 ->setParameters(array('shop_id'=>$this->get('id_shop')))
                 ->setQuery("SELECT ".Company::getFieldsAndKeyWithTable()." FROM ".Company::getTable().
                            " LEFT JOIN ".Shop::getInnerForJoin('id_company').
                            " LEFT JOIN ".ShopDesign::getInnerForJoin('id_shop').
                            " WHERE ".Shop::getTableField('id')."={shop_id} OR ".Shop::getTableField('id')." IS NULL".
                            " ORDER BY is_site DESC LIMIT 0,1;")               
                 ->makeSiteSqlQuery();   
         if (!$db->getNumRows())          
             return null;         
        return $db->fetchObject('Company')->loaded();                                  
    }*/
    
    
}

