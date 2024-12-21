<?php


class site_upgrade_10_Action extends mfModuleUpdate {
 
    protected $sql=null;
    
    function configure()
    {
        $this->sql=new File($this->getUpdateDirectory()."/upgrade.sql",FILE_APPEND);
    }
    
    function execute()
    {
        if (mfConfig::getSuperAdmin('site')!=$this->getSite()->get('site_db_name'))
           return ;
        $query='ALTER TABLE '.Site::getTable().' ADD is_uptodate ENUM( "YES", "NO" ) DEFAULT "NO" NOT NULL AFTER site_access_restricted;';
        $db=  mfSiteDatabase::getInstance();
        $db->setQuery($query);
        $db->makeSiteSqlQuery($this->getSite());
        $this->sql->putContent($query);
    }
}

