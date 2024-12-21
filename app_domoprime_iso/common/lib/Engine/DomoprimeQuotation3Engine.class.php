<?php


 class DomoprimeQuotation3Engine extends DomoprimeQuotation2Engine {
      
     protected $mode=null;
      
     function getEngineNumber()
     {
        return "Engine3";
     }
     
      function calculate()
    {        
        $this->has_prime_one_euro=false;
        if ($this->getQuotation()->hasContract())
        {     
            $this->request=new DomoprimeCustomerRequest($this->getQuotation()->getContract());  
            $engine=new DomoprimeIsoEngine($this->getQuotation()->getContract());
            $engine->process();  
            $this->calculation=new DomoprimeCalculation($engine);
            $this->calculation->process($this->getUser());                   
        }   
        elseif ($this->getQuotation()->hasMeeting())
        {            
            $this->request=new DomoprimeCustomerRequest($this->getQuotation()->getMeeting());    
            $engine=new DomoprimeIsoEngine($this->getQuotation()->getMeeting());
            $engine->process();  
            $this->calculation=new DomoprimeCalculation($engine);
            $this->calculation->process($this->getUser());            
        }       
        if ($this->calculation->isNotLoaded())
            throw new DomoprimeQuotationEngineException(DomoprimeQuotationEngineException::ENGINE_ERROR_CALCULATION_INVALID);
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
        foreach ($this->getQuotation()->products as $quotation_product)
        {
               if ($this->mode==self::DISCOUNT_MODE)
                {                                           
                    $quotation_product->set('sale_discount_price_without_tax',$quotation_product->getProduct()->getDiscountPriceWithoutTax());
                    $quotation_product->set('sale_discount_price_with_tax',$quotation_product->getProduct()->getDiscountPriceWithTax());
                    $quotation_product->set('total_sale_discount_price_with_tax',$quotation_product->getProduct()->getDiscountPriceWithTax() * $quotation_product->get('quantity'));                    
                    $quotation_product->set('total_sale_discount_price_without_tax',$quotation_product->getProduct()->getDiscountPriceWithoutTax() * $quotation_product->get('quantity'));  
                } 
                else
                {                    
                    $quotation_product->set('sale_standard_price_without_tax',$quotation_product->getProduct()->getStandardPriceWithoutTax());
                    $quotation_product->set('sale_standard_price_with_tax',$quotation_product->getProduct()->getStandardPriceWithTax());
                    $quotation_product->set('total_sale_standard_price_with_tax',$quotation_product->getProduct()->getStandardPriceWithTax() * $quotation_product->get('quantity'));                    
                    $quotation_product->set('total_sale_standard_price_without_tax',$quotation_product->getProduct()->getStandardPriceWithoutTax() * $quotation_product->get('quantity'));  
                }    
        }                     
        
        foreach ($this->getQuotation()->getContract()->getProductItemsWithProductAndItem() as $item)
        {           
               $product=$this->getQuotation()->products[$item->getProduct()->get('id')];                             
               $product->set('purchase_price_without_tax',$item->getProduct()->getPurchasePriceWithoutTax());
               $product->set('purchase_price_with_tax',$item->getProduct()->getPurchasePriceWithTax());
               $product->set('sale_price_without_tax',$item->getProduct()->getSalePriceWithoutTax());
               $product->set('sale_price_with_tax',$item->getProduct()->getSalePriceWithTax());
               $product->set('total_purchase_price_with_tax',$item->getProduct()->getPurchasePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product->set('total_sale_price_with_tax',$item->getProduct()->getSalePriceWithTax() * $request->getQuantityByProduct($item->getProduct()));
               $product->set('total_purchase_price_without_tax',$item->getProduct()->getPurchasePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));
               $product->set('total_sale_price_without_tax',$item->getProduct()->getSalePriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));  
               if ($this->mode==self::DISCOUNT_MODE)
                {                                           
                 $product->set('sale_discount_price_without_tax',$item->getProduct()->getDiscountPriceWithoutTax());
                 $product->set('sale_discount_price_with_tax',$item->getProduct()->getDiscountPriceWithTax());                     
                 $product->set('total_sale_discount_price_with_tax',$item->getProduct()->getDiscountPriceWithTax() * $request->getQuantityByProduct($item->getProduct()));           
                 $product->set('total_sale_discount_price_without_tax',$item->getProduct()->getDiscountPriceWithoutTax() * $request->getQuantityByProduct($item->getProduct()));                          
                } 
               $this->getQuotation()->products[$item->getProduct()->get('id')]=$product;
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
      //   echo  $this->getQuotation()->items->getTotalSaleWithTax();
        // Sumarize by items
        $this->getQuotation()->set('total_sale_without_tax',$this->getQuotation()->items->getTotalSaleWithoutTax());
        $this->getQuotation()->set('total_sale_with_tax',$this->getQuotation()->items->getTotalSaleWithTax());
        $this->getQuotation()->set('total_sale_discount_without_tax',$this->getQuotation()->items->getTotalSaleDiscountWithoutTax());
        $this->getQuotation()->set('total_sale_discount_with_tax',$this->getQuotation()->items->getTotalSaleDiscountWithTax());
        $this->getQuotation()->set('total_purchase_without_tax',$this->getQuotation()->items->getTotalPurchaseWithoutTax());
        $this->getQuotation()->set('total_purchase_with_tax',$this->getQuotation()->items->getTotalPurchaseWithTax());
        $this->getQuotation()->set('prime',$this->getQuotation()->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge());
        $this->getQuotation()->set('fee_file',$this->getFeeFile());
        $this->getQuotation()->set('creator_id',$user);
        $this->getQuotation()->set('engine',$this->getEngineNumber());
                
        $this->processPreQuotation();                        
        
        $this->getQuotation()->save();       
        $this->process();                                                      
         return $this;
     }  
     
     function getMode()
     {
         return $this->mode;
     }
     
     function processPreQuotation()
     {
         return $this;
     }
}
