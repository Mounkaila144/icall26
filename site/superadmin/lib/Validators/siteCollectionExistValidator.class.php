<?php

class siteCollectionExistValidator extends mfValidatorSchema {      
     
  public function __construct($options=array(),$count=0)
  {   
    $fields = array();
    for ($i = 0; $i < $count; $i++)
    {
      $fields[$i] = new mfValidatorInteger();
    }    
    parent::__construct($fields,$options);    
  }
  
  protected function configure($options = array(),$messages=array()) 
  {
     parent::configure($options, $messages) ;
     $this->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'loadCollection'))));
  }   
 
  function loadCollection($validator,$values)
  {       
     if (count($this->getErrorSchema()))
         return $values;     
     // here, values are integer   
     $db = mfSiteDatabase::getInstance();
     $db->setQuery("SELECT * FROM ".site::getTable()." WHERE site_id IN (".implode(",",$values).");")         
         ->makeSqlQuerySuperAdmin();       
     if ($db->getNumRows())
     {    
        $collection=new siteCollection();          
        while ($site=$db->fetchObject('site'))
        {
           $collection[]=$site;    
           unset($values[array_search($site->get('site_id'),$values)]);  // Remove known items       
        } 
      }
        // Find item not loaded : error for each unknown item 
    /*  foreach ($values as $name=>$value)
      {
         $this->errorSchema->addError(new mfValidatorError($this,__("item {value} is not valid."),array("value"=>$value)), (string) $name);                 
      }  */ //format_number_choice('[0]no result|[1]one result|(1,Inf]%s results',1,1)
      if ($values)
          throw new mfValidatorError($this,format_number_choice("[1]['{values}'] is not valid.|(1,Inf]['{values}'] are not valid.",array("values"=>implode("','",$values)),count($values)));     
      return $collection;   
  }
  
  protected function doIsValid($values) {               
      if ($this->getOption('required') && !$this->getFields())
      {    
          $this->errorSchema->addError(new mfValidatorError($this, 'required'));
          throw $this->errorSchema;
      }    
      return parent::doIsValid($values);
  }
  
   
  
}
