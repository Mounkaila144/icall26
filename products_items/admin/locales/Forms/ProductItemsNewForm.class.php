<?php

require_once __DIR__."/ProductItemsForm.class.php";

class ProductItemsNewForm extends ProductItemsForm {
      
    protected $product=null,$user=null,$master=null,$is_processed=null;
    static protected $units=null,$taxes=null;
    
    function __construct(Product $product,$user,$defaults = array()) {
       $this->user=$user;
       $this->product=$product;
       $this->master=new ProductItem();
       parent::__construct($defaults,$user);
    }
    
    function getUser()
    {
       return $this->user;
    }
   
    function getProduct() 
    {
       return $this->product;
    }
    
    function getMaster()
    {
        return $this->master;
    }
    
    function getSettings()
    {
       return $this->settings= $this->settings===null?new ProductItemSettings():$this->settings;       
    }
        
    function isValid()
    {            
         $ids = new mfArray();
         foreach ($this['items']->getValue()  as $index=>$data)
         {            
            $ids[]=$data['id'];
         }
         $items = ProductItemUtils::getItemsBySelection($ids);        
         foreach ($this['items']->getValue() as $index=>$data)
        {    
                if ($data['id'])
                {
                    //echo "[-] ".$data['id'];
                     $this->getSlaves()->set($index,$items->getItemByKey($data['id']))                             
                               ->add($data)
                               ->set('product_id',$this->getProduct());                    
                }   
                else 
                 {    
                    //echo "[+]";
                    $this->getSlaves()->getItemByKey($index)
                            ->set('product_id', $this->getProduct())
                            ->add($data);               
                }          
        } 
                    
         
        if (parent::isValid())
        {
            if ($this->is_processed)
                return true;
            $this->is_processed=true;
            // save master
            $this->getMaster()->set('product_id', $this->getProduct())
                              ->add($this->getValues())
                              ->save();
//            
//
//            $items_value = new mfArray();
//            foreach($this['items']->getValue() as $item){
//                $items_value[$item['id']]=$item;
//            }
//            foreach($this->getSlaves()  as $key=>$slave){
//                if(!isset($items_value[$key])){
//                 //   echo '-- <br> ';echo $key;
//                    $this->getSlaves()->findAndRemove($key);
//                }
//            }           

            return true;
        }
        $this->getMaster()->add($this->getDefaults());
        return false;
    }
            
    function configure()
    {                       
        parent::configure();           
        unset($this['id']);
        $fields=array();
        for ($i = 0; $i < ($this->getDefault('items')?count($this->getDefault('items')):1); $i++)
        {                     
            $form=new ProductItemsForm($this->defaults['items'][$i],$this->getUser());        
            $form->id->setOption('required',false);
            $form->description->setOption('required',true);   
            foreach (array('discount_price','unit','coefficient','purchasing_price','input1','input2',
                      'input3','content','details','thickness','mark','multiple','input4','input5','input6','input7') as $field)
                {
                   if ($form->hasValidator($field))
                       $form->$field->setOption('required',false);
                }                                
             unset($form[self::$CSRFFieldName]); // Remove token            
            $fields[$i]=$form->getValidatorSchema();  
            $this->getSlaves()->push(new ProductItem());
        }          
        $this->validatorSchema['items'] = new mfValidatorSchema($fields);  
    }
    
    function getCount()
    {
        return $this->_count=$this->_count===null?$this->getDefault('items')?count($this->getDefault('items')):1:$this->_count;
    }
    
    function getSlaves()
    {
        return $this->_items=$this->_items===null? $this->getMaster()->getSlaves():$this->_items;
    }
    

    

}