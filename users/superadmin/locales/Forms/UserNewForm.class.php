<?php
/* */
class UserNewForm extends UserBaseForm {
    
    
     function configure() {     
        parent::configure();            
        $this->setValidator('password',new mfValidatorString(array('required'=>false)));
        $this->setValidator('repassword',new mfValidatorString(array('required'=>false)));
        $this->setValidator('functions',new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>UserFunctionBaseUtils::getFieldValuesForI18nSelect('value',null,$this->getSite()))));
        $this->setValidator('groups',new mfValidatorChoice(array('key'=>true,'required'=>false,'multiple'=>true,'choices'=>GroupUtils::getGroups('admin',$this->getSite()))));
        unset($this['id'],$this['picture']);
        $this->validatorSchema->setPostValidator(new mfValidatorSchemaCompare('password', mfValidatorSchemaCompare::EQUAL, 'repassword',array(),array("invalid"=>__("password and repassword must be equal."))));
        if ($this->getDefault('password'))
            $this->repassword->setOption('required',true);
    }
    
    function getValues()
    {        
        $this->values['is_active']='YES';
        return parent::getValues();
    }
}