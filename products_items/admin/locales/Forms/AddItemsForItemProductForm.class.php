<?php

class AddItemsForItemProductForm extends mfForm {
    
    protected $item=null;
    
    function __construct(ProductItem $item,$defaults = array(), $options = array()) {
        $this->item=$item;
        parent::__construct($defaults, $options);
    }    
   
    function getItem(){
        return $this->item;
    }
   
    function configure() {
        if (!$this->getDefaults())
        {    
            $this->setDefaults(
                    array("items"=>$this->getItem()->getItems()->BySlaves()->toArray(),
                        'product_id'=> array(""=>"")+ProductUtils::getProductsForSelect($this->getItem()->getSite()),
                        'products'=> ProductItem::getItemsProductExcepted($this->getItem())
                    )
                    ); 
        }
        $this->setValidators(array(
            'items'=>new mfValidatorChoice(array('required'=>false,'key'=>true,'multiple'=>true,'choices'=>ProductItem::getItemsExcepted($this->getItem())))
        ));
        
    }
    function getProducts(){
        
        return $this->getDefault('products');
    }
    
    function getItems(){
        return $this['items']->getArray();
    }

}

