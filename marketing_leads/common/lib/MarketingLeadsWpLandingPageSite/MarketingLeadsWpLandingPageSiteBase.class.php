<?php

class MarketingLeadsWpLandingPageSiteBase extends mfObject2 {
     
    protected static $fields=array('host_site','host_db','name_db','user_db','password_db','campaign','cron_time','last_execution_time',
                                   'is_active','created_at','updated_at','status');
    const table="t_marketing_leads_wp_landing_page_site"; 
    protected static $foreignKeys=array(); // By default
    protected static $fieldsNull=array('updated_at'); // By default
    protected $database=null;
    protected $leads = null;
    
    function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);   
        $this->getDefaults(); 
        if ($parameters === null)  return $this;      
        if (is_array($parameters)||$parameters instanceof ArrayAccess)
        {
            if (isset($parameters['id']))
                return $this->loadbyId((string)$parameters['id']); 
            if(isset($parameters['host_site']))
                return $this->loadByHostSiteAndCampaign((string)$parameters['host_site'],(string)$parameters['campaign']);
            return $this->add($parameters); 
        }   
        else
        {
            if (is_numeric((string)$parameters)) 
                return $this->loadbyId((string)$parameters);
        }   
    }
    
    protected function loadByHostSiteAndCampaign($host_site,$campaign)
    {
        $this->set('host_site',$host_site);
        $this->set('campaign',$campaign);
        $db=mfSiteDatabase::getInstance()->setParameters(array("host_site"=>$host_site,"campaign"=>$campaign));
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE host_site='{host_site}' AND campaign='{campaign}';")
           ->makeSiteSqlQuery($this->site);                           
        return $this->rowtoObject($db);
    }
    
    protected function executeLoadById($db)
    {
        $db->setQuery("SELECT * FROM ".self::getTable()." WHERE ".self::getKeyName()."=%d;")
           ->makeSiteSqlQuery($this->site);  
    }
    
    protected function getDefaults()
    {
        $this->created_at=isset($this->created_at)?$this->created_at:date("Y-m-d H:i:s");
        $this->updated_at=isset($this->updated_at)?$this->updated_at:date("Y-m-d H:i:s");
        $this->status=isset($this->status)?$this->status:"ACTIVE";
        $this->is_active=isset($this->is_active)?$this->is_active:"YES";
    }
     
    protected function executeInsertQuery($db)
    {
        $db->makeSiteSqlQuery($this->site);   
    }
    
    function getValuesForUpdate()
    {
        $this->set('updated_at',date("Y-m-d H:i:s"));   
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
        $key_condition = ($this->getKey())?" AND id!=".$this->getKey():";";
        $db->setParameters(array("host_site"=> $this->get('host_site'),"campaign"=> $this->get('campaign')))
           ->setQuery("SELECT * FROM ".self::getTable()." WHERE host_site='{host_site} AND campaign='{campaign}' ".$key_condition)
           ->makeSiteSqlQuery($this->site);     
    }
    
    public function __toString()
    {      
        return (string) $this->name;
    }
    
    function getFormatter()
    {
        if ($this->formatter===null)
        {
            $this->formatter=new MarketingLeadsWpLandingPageSiteFormatter($this);
        }
        return $this->formatter;
    }
    
    function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','NO');
        $this->save();
    }
    
    function enable()
    {
        if ($this->isNotLoaded())
            return $this;
        $this->set('is_active','YES');
        $this->save();
    }
    
    /* Start db registration methodes and recuperation information */
//    public function registerDatabase($name,$parameters)
//    public function makeSqlQueryForDatabase($name)
    
    function getDatabaseName()
    {
        return $this->get('campaign')." ".$this->get('name_db');
    }
    
    function register()
    {
        $this->database = mfSiteDatabase::getInstance()->registerDatabase($this->getDatabaseName(),array('host'=>$this->get('host_db'),'password'=>$this->get('password_db'),'user'=>$this->get('user_db'),'name'=>$this->get('name_db'))); 
    }
    
    function connect()
    {
        $this->register();
        $this->database->getDatabase()->connect();
        return $this;
    }
    
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new MarketingLeadsWpSettings(null,$this->getSite()): $this->settings;
    }
    
    function getLeadsFromWpTableForCron()
    {
        $currentTime = time();
        if (!$this->get('cron_time') || ($currentTime - $this->get('last_execution_time')) < ($this->get('cron_time') * 60)) 
            return $this;
        $this->loadById($this->get('id'));
        if ($this->isNotLoaded())  
            throw new mfException('Object not loaded properly.');       
        $this->set('last_execution_time', $currentTime);
        $this->save();
        $this->register();       
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array("site_id" => $this->get('id')))
            ->setQuery("SELECT MAX(" . MarketingLeadsWpForms::getTableField('id_wp') . ") AS max_ids FROM " . MarketingLeadsWpForms::getTable() .
                " WHERE " . MarketingLeadsWpForms::getTableField("site_id") . "='{site_id}'" .
                ";")
            ->makeSiteSqlQuery($this->getSite());
        $max = 0;
        while ($row = $db->fetchArray()) {
            $max = (int)$row['max_ids'];
        }
        $state = $this->getSettings()->getDefaultStatus();
        $db = mfSiteDatabase::getInstance()
            ->setParameters(array('max' => $max, 'stop' => $this->getSettings()->get('max_leads_to_fetch')))
            ->setQuery("SELECT * FROM " . MarketingLeadsWpTable::getTable() .
                " WHERE id>{max} " .
                " LIMIT 0,{stop}" .
                ";")
            ->makeSqlQueryForDatabase($this->getDatabaseName());
//        echo $db->getQuery()."<br />";
        if (!$db->getNumRows())
             return $this;      
        //traitement a faire sur les lignes récupérer
        while ($row = $db->fetchArray()) {
            $form_lead = new MarketingLeadsWpForms(null, $this->getSite());
            $form_lead->add($this->doptToStructure($row));
            if ($this->getSettings()->hasDefaultStatus())
                $form_lead->set('state_id', $state);
            $this->getRecoveredLeads()->push($form_lead);
        }
        $this->getRecoveredLeads()->processCleanUp();
        $this->getRecoveredLeads()->save();
        return $this;      
    }
    
    private function getColonsNamesAndVs()
    {
        if (mfContext::getInstance()->getUser()->hasCredential([['marketing_leads_app_mhpac']]))
        {
             return array("id_wp"=>"id","firstname"=>"nom_prenom","lastname"=>"nom","email"=>"email","phone"=>"tel",
                     "postcode"=>"postcode","energy"=>"energy","income"=>"revenu","number_of_people"=>"nb_fiscal",
                     "owner"=>"situation","wp_created_at"=>"created_at",
                     "duplicate_wpf"=>"doublon","zone"=>"zone_geo",
                     'referrer'=>'referrer',
                     'utm_source'=>'utm_source',
                     'utm_medium'=>'utm_medium',
                     'utm_campaign'=>'utm_campaign',  
                    );
        }    
        return array("id_wp"=>"id","firstname"=>"nom_prenom","lastname"=>"nom_prenom","email"=>"email","phone"=>"tel",
                     "postcode"=>"postcode","energy"=>"energy","income"=>"revenu","number_of_people"=>"nb_fiscal",
                     "owner"=>"situation","wp_created_at"=>"created_at",
                     "duplicate_wpf"=>"doublon","zone"=>"zone_geo",
                     'referrer'=>'referrer',
                     'utm_source'=>'utm_source',
                     'utm_medium'=>'utm_medium',
                     'utm_campaign'=>'utm_campaign',  
                    );
    }
    
    private function getOwnerStatus($status)
    {
        $status_array = array("Locataire"=>"tenant","Propriétaire"=>"owner","Propriétaire non occupant"=>"non_occupant_owner");
        return $status_array[$status];
    }
    
    private function getEnergyStatus($status)
    {
        $status_array = array("Electricité"=>"electricity","electricité"=>"electricity","Combustible"=>"combustible","combustible"=>"combustible");
        return $status_array[$status];
    }
    
    private function doptToStructure($row)
    {
        $item_array = array('site_id'=> $this);
        
        foreach($this->getColonsNamesAndVs() as $name=>$field)
        {
            //tester si on est sur l'etat (propriétaire, locataire , etc)
            if($name=="energy")
                $row[$field] = $this->getEnergyStatus($row[$field]);
            if($name=="owner")
                $row[$field] = $this->getOwnerStatus($row[$field]);
            if($name=="income")
            { 
                 $tmp = str_replace(" ","", $row[$field]);
                if (is_float($tmp+0.0) || is_integer($tmp))
                    $row[$field] = floatval($tmp);
                else
                   $row[$field] =0.0;

            }
            if($name=="duplicate_wpf")
            {
//                var_dump($row);
                if($row[$field])
                    $row[$field] = "YES";
                elseif(!$row[$field])
                    $row[$field] = "NO";
            }
            //cleanup
            if($name=="postcode")
            {
                //clean postcode
                $row[$field] = str_pad($row[$field], 5);
//                var_dump($row);
            }
            if($name=="phone")
            {
                //clean phone
                if(strpos($row[$field],'+33')!==false)  {
                    $phone = str_replace("+33", "", $row[$field]) ; //$row[$field] = str_replace("+33", "06", $row[$field]) ;
                    if($phone[0]!=='0')
                        $phone='0'.$phone;
                    $row[$field]=$phone;                                        
                    //$row[$field] = substr_replace(substr( preg_replace('/^\+?1|\|1|\D/', '', $row[$field]), -10), 0, 0, 1);
                }                                      
                
                //blacklist
                $settings = MarketingLeadsWpSettings::load($site);
                if($settings->hasBlacklistPhonesList() && $settings->getBlacklistPhonesList()->in($row[$field]))
                {
                    $item_array['phone_status'] = 'WrongNumber';
                }
            }
            $item_array[$name]=$row[$field];
        }
//        var_dump($item_array);
        return $item_array;
    }
    
    public static function getCampaignsForSelect($site=null)
    {
        $results = new mfArray();
        
        $db= mfSiteDatabase::getInstance();
        $db->setQuery("SELECT DISTINCT(".MarketingLeadsWpLandingPageSite::getTableField("campaign").") as campaign FROM ".
                      MarketingLeadsWpLandingPageSite::getTable().
                      ";")
           ->makeSiteSqlQuery($site);
        
        if(!$db->getNumRows())
            return $results;
        
        while($row = $db->fetchArray())
        {
            $results[$row['campaign']]=$row['campaign'];
        }
        return $results;
    }
    
    public static function getSitesForSelect($site=null)
    {
        $results = new mfArray();
        
        $db= mfSiteDatabase::getInstance();
        $db->setQuery("SELECT ".MarketingLeadsWpLandingPageSite::getTableField("id")." as site,".
                      MarketingLeadsWpLandingPageSite::getTableField("host_site")."  FROM ".
                      MarketingLeadsWpLandingPageSite::getTable().
                    ";")
           ->makeSiteSqlQuery($site);
        
        if(!$db->getNumRows())
            return $results;
        
        while($row = $db->fetchArray())
        {
            $results[$row['site']]=$row['host_site'];
        }
        return $results;
    }
    
    public static function getCampaignsAndSiteForSelect($site=null)
    {
        $results = new mfArray();
        
        $db= mfSiteDatabase::getInstance();
        $db->setQuery("SELECT ".MarketingLeadsWpLandingPageSite::getTableField("id")." as site,".
                      MarketingLeadsWpLandingPageSite::getTableField("campaign").",".
                      MarketingLeadsWpLandingPageSite::getTableField("host_site")."  FROM ".
                      MarketingLeadsWpLandingPageSite::getTable().
                    ";")
           ->makeSiteSqlQuery($site);
        
        if(!$db->getNumRows())
            return $results;
        
        while($row = $db->fetchArray())
        {
            $results[$row['site']]=$row['campaign'].' ('.$row['host_site'].')';
        }
        return $results;
    }
    
    static function initializeSite($site=null)
    {
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())                
            ->setQuery("DELETE FROM ".MarketingLeadsWpLandingPageSite::getTable().";")               
            ->makeSiteSqlQuery($site);
        $db->setQuery("DELETE FROM ".MarketingLeadsWpForms::getTable().";")               
            ->makeSiteSqlQuery($site);
        $db->setQuery("DELETE FROM ". MarketingLeadsWpFormsLeadsImportErrors::getTable().";")               
            ->makeSiteSqlQuery($site);
        $db->setQuery("DELETE FROM ".MarketingLeadsWpFormsLeadsImportFile::getTable().";")               
            ->makeSiteSqlQuery($site);
        $db->setQuery("DELETE FROM ".MarketingLeadsWpFormsLeadsImportFormat::getTable().";")               
            ->makeSiteSqlQuery($site);
    } 
    
    public static function getSitesForEngine($site=null)
    {
        $results = new MarketingLeadsWpLandingPageSiteCollection(null,$site);
        
        $db= mfSiteDatabase::getInstance();
        $db->setQuery("SELECT * FROM ".MarketingLeadsWpLandingPageSite::getTable().
                      " WHERE ".MarketingLeadsWpLandingPageSite::getTableField('status')."='ACTIVE' ".
                      ";")
           ->makeSiteSqlQuery($site);
//        echo $db->getQuery()."<br />";
        if(!$db->getNumRows())
            return $results;
        
        while($item = $db->fetchObject("MarketingLeadsWpLandingPageSite"))
        {
            $results[$item->get('id')]=$item;
        }
        
        return $results;
    }
    
    function getRecoveredLeads()
    {
        return $this->leads= $this->leads ===null? new MarketingLeadsWpFormsCollection(null, $this->getSite()):$this->leads;
    }
}
