<?php


class MarketingLeadsWpFormsBySiteFormFilter extends mfFormFilterBase {

    protected $language=null;
    
    function __construct($language)
    {
        $this->language=$language;     
        parent::__construct();      
    }
    
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {   
        $this->setDefaults(array(     
            'order'=>array(
                "ID"=>"asc",                        
            ),            
            'nbitemsbypage'=>"250",
        ));          
        $this->setClass('MarketingLeadsWpFormsBySite');
        //nom_prenom 	email 	tel 	postcode 	energy 	revenu 	nb_fiscal 	situation
        $this->setQuery("SELECT * FROM ".MarketingLeadsWpFormsBySite::getTable().  
//                        " WHERE  post_type='flamingo_inbound'".
                        ";"); 
        // Validators 
        $this->setValidators(array( 
            //'ID','post_date','post_content'
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)), 
                            "referrer"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                            
                            "utm_source"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),  
                            "utm_medium"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),  
                            "utm_campaign"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),                                                       
                        ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(   
//                            "id"=>new mfValidatorString(array("required"=>false)),                            
                            "nom_prenom"=>new mfValidatorString(array("required"=>false)),              
                            "email"=>new mfValidatorString(array("required"=>false)),              
                            "tel"=>new mfValidatorString(array("required"=>false)),              
                            "postcode"=>new mfValidatorString(array("required"=>false)),              
                            "nb_fiscal"=>new mfValidatorInteger(array("required"=>false)),              
                            "referrer"=>new mfValidatorString(array("required"=>false)),                              
                            "utm_source"=>new mfValidatorString(array("required"=>false)),                            
                            "utm_medium"=>new mfValidatorString(array("required"=>false)),                            
                            "utm_campaign"=>new mfValidatorString(array("required"=>false)),                
                        ),array("required"=>false)),                             
            'range' => new mfValidatorSchema(array(   
                            //"post_content"=>new mfValidatorI18nDateRangeCompare(array("required"=>false)),                            
                        ),array("required"=>false)),                                                         
            'equal' => new mfValidatorSchema(array(   
//                            "energy"=>new mfValidatorChoice(array("choices"=>array(""=>"","electricité"=>__("electricité"),"combustible"=>__("combustible")),"key"=>true,"required"=>false)),
//                            "situation"=>new mfValidatorChoice(array("choices"=>array(""=>"","locataire"=>__("electricity"),"combustible"=>__("combustible")),"key"=>true,"required"=>false)),
                        ),array("required"=>false)),                 
            'nbitemsbypage'=>new mfValidatorChoice(array("required"=>false,"choices"=>array("5"=>"5","10"=>"10","20"=>"20","50"=>"50","100"=>"100","250"=>"250"),"key"=>true)),                    
        ));              
    }
}

