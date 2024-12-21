<?php

class multipleLanguageNewForm extends mfForm {
    
    function configure() { 
      $this->embedFormForEach('languages',new languageNewForm(),count($this->getDefault('languages'))); 
      $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'checkLanguages'))));
    }
    
    function checkLanguages($validator,$values)
    {
        $choices=languageUtilsAdmin::getLanguagesAllowed();
        $badCodes=array();
        foreach ($values['languages'] as $count=>$language)
        {
           if (isset($language['code'])&&!in_array($language['code'],$choices))
               $badCodes[]=$language['code'];
        } 
        if ($badCodes)
          throw new mfValidatorErrorSchema($validator,array("languages"=>new mfValidatorError($validator,__('languages [{value}] doesn\'t exist.'),array('value'=>implode(",",$badCodes)))));  // Dummy Exception with no error
        return $values;
    }        
}