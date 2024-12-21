<?php


 class DomoprimeQuotation5Engine extends DomoprimeQuotation4Engine {
     
     function configure()
     {
        $this->settings=new DomoprimeIsoSettings(null,$this->getSite());
     }
     
     function getEngineNumber()
     {
        return "Engine5";
     }
     
     function createFromItemsAndRequest(DomoprimeCustomerRequest $request,$user)
     {                   
        $this->getQuotation()->set('reference',$this->getQuotation()->getFormattedReference());
          // Update surfaces           
        $this->getQuotation()->products=new DomoprimeQuotationProductCollection(null,$this->getSite());           
        foreach ($this->getQuotation()->getContract()->getProductItemsWithProductAndItem() as $item)
        {            
               $product=new DomoprimeQuotationProduct(null,$this->getSite());                
               $product->set('quotation_id',$this->getQuotation());
               $product->set('quantity',$request->getQuantityByProduct($item->getProduct()));
               $product->set('title',$item->getProduct()->get('meta_title'));
               $product->set('product_id',$item->getProduct());
               $product->set('contract_id',$this->getQuotation()->getContract());
               $product->set('meeting_id',$this->getQuotation()->getContract()->hasMeeting()?$this->getQuotation()->getContract()->getMeeting():null);                                                          
               $this->getQuotation()->products[$item->getProduct()->get('id')]=$product;
        }          
        $this->calculate();      
        $this->mode=$this->getCalculation()->getClass()->get('id')==$this->getSettings()->getClassicClass()->get('id')?self::DISCOUNT_MODE:self::NORMAL_MODE;                               
        // Affect price to product        
        $types=$this->getSettings()->getNamingsForProducts();        
        foreach ($this->getQuotation()->products as $quotation_product)
        {                        
               $type=$types[$quotation_product->get('product_id')];                 
               $quotation_product->set('restincharge_price_with_tax',$request->get('restincharge_price_with_tax_'.$type));
               $quotation_product->set('added_price_with_tax',$request->get('added_price_with_tax_'.$type));
               $quotation_product->set('total_restincharge_price_with_tax',$request->getRestinchargePriceWithTaxForType($type));            
               $quotation_product->set('total_added_price_with_tax',$request->getAddedPriceWithTaxForType($type) * $quotation_product->getQuantity());
                           
               $this->getQuotation()->set('total_added_with_tax_'.$type,$quotation_product->get('total_added_price_with_tax'));
               $this->getQuotation()->set('total_restincharge_with_tax_'.$type,$quotation_product->get('total_restincharge_price_with_tax'));
                            
                if ($this->mode==self::DISCOUNT_MODE)
                {                                           
                    $quotation_product->set('sale_discount_price_without_tax',$quotation_product->getProduct()->getDiscountPriceWithoutTax());
                    $quotation_product->set('sale_discount_price_with_tax',$quotation_product->getProduct()->getDiscountPriceWithTax());
                    $quotation_product->set('total_sale_discount_price_with_tax',$quotation_product->getProduct()->getDiscountPriceWithTax() * $quotation_product->getQuantity());                    
                    $quotation_product->set('total_sale_discount_price_without_tax',$quotation_product->getProduct()->getDiscountPriceWithoutTax() * $quotation_product->getQuantity());  
                    
                    $quotation_product->set('sale_price_without_tax',$quotation_product->get('sale_discount_price_without_tax'));
                    $quotation_product->set('sale_price_with_tax',$quotation_product->get('sale_discount_price_with_tax'));
                    $quotation_product->set('total_sale_price_with_tax',$quotation_product->get('total_sale_discount_price_with_tax'));
                    $quotation_product->set('total_sale_price_without_tax',$quotation_product->get('total_sale_discount_price_without_tax'));
                } 
                else
                {                    
                    $quotation_product->set('sale_standard_price_without_tax',$quotation_product->getProduct()->getStandardPriceWithoutTax());
                    $quotation_product->set('sale_standard_price_with_tax',$quotation_product->getProduct()->getStandardPriceWithTax());
                    $quotation_product->set('total_sale_standard_price_with_tax',$quotation_product->getProduct()->getStandardPriceWithTax() * $quotation_product->getQuantity());                    
                    $quotation_product->set('total_sale_standard_price_without_tax',$quotation_product->getProduct()->getStandardPriceWithoutTax() * $quotation_product->getQuantity());  
                    
                    $quotation_product->set('sale_price_without_tax',$quotation_product->get('sale_standard_price_without_tax'));
                    $quotation_product->set('sale_price_with_tax',$quotation_product->get('sale_standard_price_with_tax'));
                    $quotation_product->set('total_sale_price_with_tax',$quotation_product->get('total_sale_standard_price_with_tax'));
                    $quotation_product->set('total_sale_price_without_tax',$quotation_product->get('total_sale_standard_price_without_tax'));
                }    
        }                                  
        $this->getQuotation()->products->save();                                                      
        $this->getQuotation()->items=new DomoprimeQuotationProductItemCollection(null,$this->getSite());
        foreach ($this->getQuotation()->getContract()->getProductItemsWithProductAndItem() as $item)
        {
            
           // echo "<pre>"; var_dump($item); return $this;
               $product_item=new DomoprimeQuotationProductItem(null,$this->getSite());                
               $product_item->set('quotation_id',$this->getQuotation());
               $product_item->set('quotation_product_id',$this->getQuotation()->products[$item->getProduct()->get('id')]);
               $product_item->set('product_id',$item->getItem()->get('product_id'));
               $product_item->set('item_id',$item->getItem());
               $product_item->set('quantity',$request->getQuantityByProduct($item->getProduct()));
               $product_item->set('tva_id',$item->getItem()->get('tva_id'));       
               $product_item->set('is_master','YES');
               $product_item->set('purchase_price_without_tax',$item->getItem()->getPurchasePriceWithoutTax());
               $product_item->set('purchase_price_with_tax',$item->getItem()->getPurchasePriceWithTax());
               $product_item->set('sale_price_without_tax',$item->getItem()->getSalePriceWithoutTax());
               $product_item->set('sale_price_with_tax',$item->getItem()->getSalePriceWithTax());
               $product_item->set('total_purchase_price_with_tax',$item->getItem()->getPurchasePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product_item->set('total_sale_price_with_tax',$item->getItem()->getSalePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product_item->set('total_purchase_price_without_tax',$item->getItem()->getPurchasePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));
               $product_item->set('total_sale_price_without_tax',$item->getItem()->getSalePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));  
                if ($this->mode==self::DISCOUNT_MODE)                
                {
                     $product_item->set('sale_discount_price_without_tax',$item->getItem()->getDiscountPriceWithoutTax());
                     $product_item->set('sale_discount_price_with_tax',$item->getItem()->getDiscountPriceWithTax());             
                     $product_item->set('total_sale_discount_price_with_tax',$item->getItem()->getDiscountPriceWithTax() * $request->getQuantityByProduct($item->getProduct()));              
                     $product_item->set('total_sale_discount_price_without_tax',$item->getItem()->getDiscountPriceWithoutTax() * $request->getQuantityByProduct($item->getProduct())); 
                } 
               $this->getQuotation()->items[]=$product_item;
        }         
        $this->getQuotation()->items->save(); 
     
        // Sumarize by products
        $this->getQuotation()->set('total_sale_without_tax',$this->getQuotation()->products->getTotalSaleWithoutTax());        
        $this->getQuotation()->set('total_sale_with_tax',$this->getQuotation()->products->getTotalSaleWithTax());         
        $this->getQuotation()->set('fee_file',$this->getFeeFile());
        $this->getQuotation()->set('creator_id',$user);
        $this->getQuotation()->set('engine',$this->getEngineNumber());                
        $this->processPreQuotation();                                
        $this->getQuotation()->save();       
        $this->process();                                                      
         return $this;
     }  
     
    
}
