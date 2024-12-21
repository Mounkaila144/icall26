<?php


class DomoprimeExport  {
     
   
    static function getFieldsForExport()
    {              
        return new mfArray(array(
            'app.domoprime.global.cumac_value'=>new AppDomoprimeExportModel('qmac_value',__("Global Cumac value",array(),'fields','app_domoprime')),
            'app.domoprime.product.cumac_value'=>new AppDomoprimeExportFormatProductModel('qmac_value',__("Cumac value for product",array(),'fields','app_domoprime')),
            'app.domoprime.product.cumac'=>new AppDomoprimeExportFormatProductModel('qmac',__("Cumac for product",array(),'fields','app_domoprime')),
            
            'app.domoprime.product.reference'=>new CustomerContractFormatExportModel('Product','reference',array("string"=>"upper")),             
            'app.domoprime.product.meta_title'=>new CustomerContractFormatExportModel('Product','meta_title',array("string"=>"upper")), 
            'app.domoprime.product.meta_description'=>new CustomerContractFormatExportModel('Product','meta_description',array("string"=>"upper")), 
            
            'app.domoprime.product.id'=>new AppDomoprimeExportFormatCalculationProductModel("product_id",__("Cumac for product id",array(),'fields','app_domoprime')),
            
            'app.domoprime.product.classic.cumac'=>new AppDomoprimeExportFormatClassicProductModel('classic_qmac',__("Cumac for product Classic",array(),'fields','app_domoprime')),
            'app.domoprime.product.modest.cumac'=>new AppDomoprimeExportModestProductModel('modest_qmac',__("Cumac product Modest",array(),'fields','app_domoprime')),                        
            'app.domoprime.product.surface'=>new AppDomoprimeExportFormatProductModel('surface',__("Surface",array(),'fields','app_domoprime')),
                        
            'app.domoprime.classic.global.cumac_value'=>new AppDomoprimeExportClassicModel('classic_qmac_value',__("Global Cumac value for classic",array(),'fields','app_domoprime')),
            'app.domoprime.modest.global.cumac_value'=>new AppDomoprimeExportModestModel('modest_qmac_value',__("Global Cumac value for modest",array(),'fields','app_domoprime')),
            
            'app.domoprime.very_modest.global.cumac_value'=>new AppDomoprimeExportVeryModestModel(),
            'app.domoprime.very_modest.global.cumac_value.zero'=>new AppDomoprimeExportVeryModestZeroModel(),
            
            'app.domoprime.class.name'=>new AppDomoprimeExportFormatExportModel('DomoprimeClass','name',array("string"=>"upper"),__('Class name',array(),'fields','app_domoprime')), 
            
            'app.domoprime.class.value'=>new AppDomoprimeExportFormatExportModel('DomoprimeClassI18n','value',array("string"=>"upper"),__('Class value',array(),'fields','app_domoprime')), 
            
            'app.domoprime.energy.name'=>new AppDomoprimeExportFormatExportModel('DomoprimeEnergy','name',array("string"=>"upper"),__('Energy name',array(),'fields','app_domoprime')), 
            'app.domoprime.energy.value'=>new AppDomoprimeExportFormatExportModel('DomoprimeEnergyI18n','value',array("string"=>"upper"),__('Energy value',array(),'fields','app_domoprime')),             
            'app.domoprime.sector.name'=>new AppDomoprimeExportFormatExportModel('DomoprimeSector','name',array("string"=>"upper"),__('Sector name',array(),'fields','app_domoprime')), 
            
            'app.domoprime.precarity'=>new AppDomoprimeExportPrecarityModel(), 
            'app.domoprime.modest'=>new AppDomoprimeExportPrecarityModestModel(), 
            'app.domoprime.very_modest'=>new AppDomoprimeExportPrecarityVeryModestModel(), 
            'app.domoprime.very_modest.zero'=>new AppDomoprimeExportPrecarityVeryModestZeroModel(), 
            
            'app.domoprime.classic.true'=>new AppDomoprimeExportPrecarityClassicModel(), 
            'app.domoprime.classic.false'=>new AppDomoprimeExportPrecarityClassicModel("0"), 
            
            'app.domoprime.modest.pourcentage'=>new AppDomoprimeExportPrecarityModestPourcentageModel(), 
            'app.domoprime.very_modest.pourcentage'=>new AppDomoprimeExportPrecarityVeryModestPourcentageModel(), 
            'app.domoprime.class.energy.sector'=>new AppDomoprimeExportClassEnergySectorModel(),   
            'app.domoprime.bonus_precarity'=>new AppDomoprimeExportBonusPrecarityModel(), // 0 classic 1 modeste ou tres modeste
            
            'app.domoprime.bonus_precarity_class'=>new AppDomoprimeExportBonusPrecarityClassicModel(), // 0 classic 1 modeste ou tres modeste
            
            'app.domoprime.quotation.dated_at'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotation','dated_at',array('format_date'=>'a'),__('Quotation date',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.reference'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotation','reference',array(),__('Quotation reference',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.prime'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotation','prime',array('format_number'=>'#.00'),__('Quotation prime',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.mark'=>new AppDomoprimeExportFormatExportModel('ProductItem','mark',array('string'=>'upper'),__('Quotation article mark',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.thermal.resistance'=>new AppDomoprimeExportFormatExportModel('ProductItem','input3',array('string'=>'upper'),__('Quotation article thermal resistance',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.input3'=>new AppDomoprimeExportFormatExportModel('ProductItem','input3',array('string'=>'upper'),__('Quotation input3',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.thickness'=>new AppDomoprimeExportFormatExportModel('ProductItem','thickness',array('string'=>'upper','format_number'=>'#'),__('Quotation article thickness',array(),'fields','app_domoprime')),             
            'app.domoprime.quotation.item.description'=>new AppDomoprimeExportFormatExportModel('ProductItem','description',array('string'=>'upper'),__('Quotation article description',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.reference'=>new AppDomoprimeExportFormatExportModel('ProductItem','reference',array('string'=>'upper'),__('Quotation article reference',array(),'fields','app_domoprime')),             
            'app.domoprime.quotation.signed_at'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotation','signed_at',array('format_date'=>array('d','q')),__('Quotation signature date',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.prime_one_euro'=>new AppDomoprimeExportFormatExportPrimeOneEuroModel('DomoprimeQuotation',__('Quotation one euro',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.one_euro'=>new AppDomoprimeExportFormatExportOneEuroModel('DomoprimeQuotation',__('Quotation one euro prime',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.details'=>new AppDomoprimeExportFormatExportModel('ProductItem','details',array(),__('Quotation article detail',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.input2'=>new AppDomoprimeExportFormatExportModel('ProductItem','input2',array(),__('Quotation article input2',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.input1'=>new AppDomoprimeExportFormatExportModel('ProductItem','input1',array(),__('Quotation article input1',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.content'=>new AppDomoprimeExportFormatExportModel('ProductItem','content',array(),__('Quotation article content',array(),'fields','app_domoprime')), 
            'app.domoprime.quotation.item.id'=>new AppDomoprimeExportFormatExportModel('ProductItem','id',array('string'=>'upper'),__('Quotation article id',array(),'fields','app_domoprime')),
            'app.domoprime.quotation.item.input4'=>new AppDomoprimeExportFormatExportModel('ProductItem','input4',array(),__('Quotation article input4',array(),'fields','app_domoprime')),
            'app.domoprime.quotation.item.input5'=>new AppDomoprimeExportFormatExportModel('ProductItem','input5',array(),__('Quotation article input5',array(),'fields','app_domoprime')),
            'app.domoprime.quotation.item.input6'=>new AppDomoprimeExportFormatExportModel('ProductItem','input6',array(),__('Quotation article input6',array(),'fields','app_domoprime')),
            'app.domoprime.quotation.item.input7'=>new AppDomoprimeExportFormatExportModel('ProductItem','input7',array(),__('Quotation article input7',array(),'fields','app_domoprime')),
            
          //  'app.domoprime.quotation.product.product_id'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotationProduct','product_id',array(),__('Quotation Product product_id',array(),'fields')), 
          //  'app.domoprime.quotation.product.item.id'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotationProductItem','id',array(),__('Quotation Product Item id',array(),'fields')), 
          //   'app.domoprime.quotation.product.item.item_id'=>new AppDomoprimeExportFormatExportModel('DomoprimeQuotationProductItem','item_id',array(),__('Quotation Product Item item_id',array(),'fields')),   
            
            'app.domoprime.billing.reference'=>new AppDomoprimeExportFormatExportModel('DomoprimeBilling','reference',array(),__('Billing reference',array(),'fields','app_domoprime')), 
            'app.domoprime.billing.dated_at'=>new AppDomoprimeExportFormatExportModel('DomoprimeBilling','dated_at',array('format_date'=>'a'),__('Billing date',array(),'fields','app_domoprime')), 
            'app.domoprime.billing.prime_one_euro'=>new AppDomoprimeExportFormatExportPrimeOneEuroModel('DomoprimeBilling',__('Billing one euro',array(),'fields','app_domoprime')), 
            'app.domoprime.billing.one_euro'=>new AppDomoprimeExportFormatExportOneEuroModel('DomoprimeBilling',__('Billing one euro prime',array(),'fields','app_domoprime')),

            'app.domoprime.free.payment.premium'=>new AppDomoprimeExportFreeModel(__("Payment of a premium in euros",array(),'fields','app_domoprime')),
            
            'app.domoprime.free.prime'=>new AppDomoprimeExportFreeModel(__("PRIME",array(),'fields')),
            
            'app.domoprime.forms.parcel_number'=>new AppDomoprimeCustomerMeetingFormsExportModel('cadastre','number',__("Parcel number",array(),'fields','app_domoprime')),
            
            'app.domoprime.document.signed_at'=>new AppDomoprimeExportFormatExportModel('DomoprimeYouSignMeetingDocumentForm','signed_at',array('format_date'=>array('d','q')),__('Document signature date',array(),'fields','app_domoprime')), 
                       
            'app.domoprime.quotation.product.item.total_price_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProductItem','getTotalSalePriceWithTax',array(),__('Total Product Item Price with tax',array(),'fields')),                      
            'app.domoprime.quotation.product.item.total_price_without_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProductItem','getTotalSalePriceWithoutTax',array(),__('Total Product Item Price without tax',array(),'fields')),                      
            
            'app.domoprime.quotation.product.item.price_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProductItem','getSalePriceWithTax',array(),__('Product Item Price with tax',array(),'fields')),                      
            'app.domoprime.quotation.product.item.price_without_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProductItem','getSalePriceWithoutTax',array(),__('Product Item Price without tax',array(),'fields')),                      
            
            'app.domoprime.occupation.name'=>new AppDomoprimeExportFormatExportModel('DomoprimeOccupation','name',array("string"=>"upper"),__('Occupation name',array(),'fields','app_domoprime')), 
            
            
            'app.domoprime.quotation.total_sale_without_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalSaleWithoutTax',array(),__('Total without tax',array(),'fields')),              
            
            'app.domoprime.type_grille_precarite_a_ou_b'=>new AppDomoprimeExportTypeGridPrecarityModel(), // 0 classic 1 modeste ou tres modeste
            
            'app.domoprime.intermediate'=>new AppDomoprimeExportPrecarityIntermediateModel(),  
            
            'app.domoprime.quotation.product.id'=>new AppDomoprimeExportFormatQuotationProductModel("product_id",__("Quotation for product id",array(),'fields','app_domoprime')),
            
            'app.domoprime.quotation.product.item.quantity'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProductItem','getQuantity',array(),__('Product Item Quantity',array(),'fields')),
             ));
    }
    
}
