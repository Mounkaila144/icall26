<?php
class ServicesZapierAuthCodeBase extends mfObject2 {
    protected static $fields = array('authorization_code', 'client_id', 'user_id', 'redirect_uri', 'expires', 'scope');
    const table = "t_services_zapier_oauth_authorization_codes";

    function __construct($parameters = null) {
        parent::__construct();
        $this->getDefaults();
        if ($parameters === null)  return $this;

        if (is_array($parameters) || $parameters instanceof ArrayAccess) {
            if (isset($parameters['authorization_code'])) {
                return $this->loadByCode($parameters['authorization_code']);
            }
            return $this->add($parameters);
        } else {
            if (is_string($parameters)) {
                return $this->loadByCode($parameters);
            }
        }
    }

    protected function executeInsertQuery($db)
    {
        $db->makeSqlQuery();
    }

    protected function executeDeleteQuery($db) {
        $db->setParameters(array('authorization_code' => $this->get('authorization_code')));
        $db->setQuery("DELETE FROM " . self::getTable() . " WHERE authorization_code = '{authorization_code}';");
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



    protected function executeIsExistQuery($db)
    {
        $key_condition=($this->getKey())?" AND ".self::getKeyName()."!={id};":"";
        $db->setParameters(array('name'=>$this->get('name'),'id'=>$this->getKey()))
            ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' ".$key_condition)
            ->makeSiteSqlQuery($this->site);
    }

    public function loadByCode($code) {
        $this->set('authorization_code', $code);
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('authorization_code' => $code))
            ->setQuery("SELECT * FROM " . self::getTable() . " WHERE authorization_code = '{authorization_code}'")
            ->makeSqlQuery();
        return $this->rowtoObject($db);
    }

}
