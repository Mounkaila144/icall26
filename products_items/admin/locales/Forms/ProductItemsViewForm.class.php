<?php
require_once dirname(__FILE__)."/ProductItemsForm.class.php";

class ProductItemsViewForm extends ProductItemsForm {
      
    protected $product=null,$user=null,$master=null,$is_processed=null;
    static protected $units=null,$taxes=null;
    
    function __construct(ProductItem $master,$user,$defaults = array()) {
       $this->user=$user;
       $this->master=$master;
       parent::__construct($defaults,$user);
    }
    
    function getUser()
    {
       return $this->user;
    }
   
    function getMaster() 
    {
       return $this->master;
    }
    
    function getProduct() 
    {
       return $this->getMaster()->getProduct();
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
            if ($this->getSlaves()->hasItemByKey($data['id']) || !$data['id'])
                continue ;
            $ids[]=$data['id'];
        }        
        $items = ProductItemUtils::getItemsBySelection($ids);        
        foreach ($this['items']->getValue() as $index=>$data)
        {               
            if ($this->getSlaves()->hasItemByKey($data['id'])){
                //echo "[*]";
                $this->getSlaves()->getItemByKey($data['id'])->add($data);
            }
            else
            {
                if ($data['id'])
                {
                    //echo "[-] ".$data['id'];
                    $item = $items->getItemByKey($data['id']);
                    $item->add($data);
                    $item->set('product_id',$this->getProduct());
                    $this->getSlaves()->push($item) ; 
                }   
                else
                {    
                    $item=new ProductItem();
                    $item->set('product_id',$this->getMaster()->getProduct());
                    $item->add($data)->setSite($this->getMaster()->getSite());
                    $this->getSlaves()->push($item);
                }
            }
        } 
                     
        if (parent::isValid())
        {
            if ($this->is_processed)
                return true;
            $this->is_processed=true;
            // save master
            $this->getMaster()->add($this->getValues())->save();
            
            $items_value = new mfArray();
            foreach($this['items']->getValue() as $data)
                $items_value[]=$data['id'];            
            $keys=$items_value->flip();
                                    
            foreach($this->getSlaves()  as $key=>$slave){
                if(!isset($keys[$slave->get('id')]) && $slave->isLoaded())                  
                    $this->getSlaves()->findAndRemove($key);            
            }         
            return true;
        }
        return false;
    }
            
    function configure()
    {               
        parent::configure();           
        unset($this['id']);
        $fields=array();
        for ($i = 0; $i < ($this->getDefault('items')?count($this->getDefault('items')):($this->getSlaves()->count()?$this->getSlaves()->count():1)); $i++)
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
        }          
        $this->validatorSchema['items'] = new mfValidatorSchema($fields);  
    }
    
    function getCount()
    {
        return $this->_count=$this->_count===null?$this->getDefault('items')?count($this->getDefault('items')):$this->getSlaves()->count():$this->_count;
    }
    
    function getSlaves()
    {
        return $this->_items=$this->_items===null? $this->getMaster()->getSlaves()->getAll()->getMasters()->bySlave():$this->_items;
    }
    
    static function getUnits()
    {
        return self::$units=self::$units===null?ProductItemUnit::getUnitsForSelect():self::$units;
    }
    
    static function getTaxes()
    {
        return self::$taxes=self::$taxes===null?TaxUtils::getTaxesForSelect():self::$taxes;
    }
}