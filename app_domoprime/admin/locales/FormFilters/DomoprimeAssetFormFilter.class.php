<?php


class DomoprimeAssetFormFilter extends mfFormFilterBase {

     
    
    function configure()
    {                          
       $this->setDefaults(array(
           
            'order'=>array(
                            "created_at"=>"desc",                        
            ),            
            'nbitemsbypage'=>"100",
       ));          
       $this->setClass('DomoprimeAsset');
       $this->setFields(array());
       $this->setQuery("SELECT {fields} FROM ".DomoprimeAsset::getTable().                        
                       " INNER JOIN ".DomoprimeAsset::getOuterForJoin('customer_id').  
                       " INNER JOIN ".DomoprimeAsset::getOuterForJoin('creator_id').  
                       ";"); 
       // Validators 
       $this->setValidators(array( 
                  
            'order' => new mfValidatorSchema(array(
                                                        "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                      //  "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                                                       "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
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
                           // "lang"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getLanguagesSort($this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "meta_title"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('meta_title',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "reference"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getProductI18nFieldValuesForSelect('reference',$this->getSite()),"key"=>true,"required"=>false)),                            
                          //  "customer_id"=>new mfValidatorChoice(array("choices"=>array(""=>"")+ProductFavoriteUtils::getCustomerFieldValuesForSelect($this->getSite()),"key"=>true,"required"=>false)),
                            ),array("required"=>false)),                                        
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","*"=>"*"),"key"=>true)),                    
        ));              
    }
    
    function _extractParameterForUrl($name) 
    {
      /*  if ($name=='range')
        {
            $values=$this['range']->getValue();                        
            if (isset($values['date']))
            {
                foreach ($values['date'] as $name=>$value)          
                {                           
                   $values['date'][$name]=$value?format_date(date("Y-m-d",strtotime($value)),"a"):null;  // Remove time
                }                          
            }                            
            return $values;
        }    */
        return parent::_extractParameterForUrl($name);
    }
    
    
}

