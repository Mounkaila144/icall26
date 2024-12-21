<?php


 class DomoprimeQuotation2Engine extends DomoprimeQuotationEngine {
     
     const NORMAL_MODE=1;
     const DISCOUNT_MODE=2;
     
     function update(mfForm $form,User $user)
     {
         // Update surfaces
        $this->getQuotation()->add($form->getValues());            
        $this->getQuotation()->products=new DomoprimeQuotationProductCollection(null,$this->getSite());
        foreach ($form->getValue('products') as $value)
        {
           $item=new DomoprimeQuotationProduct(null,$this->getSite());
           $product=$form->getProducts()->getProductById($value['product_id']);
           $item->add(array('product_id'=>$value['product_id'],
                             'title'=>$product->get('meta_title'), 
                             'tva_id'=>$product->get('tva_id'), 
                             'quotation_id'=>$this->getQuotation(),
                             'meeting_id'=>$this->getQuotation()->get('meeting_id'),
                             'quantity'=>$value['quantity']));                        
           $this->getQuotation()->products[$value['product_id']]=$item; 
        }    
        $this->calculate();
        $mode=$this->getCalculation()->getClass()->get('id')==$this->getSettings()->getClassicClass()->get('id')?self::DISCOUNT_MODE:self::NORMAL_MODE; 
        //var_dump($mode,$this->getCalculation()->getClass()->get('id'));
        foreach ($form->getValue('products') as $value)
        {           
           $product=$form->getProducts()->getProductById($value['product_id']); 
           $this->getQuotation()->products[$value['product_id']]->set('purchase_price_without_tax',$product->getPurchasePriceWithoutTax());
           $this->getQuotation()->products[$value['product_id']]->set('purchase_price_with_tax',$product->getPurchasePriceWithTax());
           $this->getQuotation()->products[$value['product_id']]->set('total_purchase_price_without_tax',$product->getPurchasePriceWithoutTax() * $item->getQuantity());           
           $this->getQuotation()->products[$value['product_id']]->set('total_purchase_price_with_tax',$product->getPurchasePriceWithTax() * $item->getQuantity() );
           $this->getQuotation()->products[$value['product_id']]->set('sale_price_without_tax',$product->getSalePriceWithoutTax());
           $this->getQuotation()->products[$value['product_id']]->set('sale_price_with_tax',$product->getSalePriceWithTax());                  
           $this->getQuotation()->products[$value['product_id']]->set('total_sale_price_with_tax',$product->getSalePriceWithTax() * $item->getQuantity());           
           $this->getQuotation()->products[$value['product_id']]->set('total_sale_price_without_tax',$product->getSalePriceWithoutTax() * $item->getQuantity());                
           if ($mode==self::DISCOUNT_MODE)
           {                                           
            $this->getQuotation()->products[$value['product_id']]->set('sale_discount_price_without_tax',$product->getDiscountPriceWithoutTax());
            $this->getQuotation()->products[$value['product_id']]->set('sale_discount_price_with_tax',$product->getDiscountPriceWithTax());                     
            $this->getQuotation()->products[$value['product_id']]->set('total_sale_discount_price_with_tax',$product->getDiscountPriceWithTax() * $item->getQuantity());           
            $this->getQuotation()->products[$value['product_id']]->set('total_sale_discount_price_without_tax',$product->getDiscountPriceWithoutTax() * $item->getQuantity());                          
           }    
        }
        $this->getQuotation()->products->save();         
        
        $this->getQuotation()->items=new DomoprimeQuotationProductItemCollection(null,$this->getSite());
        foreach ($form->getValue('products') as $product)
        {            
            foreach ($product['items'] as $value)
            {                                               
                $work= $form->getProducts()->getProductById($product['product_id']);
                $item=new  DomoprimeQuotationProductItem(null,$this->getSite());
                $item->add(array('quotation_id'=>$this->getQuotation(),
                                 'quantity'=>$product['quantity'],
                                 'quotation_product_id'=>$this->getQuotation()->products[$product['product_id']],
                                 'title'=>$work->getProductItems()->getItemById($value)->get('reference'),  
                                 'tva_id'=>$work->getProductItems()->getItemById($value)->get('tva_id'), 
                                 'item_id'=>$work->getProductItems()->getItemById($value),        
                                 'is_master'=>'YES'
                            ));
               // echo "<pre>"; var_dump($item->getProductItem()); echo "</pre>"; 
                $item->set('purchase_price_without_tax',$item->getProductItem()->getPurchasePriceWithoutTax());
                $item->set('purchase_price_with_tax',$item->getProductItem()->getPurchasePriceWithTax());                
                $item->set('total_purchase_price_with_tax',$item->getProductItem()->getPurchasePriceWithTax() * $item->getQuantity() );
                $item->set('total_purchase_price_without_tax',$item->getProductItem()->getPurchasePriceWithoutTax() * $item->getQuantity());
                
                $item->set('sale_price_without_tax',$item->getProductItem()->getSalePriceWithoutTax());
                $item->set('sale_price_with_tax',$item->getProductItem()->getSalePriceWithTax());             
                $item->set('total_sale_price_with_tax',$item->getProductItem()->getSalePriceWithTax() * $item->getQuantity());              
                $item->set('total_sale_price_without_tax',$item->getProductItem()->getSalePriceWithoutTax() * $item->getQuantity()); 
                if ($mode==self::DISCOUNT_MODE)                
                {
                     $item->set('sale_discount_price_without_tax',$item->getProductItem()->getDiscountPriceWithoutTax());
                     $item->set('sale_discount_price_with_tax',$item->getProductItem()->getDiscountPriceWithTax());             

                     $item->set('total_sale_discount_price_with_tax',$item->getProductItem()->getDiscountPriceWithTax() * $item->getQuantity());              
                     $item->set('total_sale_discount_price_without_tax',$item->getProductItem()->getDiscountPriceWithoutTax() * $item->getQuantity()); 
                }                                  
                $this->getQuotation()->items[]=$item;
            }    
        }    
        $this->getQuotation()->items->save();                       
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
        $this->getQuotation()->set('engine','Engine2');
        $this->getQuotation()->save();       
        $this->process();
        return $this;
     }
     
      
     
     function getFeeFile()
     {
         return $this->getSettings()->get('fee_file');
     }
     
     
           
}
