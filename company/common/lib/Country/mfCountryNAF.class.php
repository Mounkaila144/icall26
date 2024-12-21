<?php

class mfCountryNAF {
    
protected $data=array();

  function __construct($culture=null)
  {
        $this->loadCountryNAF($culture);
  }
    
  public static function getInstance($country = 'fr')
  {
    static $instances = array();    
    $country=strtolower($country);
    if (!isset($instances[$country]))
    {
      $instances[$country] = new mfCountryNAF($country);
    }
    return $instances[$country];
  }
  
  function loadCountryNAF($country=null)
    {
        if ($country==null) 
            return ; 
       $filename=dirname(__FILE__)."/data/NAF/".$country.".php";
       if (is_readable($filename)) 
         $this->data=  include_once $filename;
       else
          throw new mfException(sprintf('Culture bank data file for "%s" was not found.', $country));
       $this->country=$country;       
    }
  
  function isCodeExist($code)
  {
      return (array_search($code,$this->data)!==false);
  }  
  
  function getCodes()
  {
      return $this->data;
  }
  
  function getCountrySupported()
  {
      $countries=array();
      foreach (glob(dirname(__FILE__)."/data/NAF/*.php") as $file)
          $countries[]=basename($file,".php");
      return $countries;
  }
    
}