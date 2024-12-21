<?php

class CustomerContractDetailExportCsvFilter extends CustomerContractExportCsvFilterBase {
    
    function getHeader()
    {
        return array(__("MEETING ID"),
                     __("DATE"),
                     __("INSTALL DATE"),
                     __("LASTNAME"),
                     __("FIRSTNAME"),
                     __("PHONE"),
                     __("MOBILE"),
                     __("PRODUCT"),                     
                     __("ONE SHOT"),
                     $this->encode(__("CONSUMED")),
                     __("PRORATA"),
                     __("DETAILS"),
                     __("HT"),
                     __('QUANTITY'),
                     __("TVA Amount"),
                     __("TVA"),
                     __("TTC"),  
                     __("ADDRESS"),
                     __("POSTCODE"),
                     __("CITY"),
                     __("SALE1"),
                     __("SALE2"),
                     __("TELEPRO"),
                     __("TEAM"),                    
                     __("STATE"),
                     __("PAYMENT")
                    );
    }
    
    function execute()
    {                                  
        $db=new mfSiteDatabase(); // Mandatory if other queries requested on filter
            $db->setParameters(array('lang'=>$this->getOption('lang'),'user_id'=>$this->getUser()->getGuardUser()->get('id')))
                ->setObjects(array('Customer','CustomerContract','CustomerAddress',
                                   'CustomerContractStatusI18n','CustomerContractStatus','Tax',
                                   'telepro'=>'User','sale1'=>'User','sale2'=>'User',
                                   'Partner','UserTeam','CustomerContractProduct','Product',
                                  ))
                ->setAlias(array('telepro'=>'telepro','sale1'=>'sale1','sale2'=>'sale2'))
                ->setQuery("SELECT {fields} ".                                
                           " FROM ".CustomerContract::getTable().
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('customer_id').
                           " LEFT JOIN ".CustomerAddress::getInnerForJoin('customer_id').  
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('state_id').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('telepro_id','telepro'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_1_id','sale1'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('sale_2_id','sale2').
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('financial_partner_id'). 
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('team_id').                          
                           " LEFT JOIN ".CustomerContract::getOuterForJoin('tax_id').
                           " LEFT JOIN ".CustomerContractProduct::getInnerForJoin('contract_id'). 
                           " LEFT JOIN ".CustomerContractProduct::getOuterForJoin('product_id'). 
                           " LEFT JOIN ".CustomerContractStatusI18n::getInnerForJoin('status_id')." AND ".CustomerContractStatusI18n::getTableField('lang')."='{lang}'".  
                           " WHERE ". 
                           CustomerContract::getTableField('status')."='ACTIVE' ".
                           $this->getFilter()->getWhere('AND').                            
                           $this->getFilter()->getConditions()->getWhere("AND").                             
                           " ORDER BY opened_at ASC".
                           ";")               
                ->makeSqlQuery(); 
      //     echo $db->getQuery();  die(__METHOD__);
        $this->open();
        $this->outputLine($this->getHeader());
        $this->getItemsFromDatabase($db);    
        $this->close();
    }
    
    
    
    protected function getItemsFromDatabase($db)
    {                         
        if (!$db->getNumRows())            
            return ;              
        while ($items=$db->fetchObjects())
        {           
          // var_dump($items->get('products'));          
           if ($items->hasTax())          
              $items->getCustomerContract()->set('tax_id',$items->getTax());                                           
           $this->outputLine(array(
               $items->getCustomerContract()->get('meeting_id'),
               $items->getCustomerContract()->get('opened_at')?format_date($items->getCustomerContract()->get('opened_at'),"a"):__('no date'),
               $items->getCustomerContract()->get('opc_at')?format_date($items->getCustomerContract()->get('opened_at'),"a"):__('no date'),
               $this->encode($items->getCustomer()->get('lastname'),self::UPPERCASE),
               $this->encode($items->getCustomer()->get('firstname'),self::UPPERCASE),
               $items->getCustomer()->get('phone'),
               $items->getCustomer()->get('mobile'),
               $this->encode($items->hasCustomerContractProduct()?$items->getProduct()->get('meta_title'):__('no product'),self::UPPERCASE),               
               $this->encode($items->hasCustomerContractProduct()?($items->getCustomerContractProduct()->get('is_one_shoot')=='YES'?__('YES'):__('NO')):"",self::UPPERCASE), 
               $this->encode($items->hasCustomerContractProduct()?($items->getCustomerContractProduct()->get('is_consumed')=='YES'?__('YES'):__('NO')):"",self::UPPERCASE), 
               $this->encode($items->hasCustomerContractProduct()?($items->getCustomerContractProduct()->get('is_prorata')=='YES'?__('YES'):__('NO')):"",self::UPPERCASE), 
               $items->getCustomerContract()->get('remarks'),
               format_number($items->getCustomerContract()->get('total_price_without_taxe',"0,00"),"#.00"),  // HT,
               $this->encode($items->hasCustomerContractProduct()?$items->getCustomerContractProduct()->get('quantity'):"",self::UPPERCASE), 
               format_number(($items->hasTax()?$items->getCustomerContract()->getTaxAmount():0),"#.00"), // TVA amount
               ($items->hasTax()?$items->getCustomerContract()->getFormattedTaxRate():__("No tax")),  // TVA rate     
               format_number($items->getCustomerContract()->get('total_price_with_taxe',"0,00"),"#.00"),  //TTC
               $this->encode($items->getCustomerAddress()->get('address1')." ".$items->getCustomerAddress()->get('address2'),self::UPPERCASE),
               $this->encode($items->getCustomerAddress()->get('postcode'),self::UPPERCASE),
               $this->encode($items->getCustomerAddress()->get('city'),self::UPPERCASE),               
               $this->encode($items->hasSale1()?$items->getSale1():__("no sale"),self::UPPERCASE),
               $this->encode($items->hasSale2()?$items->getSale2():__("no sale"),self::UPPERCASE),
               $this->encode($items->hasTelepro()?$items->getTelepro():__("no telepro"),self::UPPERCASE),
               $this->encode($items->hasUserTeam()?$items->getUserTeam()->get('name'):__("no team"),self::UPPERCASE),                             
               $this->encode($items->hasCustomerContractStatus()?$items->getCustomerContractStatusI18n():__("Not defined"),self::UPPERCASE),
               $this->encode($items->hasPartner()?$items->getPartner()->get('name'):__("Not defined"),self::UPPERCASE)
           ));
           
          
        }        
    }
}