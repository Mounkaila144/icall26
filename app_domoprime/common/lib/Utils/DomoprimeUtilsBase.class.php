<?php


class DomoprimeUtilsBase {
    
    
    static function getNumberOfDoubleCalculation($site=null)
    {
        /*
        SELECT *,COUNT(contract_id) AS nbr_doublon FROM `t_domoprime_calculation` where isLast="YES" GROUP BY contract_id HAVING COUNT(contract_id) > 1
         */
        $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT COUNT(contract_id) AS nbr_doublon FROM ".DomoprimeCalculation::getTable().                      
                       " WHERE isLast='YES' GROUP BY contract_id HAVING COUNT(contract_id) > 1 ".
                       ";")
            ->makeSiteSqlQuery($site);
         $row=$db->fetchRow();
         return intval($row[0]); 
    }   
    
    static function getNumberOfDoubleQuotation($site=null)
    {
        /*
         SELECT *,COUNT(contract_id) AS nbr_doublon FROM `t_domoprime_quotation` where is_last="YES" GROUP BY contract_id HAVING COUNT(contract_id) > 1 
         */
        $db=mfSiteDatabase::getInstance()            
            ->setQuery("SELECT COUNT(contract_id) AS nbr_doublon FROM ".DomoprimeQuotation::getTable().                      
                       " WHERE is_last='YES' GROUP BY contract_id HAVING COUNT(contract_id) > 1 ".
                       ";")
            ->makeSiteSqlQuery($site);
         $row=$db->fetchRow();
         return intval($row[0]); 
    }     
    
    
    static function getClassEnergyZone($site=null)
    {
        $classes=DomoprimeClass::getClassForI18nSelect($site);
        $sectors=DomoprimeSector::getSectorForSelect($site);
        $energies=DomoprimeEnergy::getEnergyI18nListForSelect($site);
        $values=array();
        foreach ($classes as $class_id=>$class)
        {
            foreach ($sectors as $sector_id=>$sector)
            {    
                foreach ($energies as $energy_id=>$energy)            
                    $values[$class_id."_".$energy_id."_".$sector_id]=$class.":".$sector.":".$energy;
            }    
        }                    
        return $values;
    }   
    
    
   
}
