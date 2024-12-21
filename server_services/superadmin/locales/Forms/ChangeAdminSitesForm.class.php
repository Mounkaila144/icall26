<?php


class ChangeAdminSitesForm extends mfForm{
    
    protected $items=null;
    
    function __construct($defaults = array(), $options = array()) {
        parent::__construct($defaults, $options);
        $this->items=new SiteServicesSiteCollection();
    }
    function configure() {                          
        $this->setValidators(array(
            'hosts' => new mfValidatorSchemaForEach(new mfValidatorDomain(),count($this->getDefault('hosts'))),   
            'value'=> new mfValidatorChoice(array('choices'=>array('YES'=>'YES','NO'=>'NO'),'key'=>true)),
        ));
    }
    
    static function getToken()
    {
        return iCall26SiteServiceApi::getKey().session_id();   
    }
  
    public function getCSRFToken()
    {
        return self::getToken();
    }
    
    public function execute()
    {               
        $db=mfSiteDatabase::getInstance()
           ->setParameters(array('value'=>$this['value']->getValue()))
           ->setQuery("UPDATE ".Site::getTable().
                      " SET site_admin_available='{value}'".
                      " WHERE ".Site::getTableField('site_host')." IN ('".$this['hosts']->getArray()->implode("','")."')".
                      ";")
           ->makeSqlQuerySuperAdmin(); 
        
        $db->setParameters(array())
           ->setQuery("SELECT * FROM ".Site::getTable().                     
                      " WHERE ".Site::getTableField('site_host')." IN ('".$this['hosts']->getArray()->implode("','")."')".
                      ";")
           ->makeSqlQuerySuperAdmin(); 
        if (!$db->getNumRows())
            return $this;      
        while ($item=$db->fetchObject('Site'))
        {
           $item->removeAdminHostCache();           
        }            
        return $this;
    }
    
    
}
