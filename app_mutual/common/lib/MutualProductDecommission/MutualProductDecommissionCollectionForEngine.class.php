<?php

class MutualProductDecommissionCollectionForEngine extends MutualProductDecommissionCollection {
    
    protected $decommission_total=0.0;

    public function process($duration, CustomerMeetingMutualProductForEngine $product)
    {
        //calculation
        foreach ($this->collection as $decommission)
        {
            $this->decommission_total += ($decommission->get('rate')*$product->get('sale_price_with_tax'))+$decommission->get('fix');
        }
        
        return $this->decommission_total;
    }
}
