<?php

class CustomersCommentLogFormFilter extends mfFormFilterBase {
 
   

    function configure()
    {
      $this->setDefaults(array(
            'order'=>array(
                            "id"=>"desc",
            ),
            'search'=>array(
                         //   "is_active"=>"*",
            ),
            'nbitemsbypage'=>100,
       ));
       $this->setFields(array());       
       $this->setClass('CustomerCommentHistory');
       $this->setFields(array(
                              'status'=>'CustomerComment',
                              'lastname'=>array(
                                            'class'=>'Customer',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 Customer::getTableField('lastname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('firstname')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('company')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' OR ".
                                                 Customer::getTableField('phone')." COLLATE UTF8_GENERAL_CI LIKE '%%{lastname}%%' ".                                              
                                                 ")")
                              ),       
                               'comment'=>array(
                                            'class'=>'CustomerComment',
                                            'search'=>array('conditions'=>
                                                 "(".
                                                 CustomerComment::getTableField('comment')." COLLATE UTF8_GENERAL_CI LIKE '%%{comment}%%' ".                                              
                                                 ")")
                              ),  
                ));
       $this->setQuery("SELECT {fields} FROM ".CustomerCommentHistory::getTable().  
                       " INNER JOIN ".CustomerCommentHistory::getOuterForJoin('comment_id'). 
                       " INNER JOIN ".CustomerComment::getOuterForJoin('customer_id'). 
                       " INNER JOIN ".CustomerCommentHistory::getOuterForJoin('user_id').                      
                       ";"); 
       // Validators
       $this->setValidators(array(
            'order' => new mfValidatorSchema(array(
                            "id"=>new mfValidatorChoice(array("choices"=>array("asc","desc"),"required"=>false)),
                         
                           ),array("required"=>false)),
            'search' => new mfValidatorSchema(array(
                              "comment"=>new mfValidatorString(array("required"=>false)),                           
                                "lastname"=>new mfValidatorString(array("required"=>false)),  
                           ),array("required"=>false)),
           'nbitemsbypage'=>new mfValidatorChoice(array("choices"=>array("5"=>5,"10"=>10,"20"=>20,"25"=>25,"50"=>50,"100"=>100,"*"=>"*"))),         
        ));
    }
   
}

