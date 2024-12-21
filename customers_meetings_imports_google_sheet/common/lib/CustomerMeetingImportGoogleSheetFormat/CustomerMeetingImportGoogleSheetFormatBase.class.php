<?php


class CustomerMeetingImportGoogleSheetFormatBase extends mfObject2 {
    protected static $fields = array('name', 'file_id','file_name', 'leaf_id', 'leaf_name', 'columns','status','number_of_lines','processed_rows','success_count','error_count','last_offset'); // Exemple de champs  status created updated
    const table = "t_customers_meetings_imports_google_sheet_format";
    protected $fields_values=array();

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

    function setFieldsValues($fields_values)
    {
        $this->set('columns',serialize($fields_values));
        return $this;
    }


    function getFieldsValues()
    {
        if (!$this->fields_values)
            $this->fields_values= unserialize($this->get('columns'));
//        echo "<pre>"; var_dump($this->fields_values); echo "</pre>";
        return $this->fields_values;
    }

    function getNamesValues()
    {
        $values=array();
        foreach ($this->getFieldsValues() as $name=>$value)
        {
            $values[]=array('name'=>$name,'value'=>$value);
        }
//        echo "<pre>"; var_dump($values); echo "</pre>";
        return $values;
    }
    public function delete()
    {
            $this->deleteLog();
            parent::delete();
    }
    public function deleteLog()
    {
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('format_id' => $this->get('id')))
            ->setQuery("DELETE FROM " . CustomerMeetingImportGoogleSheetLog::getTable() . " WHERE format_id = {format_id};")
            ->makeSqlQuery();
        return $this;
    }

    static function getFormatForSelect($site=null)
    {
        $values=array();
        $db=mfSiteDatabase::getInstance()
            ->setParameters()
            ->setQuery("SELECT * FROM ".CustomerMeetingImportFormat::getTable().
                " ORDER BY name ASC;")
            ->makeSiteSqlQuery($site);
        if (!$db->getNumRows())
            return $values;
        while ($item=$db->fetchObject('CustomerMeetingImportFormat'))
        {
            $values[$item->get('id')]=$item->get('name');
        }
        return $values;
    }

}
