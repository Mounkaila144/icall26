<?php

class mfValidatorLogFiles extends mfValidatorSchemaForEach {
    
  public function __construct($count, $options = array(), $messages = array())
  {
    parent::__construct(new mfValidatorLogFile(array(),array(
                                         'file'=> __("file [{value}] doesn't exist"),
                                         'invalid'=> __("the file [{value}] is invalid")
                                         )), $count, $options, $messages);
  }

}