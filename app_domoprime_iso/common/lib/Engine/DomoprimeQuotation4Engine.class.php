<?php


 class DomoprimeQuotation4Engine extends DomoprimeQuotation3Engine {
     
     function getEngineNumber()
     {
        return "Engine4";
     }
     
     function processPreQuotation()
     {
         // Calcul 101,102,103   
        foreach ($this->getSettings()->getProductsByTypes() as $id=>$field) 
        {
            if (!isset($this->getQuotation()->products[$id]))
                continue;
            
            if ($this->getMode()==self::DISCOUNT_MODE)
            {                                           
                $this->getQuotation()->set('total_sale_'.$field.'_with_tax',$this->getQuotation()->products[$id]->get('total_sale_discount_price_with_tax'));                    
                $this->getQuotation()->set('total_sale_'.$field.'_without_tax',$this->getQuotation()->products[$id]->get('total_sale_discount_price_without_tax'));                                    
            } 
            else
            {                    
                $this->getQuotation()->set('total_sale_'.$field.'_with_tax',$this->getQuotation()->products[$id]->get('total_sale_standard_price_with_tax'));                    
                $this->getQuotation()->set('total_sale_'.$field.'_without_tax',$this->getQuotation()->products[$id]->get('total_sale_standard_price_without_tax'));                                                 
            }    
        }                                    
         return $this;
     }
}
