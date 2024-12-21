<?php


class TeamUsersForm extends mfFormSite {
                
      function __construct($defaults = array(), $site = null) {
          parent::__construct($defaults, array(), $site);
      }  
      
      function configure()
      {
          $this->setValidators(array(
              'id'=>new mfValidatorInteger(),
              'users'=>new mfValidatorChoice(array("key"=>true,'required'=>false,"choices"=>UserUtils::getUsers($this->getSite()),"multiple"=>true))
              ));
          $this->validatorSchema->addMessage("field_missing",__("At least one user has to be selected."));
          $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkUsers'))));
      }
      
    function checkUsers($validator,$values)
    {
        if ($this->hasErrors())
            return $values;
        $values['users']=UserUtils::checkUsers($values['users'],$this->getSite());
        return $values;
    }
}

