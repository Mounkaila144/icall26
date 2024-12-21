<?php
class ServicesZapierScopeBase extends mfObject2 {
    protected static $fields = array('scope', 'is_default');
    const table = "t_services_zapier_oauth_scopes";

    function __construct($parameters = null) {
        parent::__construct();
        $this->getDefaults();
        if ($parameters === null)  return $this;

        if (is_array($parameters) || $parameters instanceof ArrayAccess) {
            if (isset($parameters['scope'])) {
                return $this->loadByScope($parameters['scope']);
            }
            return $this->add($parameters);
        } else {
            if (is_string($parameters)) {
                return $this->loadByScope($parameters);
            }
        }
    }

    protected function executeInsertQuery($db)
    {
        $db->makeSqlQuery();
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

    public function loadByScope($scope) {
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('scope' => $scope))
            ->setQuery("SELECT * FROM " . self::getTable() . " WHERE scope = '{scope}';")
            ->makeSqlQuery();
        return $this->rowtoObject($db);
    }

}
