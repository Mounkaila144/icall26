<?php
class ServicesZapierRefreshTokenBase extends mfObject2 {
    protected static $fields = array('refresh_token', 'client_id', 'user_id', 'expires', 'scope');
    const table = "t_services_zapier_oauth_refresh_tokens";

    function __construct($parameters = null) {
        parent::__construct();
        $this->getDefaults();
        if ($parameters === null)  return $this;

        if (is_array($parameters) || $parameters instanceof ArrayAccess) {
            if (isset($parameters['refresh_token'])) {
                return $this->loadByToken($parameters['refresh_token']);
            }
            return $this->add($parameters);
        } else {
            if (is_string($parameters)) {
                return $this->loadByToken($parameters);
            }
        }
    }


    protected function executeInsertQuery($db)
    {
        $db->makeSqlQuery();
    }


    protected function executeDeleteQuery($db) {
        $db->setParameters(array('refresh_token' => $this->get('refresh_token')));
        $db->setQuery("DELETE FROM " . self::getTable() . " WHERE refresh_token = '{refresh_token}';");
        $db->makeSqlQuery();
    }

    protected function loadbyUser(User $user)
    {
        $this->set('user_id',$user);
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('user_id'=>$user->get('id')))
            ->setQuery("SELECT * FROM ".self::getTable().
                " WHERE user_id='{user_id}' ".
                ";")
            ->makeSiteSqlQuery($this->getSite());
        return $this->rowtoObject($db);
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
    public function loadByToken($token) {
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('refresh_token' => $token))
            ->setQuery("SELECT * FROM " . self::getTable() . " WHERE refresh_token = '{refresh_token}';")
            ->makeSqlQuery();
        return $this->rowtoObject($db);
    }


}
