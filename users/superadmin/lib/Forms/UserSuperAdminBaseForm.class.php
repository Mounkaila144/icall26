<?php

class UserSuperAdminBaseForm extends mfForm {

    protected $lang=null;
    
    function __construct($lang,$defaults = array()) {                
        $this->lang=$lang;
        parent::__construct($defaults, array());
    }
    
    function configure() {       
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'sex'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname' => new mfValidatorName(), // @TODO define min max + messages
            'lastname' => new mfValidatorName(), // @TODO define min max + messages
            'email' => new mfValidatorEmail(),            
            'username' => new mfValidatorName(), // @TODO define min max + messages
            'picture'=>new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>500000,
                                    'filename'=>"picture",
                                                 )
                                            )       
        ));
    }
}