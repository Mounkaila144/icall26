<?php
/*
 * 
 * http://www.tribulations.eu/articles/symfony-form-utilisation-avancee-des-validateurs.html
 * http://www.lafermeduweb.net/tutorial/validation-des-formulaires-symfony-p48.html
 * http://stackoverflow.com/questions/8829540/symfony-validation-handling
 */

class userAccountForm extends userForm {

    function configure() { 
        parent::configure();
        unset($this['id']);
       // $password=new mfValidatorString(array("required"=>false));
     //   $repassword=new mfValidatorString(array("required"=>false));
        $this->setValidator('password',new mfValidatorString(array("required"=>false)));
        $this->setValidator('repassword',new mfValidatorString(array("required"=>false)));
   /*     $this->setValidator('picture',new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1000000,
                                    //'path'=>mfConfig::get('mf_site_app_dir')."/data/users/pictures/"
                                                  )
                                            )); */
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
    }
}