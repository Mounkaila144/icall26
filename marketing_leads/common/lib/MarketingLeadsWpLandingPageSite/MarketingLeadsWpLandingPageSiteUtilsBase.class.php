<?php

class MarketingLeadsWpLandingPageSiteUtilsBase {
    
    static function getSitesForSelectForm($site=null)
    {
        $sites = new mfArray();
        $db = mfSiteDatabase::getInstance();
        $db->setParameters()
           ->setObjects(array())
           ->setQuery("SELECT * FROM ".MarketingLeadsWpLandingPageSite::getTable().";")
           ->makeSiteSqlQuery($site);
        
        if(!$db->getNumRows())
            return $sites;
        
        while ($item = $db->fetchObject('MarketingLeadsWpLandingPageSite'))
            $sites[$item->get('id')] = $item;
        
        echo "<pre>"; var_dump($sites); echo "</pre>";
        die(__METHOD__);
        return $sites;
    }
    
}

