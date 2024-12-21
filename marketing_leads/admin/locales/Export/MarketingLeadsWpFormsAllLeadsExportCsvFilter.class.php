<?php

class MarketingLeadsWpFormsAllLeadsExportCsvFilter extends MarketingLeadsWpFormsAllLeadsExportCsvFilterBase {
    
    function execute()
    {                
        /*
         *  "SELECT {fields} FROM ".MarketingLeadsWpForms::getTable().
            " LEFT JOIN ".MarketingLeadsWpForms::getOuterForJoin('site_id').
            " WHERE ". 
            MarketingLeadsWpForms::getTableField('status')."='ACTIVE' ".
            $this->getFilter()->getWhere('AND').                            
            $this->getFilter()->getConditions()->getWhere("AND").  
            " GROUP BY ".MarketingLeadsWpForms::getTableField('id').
            " ORDER BY ".MarketingLeadsWpForms::getTableField("id")." ASC".
            ";"
        */
        $this->query->select("{fields}")
            ->from(MarketingLeadsWpForms::getTable())              
            ->left(MarketingLeadsWpForms::getOuterForJoin('site_id'))
            ->where(MarketingLeadsWpForms::getTableField('status')."='ACTIVE' ")
            ->where($this->getFilter()->getWhere())
            ->where($this->getFilter()->getConditions()->getWhere());
        
        $db=new mfSiteDatabase();
        $db->setParameters(array())
            ->setObjects(array('MarketingLeadsWpForms','MarketingLeadsWpLandingPageSite',
                              ))
            ->setQuery((string) $this->query)               
            ->makeSqlQuery(); 
        
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
}