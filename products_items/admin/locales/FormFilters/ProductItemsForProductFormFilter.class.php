<?php


class ProductItemsForProductFormFilter extends mfFormFilterBase {

   
    
    function configure()
    {                    
       $this->objects='Product';
       $this->setDefaults(array(            
            'order'=>array(
                            "id"=>"asc",                        
            ),            
            'equal'=>array(
                    "is_active"=>"YES"
            ),
            'nbitemsbypage'=>"*",
       ));          
       $this->setClass('ProductItem');
       $this->setFields(array());
       $this->setQuery(
                       "SELECT {fields} FROM ".ProductItem::getTable().                            
                       " LEFT JOIN ".ProductItem::getOuterForJoin('tva_id').
                       " LEFT JOIN ". ProductItemsItem::getTable()." AS master ON ".ProductItem::getTableField('id')."=master.item_master_id".
                       " LEFT JOIN ". ProductItemsItem::getTable()." AS slave ON ".ProductItem::getTableField('id')."=slave.item_slave_id".
                       " WHERE ".ProductItem::getTableField('product_id')."='{product_id}'".  
                       " AND ".ProductItemsItem::getTableField('id','master')." IS NULL".  
                       " AND ".ProductItemsItem::getTableField('id','slave')." IS NULL".  
                       ";"
                ); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                      //  "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                      //  "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                            "id"=>new mfValidatorString(array("required"=>false)),                            
                          //  "link"=>new mfValidatorString(array("required"=>false)),                            
                          //  "title"=>new mfValidatorString(array("required"=>false)),                            
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>__("YES"),"NO"=>__("NO")),"key"=>true,"required"=>false)),          
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
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
    
    function execute(){
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array())    
            ->setObjects(array('slave'=>'ProductItemsItem',
                               'master'=>'ProductItemsItem'
           ))             
            ->setAlias(array('slave'=>'slave','master'=>'master'))
            ->setQuery($this->getQuery())
            ->makeSiteSqlQuery($this->getSite()); 
    }
    
}

