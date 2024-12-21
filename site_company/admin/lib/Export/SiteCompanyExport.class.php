<?php


class SiteCompanyExport  {
     
   
    static function getFieldsForExport()
    {
        return new mfArray(array(
            
            'site.company.name'=>new SiteExportFormatExportModel('name',array("string"=>"upper"),__('Name',array(),'fields')), 
            'site.company.siret'=>new SiteExportFormatExportModel('siret',array("string"=>"upper"),__('Siret',array(),'fields')),
            'site.company.rcs'=>new SiteExportFormatExportModel('rcs',array("string"=>"upper"),__('RCS',array(),'fields')),
         ));
    }
    
}
