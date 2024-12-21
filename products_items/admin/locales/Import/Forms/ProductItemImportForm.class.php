<?php

class ProductItemImportForm extends mfForm {
    
   /* protected $path=null;
    
    function __construct($path) {
        $this->path=$path;
        parent::__construct(array());
    }*/
    
  /*  function getPathSourceForFiles()
    {
       return $this->path."/products/items";
    }*/
    
    function configure()
    {
        $this->setOption('disabledCSRF',true);       
        $this->setValidators(array(
            'product'=>new mfValidatorString(array("max_length"=>255)),
            'description'=>new mfValidatorString(array("max_length"=>32768,"required"=>false)),
            'reference'=>new mfValidatorString(array("max_length"=>255)),
            'sale_price'=>new mfValidatorI18nNumber(array("required"=>false)),      
            'input1'=>new mfValidatorString(array("max_length"=>255,"required"=>false)),
            'input2'=>new mfValidatorString(array("max_length"=>255,"required"=>false)),
            'unit'=>new mfValidatorChoice(array("required"=>false,'key'=>true,'choices'=>array('hours'=>__('hours'),'square_meter'=>__('square_meter')))),      
            'content'=>new mfValidatorString(array("max_length"=>255,"required"=>false)),
            'details'=>new mfValidatorString(array("max_length"=>255,"required"=>false)),
            'coefficient'=>new mfValidatorI18nPourcentage(array("required"=>false)),      
            'thickness'=>new mfValidatorI18nNumber(array("required"=>false)),      
            'mark'=>new mfValidatorString(array("max_length"=>255,"required"=>false)),
            'input3'=>new mfValidatorString(array("max_length"=>255,"required"=>false)),
            'discount_price'=>new mfValidatorI18nNumber(array("required"=>false)),               
            "tva"=>new mfValidatorI18nPourcentage(array("required"=>false)),
            'is_default'=>new mfValidatorChoice(array("required"=>false,'choices'=>array(__('YES'),__('NO'),__('yes'),__('no')))),      
        ));  
        $this->validatorSchema->setOption('keep_fields_unused',true);
    }      
    
    function getProduct()
    {                          
        $item= new Product(array('reference'=>(string)$this['product']));
        return $item->loaded();
    }
    
    function getProductItem()
    {                                
        $item= new ProductItem(array('reference'=>(string)$this['reference']));   
        $item->add($this->getValues());
        $item->set('product_id',$this->getProduct());
        $item->set('is_default',(in_array($this['is_default']->getValue(),array(__('YES'),__('yes')))?'YES':'NO'));       
        return $item;
    }
    
     function getTax()
    {
        $item=new Tax(array('rate'=>(string)$this['tva']));
        if ($item->isNotLoaded())
        {    
            $item->set('description',(string)$this['tva'] * 100 ."%");
            $item->save();
        }    
        return $item;
    } 
    
    
}
