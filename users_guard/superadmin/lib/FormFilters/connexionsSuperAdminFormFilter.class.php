<?php

class ConnexionsSuperAdminFormFilter extends mfFormFilterBase {
 
    function configure()
    {
       $this->setDefaults(array(
            'order'=>array(
                            "last_time"=>"desc",
                       //     "application"=>"asc"
            ),
          
            'search'=>array(
                      //"ip"=>125
            ),
          
            'range'=>array("last_time"=>array("from"=>sessionUtils::getLastTimeMin(),"to"=>date("Y-m-d",time()+24*60*60))
                
            ),
         
        //    'equal'=>array("application"=>'admin'),
           
            'nbitemsbypage'=>"*"))
               ;
       // Base Query
       $this->setQuery("SELECT ip,start_time,last_time,username,firstname,lastname,email,last_password_gen,lastlogin FROM t_sessions LEFT JOIN t_users ON t_users.id=t_sessions.user_id WHERE application='superadmin' ORDER BY application ASC;");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "username"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "firstname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "lastname"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "ip"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "last_time"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                            "last_password_gen"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                       //     "application"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                             "username"=>new mfValidatorString(array("required"=>false)),                           
                             "lastname"=>new mfValidatorString(array("required"=>false)),                           
                             "firstname"=>new mfValidatorString(array("required"=>false)),                           
                             "ip"=>new mfValidatorString(array("required"=>false)),                           
                           //  "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend","superadmin"=>"superadmin"),"required"=>false)),
                           ),array("required"=>false)),
           
         /*   'equal'=> new mfValidatorSchema(array(
                             "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend","superadmin"=>"superadmin"),"required"=>false)),
                           ),array("required"=>false)),*/
           
      /*      'comparaison'=>new mfValidatorSchema(array(
                                "ip"=>new mfValidatorSchema(
                                          array(
                                              "op"=>new mfValidatorChoice(array("required"=>false,"choices"=>array(">",">=","=","<","<="))),
                                              "value"=>new mfValidatorInteger(array("required"=>false)),
                                          ),
                                        array("required"=>false)),  
                           ),array("required"=>false)),*/
           'range'=>new mfValidatorSchema(array(
                               "last_time"  =>new mfValidatorI18nDateRangeCompare(array('required'=>false))
                           ),array("required"=>false)),
           
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"500"=>500,"*"=>"*"))),         
        ));
    }
  
}

