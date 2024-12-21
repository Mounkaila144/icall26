<?php

class MarketingLeadsWpFormsMultipleProcess {
   
    protected $site=null,$actions=null,$selection=null,$parameters=null,$messages=array();
    
    function __construct($actions,$selection,$parameters=array(),$site=null) {
        $this->site=$site;
        $this->actions=$actions;
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
        $query=array();
        $params=array();
        $messages=array();        
        if (in_array('state',$this->getActions()))
        {
            $params['state']=$this->parameters['state'];
            $query[]=MarketingLeadsWpForms::getTableField("state_id")."='{state}'";
        }
//        $qr = "UPDATE ".MarketingLeadsWpForms::getTable().
//                           " SET ".implode(",",$query).
//                           " WHERE id IN('".$this->getSelection()->implode("','")."')".
//                           ";";
//        echo "<pre>"; var_dump($qr,$params, $this->getSelection()); echo "</pre>";
        if ($query)
        {           
            $db=mfSiteDatabase::getInstance()
                ->setParameters($params)                
                ->setQuery("UPDATE ".MarketingLeadsWpForms::getTable().
                           " SET ".implode(",",$query).
                           " WHERE id IN('".$this->getSelection()->implode("','")."')".
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

