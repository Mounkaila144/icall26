<?php

class CityUtils {
    
    static function getCity($parameters,$site)
    {
       $db=mfSiteDatabase::getInstance()
                ->setParameters($parameters)
                ->setQuery("SELECT postalcode,city FROM t_postalcode_city WHERE country='{country}' AND postalcode LIKE '{postcode}%%%%';")               
                ->makeSiteSqlQuery($site);   
       if (!$db->getNumRows())
            return array();
       $cities=array();
       while ($row=$db->fetchArray())
              $cities[]=$row;
       return $cities;
    }
    
    static function getCitySuperAdmin($parameters)
    {
       $db=mfSiteDatabase::getInstance()
                ->setParameters($parameters)
                ->setQuery("SELECT postalcode,city FROM t_postalcode_city WHERE country='{country}' AND postalcode LIKE '{postcode}%%%%';")               
                ->makeSqlQuerySuperAdmin();   
       if (!$db->getNumRows())
            return array();
       $cities=array();
       while ($row=$db->fetchArray())
              $cities[]=$row;
       return $cities;
    }
    
}