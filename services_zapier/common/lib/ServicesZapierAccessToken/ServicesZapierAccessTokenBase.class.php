<?php
class ServicesZapierAccessTokenBase extends mfObject2 {
    protected static $fields = array('access_token', 'client_id', 'user_id', 'expires', 'scope');
    const table = "t_services_zapier_oauth_access_tokens";

    function __construct($parameters = null) {
        parent::__construct();
        $this->getDefaults();
        if ($parameters === null)  return $this;

        if (is_array($parameters) || $parameters instanceof ArrayAccess) {
            if (isset($parameters['access_token'])) {
                return $this->loadByToken($parameters['access_token']);
            }
            return $this->add($parameters);
        } else {
            if (is_string($parameters)) {
                return $this->loadByToken($parameters);
            }
        }
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

   // protected function executeDeleteQuery($db) {
    //    $db->setQuery("DELETE FROM " . self::getTable() . " WHERE access_token = '{access_token}';");
     //   $db->makeSqlQuery();
   // }

    protected function executeDeleteQuery($db) {
        $db->setParameters(array('access_token' => $this->get('access_token')));
        $db->setQuery("DELETE FROM " . self::getTable() . " WHERE access_token = '{access_token}';");
        $db->makeSqlQuery();
    }

    protected function executeUpdateQuery($db) {
        $db->setQuery("UPDATE " . self::getTable() . " SET " . $this->getFieldsForUpdate() . " WHERE id = %d;");
        $db->makeSqlQuery();
    }

    protected function executeIsExistQuery($db) {
        $key_condition = ($this->getKey()) ? " AND id != {id}" : "";
        $db->setParameters(array('access_token' => $this->get('access_token'), 'id' => $this->getKey()))
            ->setQuery("SELECT id FROM " . self::getTable() . " WHERE access_token = '{access_token}'" . $key_condition)
            ->makeSqlQuery();
    }

    public function loadByToken($token) {
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('access_token' => $token))
            ->setQuery("SELECT * FROM " . self::getTable() . " WHERE access_token = '{access_token}';")
            ->makeSqlQuery();
        return $this->rowtoObject($db);
    }
    public function loadByRefreshToken($refresh_token) {
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('refresh_token' => $refresh_token))
            ->setQuery("SELECT * FROM " . self::getTable() . " WHERE refresh_token = '{refresh_token}';")
            ->makeSqlQuery();
        return $this->rowtoObject($db);
    }
}
