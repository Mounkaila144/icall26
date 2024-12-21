<?php

class UserBaseForm extends mfFormSite {

    protected $user=null;
    
    function __construct($user,$defaults = array(), $site = null) {                       
        $this->user=$user;
        parent::__construct($defaults, array(), $site);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function getLanguage()
    {
        return $this->getUser()->getLanguage();
    }
    
    function configure() {       
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(),
            'sex'=>new mfValidatorChoice(array("choices"=>array("Mrs"=>"Mrs","Mr"=>"Mr","Ms"=>"Ms"),"key"=>true)),
            'firstname' => new mfValidatorName(array('trim'=>true)), // @TODO define min max + messages
            'lastname' => new mfValidatorName(array('trim'=>true)), // @TODO define min max + messages
            'email' => new mfValidatorEmail(array('required'=>false)), 
            'mobile'=>new mfValidatorI18nMobile(array('required'=>false)),            
            'team_id'=>new mfValidatorChoice(array('key'=>true,'choices'=>UserTeamUtils::getFieldValues2ForSelect('name',$this->getSite())->unshift(array(0=>__("No team"))))),
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
    
    function getMapping($fields=array())
    {
        if ($this->mapping===null)
        {
            $this->mapping=new mfArray();
            if (!$fields)            
                $fields = $this->getFields();            
            foreach ($fields as $field)
            {
               if (method_exists($this->$field, 'getMapping'))
                 $this->mapping[$field]=array('options'=>$this->$field->getMapping(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
               else
                 $this->mapping[$field]=array('options'=>$this->$field->getOptions(),'name'=>$field,'validator'=>str_replace('mfValidator','',get_class($this->$field)));
            }          
        }
        return $this->mapping;
    }
}