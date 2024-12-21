<?php


class ProductItemFormFilter extends mfFormFilterBase {

       
    function configure()
    {                    
       $this->objects='Product';
       $this->setDefaults(array(            
            'order'=>array(
                            "meta_title"=>"asc",                        
            ),            
            'equal'=>array(
                    "is_active"=>"YES"
            ),
            'nbitemsbypage'=>"*",
       ));          
       $this->setClass('ProductItem');
       $this->setFields(array(
            'product'=>array(
                         'class'=>'Product',
                         'search'=>array('conditions'=>
                              "(".
                              Product::getTableField('meta_title')." COLLATE UTF8_GENERAL_CI LIKE '%%{product}%%' OR ".
                              Product::getTableField('reference')." COLLATE UTF8_GENERAL_CI LIKE '%%{product}%%'".
                              ")")
             ),
             'item_master_id'=>'ProductItemsItem'
           ));
       $this->setQuery("SELECT {fields} FROM ".ProductItem::getTable(). 
                       " INNER JOIN ".ProductItem::getOuterForJoin('product_id').
                       " LEFT JOIN ".ProductItem::getOuterForJoin('tva_id'). 
                       " LEFT JOIN ".ProductItemsItem::getInnerForJoin('item_master_id'). 
                       " GROUP BY ".ProductItem::getTableField('id'). 
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                         //"meta_title"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                      //  "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                             "id"=>new mfValidatorString(array("required"=>false)),                            
                              "product"=>new mfValidatorString(array("required"=>false)),                            
                             // "title"=>new mfValidatorString(array("required"=>false)),
                              "mark"=>new mfValidatorString(array("required"=>false)),
                              "description"=>new mfValidatorString(array("required"=>false)),
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),          
                             "item_master_id"=>new mfValidatorChoice(array("choices"=>array(""=>"","IS_NULL"=>__("No master"),'IS_NOT_NULL'=>__('Master')),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
    function getObjectsForPager()
    {
        return $this->objects;
    }
    
    function hasObject($name)
    {             
        return in_array($name,$this->objects);
    }
    
     function getMapping($fields=array())
    {
        if ($this->mapping===null)
        {
            $this->mapping=new mfArray();
            if (!$fields)            
                $fields = $this->getFields();            
            foreach ($fields as $field)
            {
               if (method_exists($this->$field, 'getMapping'))
                 $this->mapping[$field]=array('options'=>$this->$field->getMapping(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
               else
                 $this->mapping[$field]=array('options'=>$this->$field->getOptions(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
            }          
        }
        return $this->mapping;
    }
    
    
}

