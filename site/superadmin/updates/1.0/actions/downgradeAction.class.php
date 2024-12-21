<?php


class site_downgrade_10_Action extends mfModuleUpdate {
 
    protected $sql=null;
    
    function configure()
    {
        $this->sql=new File($this->getUpdateDirectory()."/downgrade_".$this->getModule().".sql",FILE_APPEND);
    }
    
    function execute()
    {
        if (mfConfig::getSuperAdmin('site')!=$this->getSite()->get('site_db_name'))
           return ;
        $query= 'ALTER TABLE '.User::getTable().' DROP email_tosend;';
        $db=  mfSiteDatabase::getInstance();
        $db->setQuery($query);
        $db->makeSiteSqlQuery($this->getSite());
        $this->sql->putContent($query);
    }
    
   function remove()
    {
      $this->sql->delete();
      $file= new File($this->getUpdateDirectory()."/upgrade_".$this->getModule().".sql");
      $file->delete();
    }
}

