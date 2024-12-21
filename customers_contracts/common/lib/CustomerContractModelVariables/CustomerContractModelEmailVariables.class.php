<?php


class CustomerContractModelEmailVariables extends UtilsModelVariables {
    
    
    function configure($dictionnary='dictionary')
    {
        $this->variables= array(
            'contract.id'=>__('id','',$dictionnary),
            'contract.reference'=>__('reference','',$dictionnary),
            'contract.remarks'=>__('Remarks','',$dictionnary),
            'contract.partner.name'=>__('financial partner:name','',$dictionnary),
            'contract.partner.siret'=>__('financial partner:siret','',$dictionnary),
            'contract.partner.address1'=>__('financial partner:address1','',$dictionnary),
            'contract.partner.address2'=>__('financial partner:address2','',$dictionnary),
            'contract.partner.postcode'=>__('financial partner:postcode','',$dictionnary),
            'contract.partner.phone'=>__('financial partner:phone','',$dictionnary),
            'contract.partner.mobile'=>__('financial partner:mobile','',$dictionnary),
            'contract.partner.city'=>__('financial partner:city','',$dictionnary),
            'contract.partner.contact.lastname'=>__('financial partner:lastname','',$dictionnary),
            'contract.partner.contact.firstname'=>__('financial partner:firstname','',$dictionnary),
            'contract.partner.contact.mobile'=>__('financial partner contact:mobile','',$dictionnary),
            'contract.partner.contact.phone'=>__('financial partner contact:phone','',$dictionnary),
            'contract.tax'=>__('tax','',$dictionnary),
            'contract.opened_at.ddmmyyyy'=>__('opened date DD/MM/YYYY','',$dictionnary),  
            'contract.opened_at.ddmmyy'=>__('opened date DD/MM/YY','',$dictionnary),  
            'contract.total_price_with_taxe'=>__('total price with tax','',$dictionnary),
            'contract.total_price_without_taxe'=>__('total price without tax','',$dictionnary), 
            'contract.tax_amount'=>__('tax amount','',$dictionnary), 
            'contract.team'=>__('team','',$dictionnary),
            'contract.telepro'=>__('telepro','',$dictionnary),
            'contract.sale_1'=>__('sale 1','',$dictionnary),
            'contract.sale_2'=>__('sale 2','',$dictionnary),
            'contract.manager'=>__('manager','',$dictionnary),        
            'contract.sent_at'=>__("sent date",'',$dictionnary),
            'contract.payment_at'=>__('payment date','',$dictionnary),
            'contract.state'=>__('state','',$dictionnary),            
            'contract.opc_at.ddmmyyyy'=>__('opc date DD/MM/YYYY','',$dictionnary),  
            'contract.opc_at.tomorrow.ddmmyyyy'=>__('opc date +1 day  DD/MM/YYYY','',$dictionnary),  
            'contract.opc_at.ddmmyy'=>__('opc date DD/MM/YY','',$dictionnary), 
            'contract.apf_at.ddmmyyyy'=>__('apf date DD/MM/YYYY','',$dictionnary),  
         //   'contract.apf_at.ddmmyy'=>__('apf date date DD/MM/YY','',$dictionnary),  
            'contract.created_at.ddmmyyyy'=>__('creation date DD/MM/YYYY','',$dictionnary),                
            'contract.created_at.yyyymmdd'=>__('creation date YYYYMMDD','',$dictionnary),  
            'contract.created_at.ddmmyy'=>__('creation date DD/MM/YY','',$dictionnary),
            'contract.updated_at.ddmmyyyy'=>__('update date DD/MM/YYYY','',$dictionnary),  
            'contract.updated_at.ddmmyy'=>__('update date DD/MM/YY','',$dictionnary),           
            'contract.products'=>__('sold products','',$dictionnary),
            'contract.state'=>__('state','',$dictionnary),
            'contract.opc_status'=>__('opc status','',$dictionnary),
            'contract.opc_range'=>__('opc range','',$dictionnary),
            'contract.sav_at.ddmmyyyy'=>__('sav date DD/MM/YYYY','',$dictionnary),              
            'contract.sav_at.ddmmyy'=>__('sav date DD/MM/YY','',$dictionnary), 
            'contract.time_status'=>__('time status','',$dictionnary),     
            'contract.admin_status'=>__('admin status','',$dictionnary),     
         //   'contract.total_price_without_tax'=>__('price without tax','',$dictionnary),           
         //   'contract.total_price_with_tax'=>__('price with tax','',$dictionnary),
         //   'contract.tax_amount'=>__('tax amount','',$dictionnary),           
            'contract.tax_rate'=>__('tax rate','',$dictionnary), 
            
            'contract.quoted_at.ddmmyyyy'=>__('Quotation date DD/MM/YYYY','',$dictionnary),              
            'contract.quoted_at.ddmmyy'=>__('Quotation date DD/MM/YY','',$dictionnary), 
            
            'contract.billing_at.ddmmyyyy'=>__('Billing date DD/MM/YYYY','',$dictionnary),              
            'contract.billing_at.ddmmyy'=>__('Billing date DD/MM/YY','',$dictionnary), 
        );
    } 
 
     
}


