<?php


class CreateSiteForm extends mfForm {
    
     
    function configure() {                          
        $this->setValidators(array(
            'host'=>new mfValidatorDOmain(),
            'db_name'=>new mfValidatorString() ,
          //  'db_login'=>new mfValidatorString() ,
          //  'db_password'=>new mfValidatorString() ,
          //  'db_host'=>new mfValidatorString() ,
            'admin_theme'=>new mfValidatorString() ,
            'admin_theme_base'=>new mfValidatorString() ,
            'admin_available'=>new mfValidatorChoice(array('choices'=>array('YES','NO'))),
            'frontend_theme'=>new mfValidatorString() ,           
            'frontend_available'=>new mfValidatorChoice(array('choices'=>array('YES','NO'))),
            'available'=>new mfValidatorChoice(array('choices'=>array('YES','NO'))),
            'type'=>new mfValidatorString() ,
            'logo'=>new mfValidatorString(array('required'=>false)) ,
            'picture'=>new mfValidatorString(array('required'=>false)) ,
            'master'=>new mfValidatorString(array('required'=>false)) ,
            'access_restricted'=>new mfValidatorBoolean(array('true'=>1,'false'=>0,'empty_value'=>0)),
          //  'is_customer'=>new mfValidatorChoice(array('choices'=>array('YES','NO'))),
            'company' =>new mfValidatorString(array('required'=>false)) ,
          //  'is_uptodate'=>new mfValidatorChoice(array('choices'=>array('YES','NO'))),
            'banner'=>new mfValidatorString(array('required'=>false)) ,            
            'favicon'=>new mfValidatorString(array('required'=>false)) ,            
            'db_size'=>new mfValidatorInteger(array('min'=>0)) ,
            'size'=>new mfValidatorInteger(array('min'=>0)) ,
        ));
    }
    
    static function getToken()
    {
        return iCall26SiteServiceApi::getKey().session_id();   
    }
  
    public function getCSRFToken()
    {
        return self::getToken();
    }
    
    function getValues()
    {
        $values=array();
        foreach (parent::getValues() as $name=>$value)
            $values["site_".$name]=$value;
        $superadmin= new SiteSuperAdmin();
        foreach (array('site_db_password','site_db_login','site_db_host') as $field)
            $values[$field]=$superadmin->get($field);
        return $values;
    }
    
    function getHost()
    {
        return $this['host']->getValue();
    }
    
}
