<?php


class DomoprimeIsoExport  {
     
   
    static function getFieldsForExport()
    {
        return new mfArray(array(
              'app.domoprime.request.surface.wall'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','surface_wall',array('format_number'=>'#.00'),__('Surface 102',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.surface.floor'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','surface_floor',array('format_number'=>'#.00'),__('Surface 103',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.surface.top'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','surface_top',array('format_number'=>'#.00'),__('Surface 101',array(),'fields','app_domoprime_iso')), 
              
              'app.domoprime.request.install.surface.wall'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','install_surface_wall',array('format_number'=>'#.00'),__('Install surface 102',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.install.surface.floor'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','install_surface_floor',array('format_number'=>'#.00'),__('Install surface 103',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.install.surface.top'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','install_surface_top',array('format_number'=>'#.00'),__('Install surface 101',array(),'fields','app_domoprime_iso')), 
            
              'app.domoprime.request.parcel.surface'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','parcel_surface',array('format_number'=>'#.00'),__('Parcel surface',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.parcel.reference'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','parcel_reference',array(),__('Parcel reference',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.revenue'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','revenue',array('format_number'=>'#'),__('Revenue',array(),'fields','app_domoprime_iso')),
              'app.domoprime.request.number_of_fiscal'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','number_of_fiscal',array('number_of_fiscal'=>'#'),__('Number of fiscal',array(),'fields','app_domoprime_iso')),
              'app.domoprime.request.more_2_years'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','more_2_years',array(),__('More 2 years',array(),'fields','app_domoprime_iso')),
              'app.domoprime.request.number_of_children'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','number_of_children',array('format_number'=>'#.0'),__('Number of children',array(),'fields','app_domoprime_iso')),
              'app.domoprime.request.number_of_people'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','number_of_people',array('format_number'=>'#.0'),__('Number of people',array(),'fields','app_domoprime_iso')),
              'app.domoprime.request.declarants'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','declarants',array(),__('Declarants',array(),'fields','app_domoprime_iso')),
              'app.domoprime.request.number_of_parts'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','number_of_parts',array(),__('Number of parts',array(),'fields','app_domoprime_iso')),
                  
              'app.domoprime.request.occupation.name'=>new AppDomoprimeExportFormatExportModel('DomoprimeOccupation','name',array(),__('Occupation name',array(),'fields','app_domoprime_iso')),                       
              'app.domoprime.request.occupation.value'=>new AppDomoprimeExportFormatExportModel('DomoprimeOccupationI18n','value',array(),__('Occupation',array(),'fields','app_domoprime_iso')),                       
            
              'app.domoprime.request.parcel_number'=>new AppDomoprimeCustomerRequestExportModel('parcel_reference',__("Parcel number",array(),'fields','app_domoprime_iso')),
     
            
              'app.domoprime.request.added_with_tax.wall'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','added_price_with_tax_wall',array('format_number'=>'#.00'),__('Added price 102',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.added_with_tax.floor'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','added_price_with_tax_floor',array('format_number'=>'#.00'),__('Added price 103',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.added_with_tax.top'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','added_price_with_tax_top',array('format_number'=>'#.00'),__('Added price 101',array(),'fields','app_domoprime_iso')), 
            
              'app.domoprime.request.restincharge_with_tax.wall'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','restincharge_price_with_tax_wall',array('format_number'=>'#.00'),__('Restincharge price 102',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.restincharge_with_tax.floor'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','restincharge_price_with_tax_floor',array('format_number'=>'#.00'),__('Restincharge price 103',array(),'fields','app_domoprime_iso')), 
              'app.domoprime.request.restincharge_with_tax.top'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','restincharge_price_with_tax_top',array('format_number'=>'#.00'),__('Restincharge price 101',array(),'fields','app_domoprime_iso')), 
            
            //  'app.domoprime.request.quantity.boiler'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','boiler_quantity',array('format_number'=>'#.00'),__('Qty Boiler',array(),'fields','app_domoprime_iso')), 
            //  'app.domoprime.request.quantity.pack'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','boiler_quantity',array('format_number'=>'#.00'),__('Qty Boiler',array(),'fields','app_domoprime_iso')), 
                'app.domoprime.request.surface.home'=>new AppDomoprimeExportFormatExportModel('DomoprimeCustomerRequest','surface_home',array('format_number'=>'#.00'),__('Surface home',array(),'fields','app_domoprime_iso')), 
                'app.domoprime.request.surface.home.coef.cumac.vmc'=>new AppDomoprimeCoefCumacVmcExportModel(),                
            
             ));
    }
    
}
