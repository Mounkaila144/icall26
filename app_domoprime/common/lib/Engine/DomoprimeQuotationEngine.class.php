<?php


 class DomoprimeQuotationEngine extends DomoprimeQuotationEngineCore {
     
     
    
    function calculate()
    {        
        $this->has_prime_one_euro=false;
        if ($this->getQuotation()->hasContract())
        {    
           $this->request=new DomoprimeCustomerRequest($this->getQuotation()->getContract());              
           // detect changement surfaces            
           if ($this->request->getSurfacesChanged($this->getQuotation()->getProductsSurfaces())->isEmpty())
           {               
               $this->calculation=new DomoprimeCalculation($this->getQuotation()->getContract());
           }    
           else
           {              
               $this->request->setSurfacesChanges($this->getQuotation()->getProductsSurfaces());
               $this->request->save();
               // Message warning 
                $engine=new DomoprimeIsoEngine($this->getQuotation()->getContract());
                $engine->process();  
                $this->calculation=new DomoprimeCalculation($engine);
                $this->calculation->process($this->getUser());  
           }              
        }   
        elseif ($this->getQuotation()->hasMeeting())
        {    
           $this->request=new DomoprimeCustomerRequest($this->getQuotation()->getMeeting());    
           if ($this->request->getSurfacesChanged($this->getQuotation()->getProductsSurfaces())->isEmpty())
           {
               $this->calculation=new DomoprimeCalculation($this->getQuotation()->getMeeting());
           }    
           else
           {
               $this->request->setSurfacesChanges($this->getQuotation()->getProductsSurfaces());
               $this->request->save();
               // Message warning 
                $engine=new DomoprimeIsoEngine($this->getQuotation()->getMeeting());
                $engine->process();  
                $this->calculation=new DomoprimeCalculation($engine);
                $this->calculation->process($this->getUser());  
           } 
        }
        if ($this->request->isNotLoaded())
            throw new DomoprimeQuotationEngineException(DomoprimeQuotationEngineException::ENGINE_ERROR_REQUEST_INVALID);
        if ($this->calculation->isNotLoaded())
            throw new DomoprimeQuotationEngineException(DomoprimeQuotationEngineException::ENGINE_ERROR_CALCULATION_INVALID);
    }
        
    function update(mfForm $form,User $user)
    {       
        $this->getQuotation()->add($form->getValues());            
        $this->getQuotation()->products=new DomoprimeQuotationProductCollection(null,$this->getSite());
        foreach ($form->getValue('products') as $value)
        {
           $item=new DomoprimeQuotationProduct(null,$this->getSite());
           $product=$form->getProducts()->getProductById($value['product_id']);
           $item->add(array('product_id'=>$value['product_id'],
                             'title'=>$product->get('meta_title'),                           
                             'quotation_id'=>$this->getQuotation(),
                             'meeting_id'=>$this->getQuotation()->get('meeting_id'),
                             'quantity'=>$value['quantity']));                
           $item->set('purchase_price_without_tax',$product->getPurchasePriceWithoutTax());
           $item->set('purchase_price_with_tax',$product->getPurchasePriceWithTax());
           $item->set('sale_price_without_tax',$product->getSalePriceWithoutTax());
           $item->set('sale_price_with_tax',$product->getSalePriceWithTax());
           $item->set('total_purchase_price_with_tax',$product->getPurchasePriceWithTax() * $item->getQuantity() );
           $item->set('total_sale_price_with_tax',$product->getSalePriceWithTax() * $item->getQuantity());
           $item->set('total_purchase_price_without_tax',$product->getPurchasePriceWithoutTax() * $item->getQuantity());
           $item->set('total_sale_price_without_tax',$product->getSalePriceWithoutTax() * $item->getQuantity());         
           $this->getQuotation()->products[$value['product_id']]=$item; 
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
                                 'tax_id'=>$work->getProductItems()->getItemById($value)->get('tax_id'), 
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
                $this->getQuotation()->items[]=$item;
            }    
        }    
        $this->getQuotation()->items->save();
                
        // Sumarize by items
        $this->getQuotation()->set('total_sale_without_tax',$this->getQuotation()->items->getTotalSaleWithoutTax());
        $this->getQuotation()->set('total_sale_with_tax',$this->getQuotation()->items->getTotalSaleWithTax());
        $this->getQuotation()->set('total_purchase_without_tax',$this->getQuotation()->items->getTotalPurchaseWithoutTax());
        $this->getQuotation()->set('total_purchase_with_tax',$this->getQuotation()->items->getTotalPurchaseWithTax());
        $this->getQuotation()->set('prime',$this->getQuotation()->getTotalSaleWithTax() - $this->getSettings()->getRestInCharge());
        $this->getQuotation()->set('creator_id',$user);
        $this->getQuotation()->set('engine','Engine');
        $this->getQuotation()->save(); 
        $this->calculate();
        $this->process();
        return $this;
    }
        
    function create(mfForm $form,User $user)
    {
           $this->getQuotation()->set('reference',$this->getQuotation()->getFormattedReference());
           $this->update($form, $user);
           return $this;
    }            
    
    function process()
    {                                  
        $this->number_of_people=$this->getCalculation()->get('number_of_people'); 
        $this->number_of_children=$this->request->get('number_of_children');
        $this->tax_credit_used=$this->request->get('tax_credit_used');
        $this->rest_in_charge= $this->getQuotation()->get('total_sale_with_tax') - $this->getCalculation()->get('qmac_value'); 
        if ($this->rest_in_charge > 0)
        {             
           $this->has_prime_one_euro=false;
           $this->rest_in_charge_after_credit=0.0;
           $this->prime=$this->getCalculation()->get('qmac_value') - $this->getQuotation()->get('fixed_prime',0.0);
           $settings= ServiceImpotSettings::load();
           $limit=0.0;
           if ($this->getNumberOfPeople() == 1)
               $limit= $settings->get('limit_one_person');
           elseif ($this->getNumberOfPeople() == 2)
               $limit= $settings->get('limit_two_person');   
          else
               $limit=$settings->get('limit_one_person') * 2; //$this->getNumberOfPeople();
           $limit+=  $this->getNumberOfChildren() * $settings->get('limit_added_person');             
           $this->tax_credit_limit=$limit ;           
           $this->tax_credit_available = $this->tax_credit_limit * $settings->get('rate')  - $this->tax_credit_used;  
           $limit=$this->tax_credit_limit * $settings->get('rate')  - $this->tax_credit_used;           
           $this->rest_in_charge=$this->getQuotation()->get('fixed_prime',0.0) + $this->getQuotation()->get('total_sale_with_tax') - $this->getCalculation()->get('qmac_value'); 
           $tax_work= $settings->get('rate') * $this->rest_in_charge ;           
           $this->tax_credit= $tax_work > $limit ? $limit:$tax_work;                      
           $this->rest_in_charge_after_credit= $this->rest_in_charge + $this->tax_credit;                      
       }
        else
        {   // 1 euro            
            $this->rest_in_charge=$this->getQuotation()->get('fixed_prime')!=0 ? $this->getQuotation()->get('fixed_prime',0.0) : $this->getSettings()->getRestInCharge();    
            $this->prime= $this->getQuotation()->get('total_sale_with_tax') - $this->getQuotation()->get('fixed_prime',0.0) - $this->getSettings()->getRestInCharge();
            $this->has_prime_one_euro=true;
            $this->rest_in_charge_after_credit=0.0;
        }       
        $this->getQuotation()->set('qmac_value',$this->getCalculation()->get('qmac_value'));
        $this->getQuotation()->set('prime',$this->getPrime());
        $this->getQuotation()->set('one_euro',$this->hasPrimeOneEuro()?"YES":"NO");
        $this->getQuotation()->set('tax_credit_used',$this->getTaxCreditUsed());
        $this->getQuotation()->set('tax_credit',$this->getTaxCredit());
        $this->getQuotation()->set('number_of_people',$this->getNumberOfPeople());
        $this->getQuotation()->set('number_of_children',$this->getNumberOfChildren());
        $this->getQuotation()->set('rest_in_charge',$this->getRestInCharge());
        $this->getQuotation()->set('rest_in_charge_after_credit',$this->getRestInChargeAfterCredit());
        $this->getQuotation()->set('tax_credit_limit',$this->getTaxCreditLimit());                
        return $this;
    }
               

}
