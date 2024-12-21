<?php


class CustomerContractReferenceForSelectFormFilter extends mfFormFilterBase {
    protected $where=null,$limit=10;
            
    function __construct($limit)
    {
       $this->limit=$limit;     
       parent::__construct();      
    }
        
    function getLimit(){
        return $this->limit!=null?$this->limit:10;
    }
            
    function configure()
    {
        $this->setDefaults(array(           
            'search'=>array(
                         
            ),
            'order'=>array(
                  'reference'=>'asc'       
            ),
            'nbitemsbypage'=>"10",
       ));
      $this->setClass('CustomerContract');
       // Base Query
       $this->setQuery("SELECT ". CustomerContract::getTableFields(array('id','reference'))." FROM ".CustomerContract::getTable().
                        " WHERE ".CustomerContract::getTableField('reference')." !='' ".
                            //$this->getWhere().
                        " GROUP BY reference".
                        //" ORDER BY reference ASC ".                          
                        ";");
       // Validators 
       $this->setValidators(array(     
                 'order' => new mfValidatorSchema(array(
                                                        "reference"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                    
                                                       ),array("required"=>false)),           
            'search' => new mfValidatorSchema(array(   
                             //"reference"=>new mfValidatorString(array("required"=>false)),   
                            // "query"=>new mfValidatorString(array("required"=>false)),
                           ),array("required"=>false)),
           'equal' => new mfValidatorSchema(array(                               
                             // "site_admin_available"=>new mfValidatorChoice(array("choices"=>array(""=>__(""),"YES"=>__("Yes"),"NO"=>__("No")),"required"=>false)),
                             // "site_frontend_available"=>new mfValidatorChoice(array("choices"=>array(""=>__(""),"YES"=>__("Yes"),"NO"=>__("No")),"required"=>false)),
                             // "site_available"=>new mfValidatorChoice(array("choices"=>array(""=>__(""),"YES"=>__("Yes"),"NO"=>__("No")),"required"=>false)),
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("10"=> $this->getLimit(),"20"=>20))),         
        ));
    }
    
 
}

