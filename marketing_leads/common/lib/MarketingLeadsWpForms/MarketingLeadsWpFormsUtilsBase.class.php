<?php

class MarketingLeadsWpFormsUtilsBase {
    
    static function changeState(MarketingLeadsWpFormsAllFormFilter $filter)
    {
        /*
         * UPDATE t_marketing_leads_wp_forms 
           LEFT JOIN t_marketing_leads_wp_landing_page_site 
           ON t_marketing_leads_wp_landing_page_site.id=t_marketing_leads_wp_forms.site_id 
           SET t_marketing_leads_wp_forms.state='EXPORTED'
           WHERE t_marketing_leads_wp_forms.status='ACTIVE'
        */
        $db=new mfSiteDatabase();
        $db->setParameters(array())
            ->setQuery(" UPDATE ".MarketingLeadsWpForms::getTable().
                       " LEFT JOIN ".MarketingLeadsWpForms::getOuterForJoin('site_id').
                       " SET ".MarketingLeadsWpForms::getTableField("state")."='EXPORTED'".
                       " WHERE ". 
                       MarketingLeadsWpForms::getTableField('status')."='ACTIVE' ".
                       $filter->getWhere('AND').                            
                       $filter->getConditions()->getWhere("AND").  
                       ";")               
            ->makeSqlQuery();
    }
    
    static function getOwnerWithI18n()
    {
        $owner_i18n = new mfArray();
        foreach (array("tenant","owner","non_occupant_owner") as $value)
        {
            $owner_i18n[$value] = __(ucfirst($value));
        }
        return $owner_i18n;
    }
    
    static function getEnergyWithI18n()
    {
        $energy_i18n = new mfArray();
        foreach (array("electricity","combustible") as $value)
        {
            $energy_i18n[$value] = __(ucfirst($value));
        }
        return $energy_i18n;
    }
    /* CLEAN UP */
    static function cleanUpPhones($site=null)
    {
        //clean phone
        //str_replace +33 => 06
        //UPDATE your_table
        //SET your_field = REPLACE(your_field, 'str_src', 'str_dest')
        //WHERE your_field LIKE '+33%'
        //SELECT * FROM `t_marketing_leads_wp_forms` WHERE phone LIKE '+33%';
        
        $db = mfSiteDatabase::getInstance()
              ->setParameters(array())
              ->setQuery("UPDATE ".MarketingLeadsWpForms::getTable().
                         " SET ".MarketingLeadsWpForms::getTableField('phone').
                                "=REPLACE(".MarketingLeadsWpForms::getTableField('phone').",'+33','0')".
                         " WHERE ".MarketingLeadsWpForms::getTableField('phone')." LIKE '+33%'".
                         ";")
              ->makeSiteSqlQuery($site);
        
    }
    
    static function cleanUpPostCodes($site=null)
    {
        //clean pc tester si cp length == 5 chifres si non => remplire avec des 0.
        //UPDATE `t_marketing_leads_wp_forms` SET postcode=RPAD(postcode, 5, "0") 
        //WHERE .... 
        //SELECT * FROM `t_marketing_leads_wp_forms` WHERE LENGTH(postcode)<5 AND postcode>0
        $db = mfSiteDatabase::getInstance()
              ->setParameters(array())
              ->setQuery("UPDATE ".MarketingLeadsWpForms::getTable().
                         " SET ".MarketingLeadsWpForms::getTableField('postcode').
                            "=RPAD(".MarketingLeadsWpForms::getTableField('postcode').", 5, '0')".
                         " WHERE LENGTH(".MarketingLeadsWpForms::getTableField('postcode').")<5".
                            " AND ".MarketingLeadsWpForms::getTableField('postcode').">0".
                         ";")
              ->makeSiteSqlQuery($site);
        
    }
    
    static function cleanDuplicates($site=null)
    {
        //clean duplicate
        //if duplecate put status is_duplicate => YES
        //SELECT * FROM `t_marketing_leads_wp_forms` WHERE is_duplicate='NO' GROUP BY phone HAVING COUNT(phone)>1;
        $db = mfSiteDatabase::getInstance()
              ->setParameters(array())
              ->setQuery("SELECT * FROM ".MarketingLeadsWpForms::getTable().
                         " WHERE ".MarketingLeadsWpForms::getTableField('is_duplicate')."='NO'".
                         " GROUP BY ".MarketingLeadsWpForms::getTableField('phone').
                         " HAVING ".MarketingLeadsWpForms::getTableField('phone')."<> '' AND COUNT(".MarketingLeadsWpForms::getTableField('phone').")>1".
                         ";")
              ->makeSiteSqlQuery($site);
        
        if(!$db->getNumRows())
            return;
        
        $leads = new MarketingLeadsWpFormsCollection(null,$site);
        while ($item = $db->fetchObject("MarketingLeadsWpForms"))
        {
            $item->loaded();
            $item->set('is_duplicate','YES');
            $leads[$item->get('id')] = $item; 
        }
        
        $leads->loaded()->save();
    }
    
    static function blacklistPhones($site=null)
    {
        //blacklist the phone
        $values = new mfArray();
        $settings = MarketingLeadsWpSettings::load($site);
        if(!$settings->hasBlacklistPhonesList())
            return;
        $db = mfSiteDatabase::getInstance()
              ->setParameters(array())
              ->setQuery("UPDATE ".MarketingLeadsWpForms::getTable(). 
                         " SET ".MarketingLeadsWpForms::getTableField('phone_status')." = 'WrongNumber'".
                         " WHERE ".MarketingLeadsWpForms::getTableField('phone')." IN('".$settings->getBlacklistPhonesList()->implode("','")."')".
                         ";")
              ->makeSiteSqlQuery($site);
    }
    /* END */
    
    static function getZones()
    {
        $zones = new mfArray();
        
        $db = mfSiteDatabase::getInstance()
              ->setParameters(array())
              ->setQuery("SELECT DISTINCT(".MarketingLeadsWpForms::getTableField('zone').")".
                         " FROM ".MarketingLeadsWpForms::getTable().
                         ";")
              ->makeSiteSqlQuery($site);
        if(!$db->getNumRows())
            return $zones;
        
        while($row = $db->fetchArray())
        {
            $zones[$row['zone']] = $row['zone'];
        }
        
        return $zones->filter();
    }
    
    function getPhoneStatus()
    {
        $values = new mfArray();
        
        $db = mfSiteDatabase::getInstance()
              ->setParameters(array())
              ->setQuery("SELECT DISTINCT(".MarketingLeadsWpForms::getTableField('phone_status').")".
                         " FROM ".MarketingLeadsWpForms::getTable().
                         ";")
              ->makeSiteSqlQuery($site);
        if(!$db->getNumRows())
            return $values;
        
        while($row = $db->fetchArray())
        {
            $values[$row['phone_status']] = __($row['phone_status']);
        }
        
        return $values->filter();
    }
}