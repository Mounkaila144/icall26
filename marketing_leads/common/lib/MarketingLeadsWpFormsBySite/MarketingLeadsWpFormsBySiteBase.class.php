<?php

class MarketingLeadsWpFormsBySiteBase extends mfObject2 {

    protected static $fields=array('id','nom_prenom','email','tel','postcode','energy','revenu','nb_fiscal',
                                   'referrer','utm_source','utm_medium','utm_campaign',   
                                   'situation','zone_geo','doublon','created_at');
    const table="mod555_contact"; 
    protected static $foreignKeys=array(); // By default
    protected static $fieldsNull=array(); // By default

    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);   
        $this->getDefaults(); 
        return $this->add($parameters); 
    }
    
    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
//        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
//        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
//        $this->status=isset($this->status)?$this->status:"ACTIVE";
//        $this->country=isset($this->country)?$this->country:"FR";
//        $this->is_active=isset($this->is_active)?$this->is_active:"NO";
//        $this->income=isset($this->income)?$this->income:0;
//        $this->number_of_people=isset($this->number_of_people)?$this->number_of_people:0;
//        $this->postcode=isset($this->postcode)?$this->postcode:0;
    }
     
    protected function executeInsertQuery($db)
    {
        $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
//        $this->set('updated_at',date("Y-m-d H:i:s"));   
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
//        $key_condition = ($this->getKey())?" AND id!=".$this->getKey():"";
//        $db->setParameters(array("firstname"=> $this->get("firstname"), "lastname"=> $this->get('lastname'), "email"=> $this->get('email'), 'site_id'=> $this->get('site_id')))
//           ->setQuery("SELECT * FROM ". MarketingLeadsWpForms::getTable().
//                      " WHERE ".MarketingLeadsWpForms::getTableField("firstname")."='{firstname}'".
//                      " AND ".MarketingLeadsWpForms::getTableField("lastname")."='{lastname}'".
//                      " AND ".MarketingLeadsWpForms::getTableField("email")."='{email}'".
//                      " AND ".MarketingLeadsWpForms::getTableField("site_id")."='{email}'".$key_condition.
//                      ";")
//           ->makeSiteSqlQuery($this->site);     
//        echo $db->getQuery()."<br />";
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new MarketingLeadsWpFormsBySiteFormatter($this);
        }
        return $this->formatter;
    }
}
