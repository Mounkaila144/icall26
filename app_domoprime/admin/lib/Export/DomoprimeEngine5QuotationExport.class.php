<?php


class DomoprimeEngine5QuotationExport  {
     
   
    static function getFieldsForExport()
    {      
        return new mfArray(array(
          
         'app.domoprime.quotation.rest_to_pay_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getRestToPayWithTax',array(),__('rest in charge with tax',array(),'fields')),  
         'app.domoprime.quotation.total_sale_and_adder_and_fee_without_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalSaleAndAdderAndFeeWithoutTax',array(),__('total sale & added & fee without tax',array(),'fields')),                         
         'app.domoprime.quotation.total_sale_and_adder_and_fee_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalSaleAndAdderAndFeeTax',array(),__('total sale & added & fee tax',array(),'fields')),  
         'app.domoprime.quotation.total_sale_and_adder_and_fee_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalSaleAndAdderAndFeeWithTax',array(),__('total sale & added & fee with tax',array(),'fields')),  
         'app.domoprime.quotation.total_prime_and_adder_and_fee_and_restincharge_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalPrimeAndAdderAndFeeAndRestInChargeWithTax',array(),__('total sale & added & rest in charge & fee with tax',array(),'fields')),         
         'app.domoprime.quotation.total_added_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalAddedWithTax',array(),__('total sale & added with tax',array(),'fields')),              
         'app.domoprime.quotation.tax_fee_file'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalTaxFeeFile',array(),__('fee file tax',array(),'fields')),                       
         'app.domoprime.quotation.product.sale_price_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProduct','getSalePriceWithTax',array(),__('Unit sale Price',array(),'fields')),                                  
         'app.domoprime.quotation.product.price_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProduct','getPriceAndAdderWithTax',array(),__('Unit Price',array(),'fields')),                      
         'app.domoprime.quotation.product.total_price_and_adder_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotationProduct','getTotalPriceAndAdderWithTax',array(),__('Tarif au m²',array(),'fields')),          
         'app.domoprime.quotation.total_sale_and_adder_with_tax'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getTotalSaleAndAdderTax',array(),__('Total 5.5',array(),'fields')),              
         'app.domoprime.quotation.fee_file'=>new AppDomoprimeExportMethodFormatExportModel('DomoprimeQuotation','getFeeFile',array(),__('Frais dossier ttc',array(),'fields')),              
          
             ));
    }
    
}
