<?php

class CustomerCommentSettings extends mfSettingsBase {

      protected static $instance=null;
      protected $default_attribution=null;

      function __construct($data=null,$site=null)
      {
          parent::__construct($data,null,'frontend',$site);
      }

      function getDefaults()
      {
          $this->add(array("dictionary"=>null,
                           "replacement"=>"########"
                         ));

      }


      function getWords()
      {
          if ($this->get('dictionary'))
             return $this->get('dictionary');
          return new mfArray();
      }


     function escapeText($text)
    {
          if ($this->getWords()->isEmpty())
              return $text;
         return str_replace($this->getWords()->toArray(),$this->get('replacement'), $text);
    }
}
