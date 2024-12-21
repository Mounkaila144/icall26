<?php

class UserGroupMultipleAffectationProcess {
   
    protected $site=null,$selection=null,$parameters=null,$messages=array();
    
    function __construct($selection,$parameters=array(),$site=null) {
        $this->site=$site;
        $this->selection=$selection;        
        $this->parameters=$parameters;
        $this->messages=new mfArray();
    }
    
    function getActions()
    {
        return $this->actions;
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getSelection()
    {
        return $this->selection;
    }
    
    function process()
    {              
        foreach ($this->selection as $group)
        {
           $db=mfSiteDatabase::getInstance()
                   ->setParameters(array("dst_group_id"=>$group["group_dst_id"],"src_group_id"=>$group["group_src_id"]))
                   ->setQuery("UPDATE ".UserGroup::getTable().
                              " SET ".UserGroup::getTableField('group_id')."={dst_group_id}".
                              " WHERE ".UserGroup::getTableField('group_id')."={src_group_id}".
                              ";")              
                   ->makeSiteSqlQuery($this->getSite());            
        }
        return $this;
    }
    
    function getMessages()
    {
        return $this->messages;
    }
    
}

