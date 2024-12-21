<?php
class CustomerMeetingImportGoogleSheetLogBase extends mfObject2 {
    protected static $fields=array('log','format_id','created_at','updated_at');
    const table="t_customers_meetings_imports_google_sheet_log";
    protected static $foreignKeys=array('format_id'=>'CustomerMeetingImportGoogleSheetFormat');

    function __construct($parameters=null) {
        parent::__construct();
        $this->getDefaults();
        if ($parameters === null)  return $this;
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {
            if (isset($parameters['id']))
                return $this->loadbyId((string)$parameters['id']);
            // Import
            return $this->add($parameters);
        }
        else
        {
            if (is_numeric((string)$parameters))
                return $this->loadbyId((string)$parameters);
        }
    }


    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."='%s';");
        $db->makeSqlQuery();
    }

    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
    }

    protected function executeInsertQuery($db)
    {
        $db->makeSqlQuery();
    }

    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));
    }

    protected function executeUpdateQuery($db)
    {
        $db->setQuery("UPDATE ".self::getTable()." SET " . $this->getFieldsForUpdate() . " WHERE ".self::getKeyName()."=%d ;");
        $db->makeSqlQuery();
    }

    protected function executeDeleteQuery($db)
    {
        $db->setQuery("DELETE FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;");
        $db->makeSqlQuery();
    }

    protected function executeIsExistQuery($db)
    {
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!={id};":"";
        $db->setParameters(array('name'=>$this->get('name'),'id'=>$this->getKey()))
            ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' ".$key_condition)
            ->makeSiteSqlQuery($this->site);
    }



}
