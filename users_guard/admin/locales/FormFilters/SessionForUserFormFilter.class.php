<?php

class SessionForUserFormFilter extends mfFormFilterBase {
 
    function configure()
    {
      $this->setDefaults(array(
            'order'=>array(
                            "id"=>"desc",
            ),
            'search'=>array(
                         
            ),
            'nbitemsbypage'=>100,
       ));
      $this->setClass('Session');
       // Base Query
       $this->setQuery("SELECT {fields} FROM ".Session::getTable().
                       " INNER JOIN ".Session::getOuterForJoin('user_id').
                       " WHERE ".User::getTableField('application')."='admin' AND ".
                             Session::getTableField('user_id')."='{user_id}'".
                       ";");
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                          //  "name"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                          //  "application"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                          //  "updated_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                          //  "created_at"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                        //    "id"=>new mfValidatorInteger(array("required"=>false)),
                        //    "name"=>new mfValidatorString(array("required"=>false)),  
                        //    "application"=>new mfValidatorChoice(array("choices"=>array(""=>"","admin"=>"admin","frontend"=>"frontend"),"required"=>false)),
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"50"=>50,"100"=>100,"250"=>250,"500"=>500,"*"=>"*"))),         
        ));
    }
  
}

