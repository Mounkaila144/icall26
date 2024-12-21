<?php

class MutualProductCommissionCollectionForEngine extends MutualProductCommissionCollection {
    
    protected $commission_total=0.0;

    public function process($duration, CustomerMeetingMutualProductForEngine $product)
    {
        //calculation
        foreach ($this->collection as $commission)
        {
            $this->commission_total += ($commission->get('rate')*$product->get('sale_price_with_tax'));
        }
        
        return $this->commission_total;
    }
}
