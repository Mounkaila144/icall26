<?php


class DomoprimeCalculation extends DomoprimeCalculationBase {
     
   
   
    static function getTotalSurfacesForFormFilter($formfilter)
    {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("SELECT SUM(".DomoprimeProductCalculation::getTableField('surface').") FROM ".DomoprimeCalculation::getTable().                         
                           " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('meeting_id').
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " INNER JOIN ".DomoprimeProductCalculation::getInnerForJoin('calculation_id').
                           " WHERE  ".$formfilter->getWhere().
                           ";")               
                ->makeSiteSqlQuery(); 
         $row=$db->fetchRow();
         return new FloatFormatter($row[0]);
    }
    
     static function getTotalCumacValuesForFormFilter($formfilter)
    {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("SELECT SUM(".DomoprimeCalculation::getTableField('qmac_value').") FROM ".DomoprimeCalculation::getTable().                                                    
                           " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('meeting_id').
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " WHERE  ".$formfilter->getWhere().
                           ";")               
                ->makeSiteSqlQuery(); 
         $row=$db->fetchRow();
         return new FloatFormatter($row[0]);
    }
    
      static function getTotalCumacsForFormFilter($formfilter)
    {
         $db=mfSiteDatabase::getInstance();
                $db->setParameters(array())               
                ->setQuery("SELECT SUM(".DomoprimeCalculation::getTableField('qmac').") FROM ".DomoprimeCalculation::getTable().                                                    
                           " INNER JOIN ".DomoprimeCalculation::getOuterForJoin('meeting_id').
                           " INNER JOIN ".CustomerContract::getInnerForJoin('meeting_id').
                           " WHERE  ".$formfilter->getWhere().
                           ";")               
                ->makeSiteSqlQuery(); 
         $row=$db->fetchRow();
         return new FloatFormatter($row[0]);
    }
}
