<?php


class ProductsFormFilter extends mfFormFilterBase {

    protected $site=null,$objects=array();
    
    function __construct($site=null)
    {
       $this->site=$site;      
       parent::__construct();      
    }
             
    function getSite()
    {
     return $this->site;
    }
    
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
       $this->setClass('Product');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".Product::getTable().     
                       " LEFT JOIN ".Product::getOuterForJoin('action_id').
                       " LEFT JOIN ".Product::getOuterForJoin('tva_id').
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                      //  "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                      //  "value"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                                                       ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
                          //  "id"=>new mfValidatorString(array("required"=>false)),                            
                          //  "link"=>new mfValidatorString(array("required"=>false)),                            
                          //  "title"=>new mfValidatorString(array("required"=>false)),                            
                            ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                          //  "created_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                           // "expired_at"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                            ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
                            "is_active"=>new mfValidatorChoice(array("choices"=>array(""=>"","YES"=>"active_YES","NO"=>"active_NO"),"key"=>true,"required"=>false)),          
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
    
    
}

