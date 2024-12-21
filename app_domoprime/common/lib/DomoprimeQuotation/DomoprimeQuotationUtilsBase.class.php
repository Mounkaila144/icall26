<?php

class DomoprimeQuotationUtilsBase  {
     
    static function updateQuotationWithContractFromMultipleMeetings(CustomerMeetingMultipleProcess $multiple)
    {          
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("UPDATE ".DomoprimeQuotation::getTable(). 
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('meeting_id').                            
                           " INNER JOIN ".CustomerContract::getTable()." ON ".CustomerContract::getTableField('meeting_id')."=".DomoprimeQuotation::getTableField('meeting_id').
                           " SET ".DomoprimeQuotation::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                           " WHERE ".DomoprimeQuotation::getTableField('meeting_id')." IN('".$multiple->getSelection()->implode("','")."') AND ".
                                        DomoprimeQuotation::getTableField('contract_id')." IS NULL" .
                           ";")               
                ->makeSiteSqlQuery($multiple->getSite());                  
    
    }
     
   static function updateQuotationWithContractFromMultipleContracts(CustomerContractMultipleProcess $multiple)
    {          
        $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("UPDATE ".DomoprimeQuotation::getTable(). 
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('meeting_id').                            
                           " INNER JOIN ".CustomerContract::getTable()." ON ".CustomerContract::getTableField('meeting_id')."=".DomoprimeQuotation::getTableField('meeting_id').
                           " SET ".DomoprimeQuotation::getTableField('contract_id')."=".CustomerContract::getTableField('id').
                           " WHERE ".CustomerContract::getTableField('id')." IN('".$multiple->getSelection()->implode("','")."') AND ".
                                DomoprimeQuotation::getTableField('contract_id')." IS NULL" .
                           ";")               
                ->makeSiteSqlQuery($multiple->getSite());                  
    
    }
    
     
     static function transferSignedAtToSavAtContract($site=null)
    {
        $settings =new DomoprimeYouSignEvidenceSettings();
        if(!$settings->hasTranferQuotationSignatureDateToSavAtContract())
            return;
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("UPDATE ". DomoprimeQuotation::getTable().
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('contract_id').
                           " SET ".CustomerContract::getTableField('sav_at')."=".DomoprimeQuotation::getTableField('signed_at').
                           " WHERE ".DomoprimeQuotation::getTableField('is_last')."='YES' ".
                                " AND ".DomoprimeQuotation::getTableField('is_signed')."='YES'".
                                " AND ".DomoprimeQuotation::getTableField('signed_at')." IS NOT NULL".
                            ";")     
               ->makeSiteSqlQuery($site);          
    }  
    
     static function transferSignedAtToOpenedAtContract($site=null)
    {
        $settings =new DomoprimeYouSignEvidenceSettings();
        if(!$settings->hasTranferQuotationSignatureDateToOpenedContract())
            return;
       $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("UPDATE ". DomoprimeQuotation::getTable().
                           " INNER JOIN ".DomoprimeQuotation::getOuterForJoin('contract_id').
                           " SET ".CustomerContract::getTableField('opened_at')."=".DomoprimeQuotation::getTableField('signed_at').
                           " WHERE ".DomoprimeQuotation::getTableField('is_last')."='YES' ".
                                " AND ".DomoprimeQuotation::getTableField('is_signed')."='YES'".
                                " AND ".DomoprimeQuotation::getTableField('signed_at')." IS NOT NULL".
                            ";")          
               ->makeSiteSqlQuery($site);          
    }  
    
   /* static function getPollutersForPager($pager)
    {
         if (!$pager->hasItems())
                 return ;
         $filter = $pager->getFilter();
         
         var_dump($filter['equal']['meeting_id']->getValue(),$filter['equal']['contract_id']->getValue());
         if ($filter['equal']['meeting_id']->getValue())
             
           $query = " INNER JOIN ".CustomerMeeting::getOuterForJoin()
         $db=mfSiteDatabase::getInstance()
                ->setParameters(array())
                ->setQuery("SELECT ".PartnerPolluterCompany::getFieldsAndKeyWithTable().",".DomoprimeQuotation::getTableField('id')." as quotation_id FROM ". DomoprimeQuotation::getTable().                          
                           
                           " WHERE ".DomoprimeQuotation::getTableField('id')." IN('".mfArray::create($pager->getKeys())->implode("','")."')".
                            ";")          
               ->makeSiteSqlQuery($pager->getSite());   
       echo $db->getQuery() ;
    }*/
}
