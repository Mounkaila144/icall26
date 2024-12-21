<?php

// IE12230516 KO/ DE814864138 OK
// FR69481884088 //FR 85499277713
// FR71480470152
class mfValidatorTVA extends mfValidatorBase {
  
  const server="http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";
  
  public function __construct($options = array(), $messages = array())
  {
    parent::__construct($options, $messages);
   $this->addOption('number', 'tva');
   $this->addOption('country', null);
   $this->addOption('output', 'string');
   $this->addOption('throw_global_error', false);
   $this->setOption('empty_value','');
   $this->addMessage('invalid_syntax',$this->translateMessages('Your VAT Number syntax is not correct.'));
   $this->addMessage('invalid_country',$this->translateMessages('Your VAT Number is not valid for the selected country.'));      
}

public function doIsValid($values)
  {
    if (null === $values)
      $values = array();
    if (is_array($values))
    {    
       $vatnumber  = isset($values['number']) ? $values['number'] : null;    
       $country=isset($values['country']) ? $values['country'] : $this->getOption('country'); 
    }   
    else
    {    
       $vatnumber =$values; 
       $country=null;
    }   
    $valid = $this->haleValidateVAT($vatnumber,strtoupper($country));        
    //si le résultat n'est pas valide, on throw l'erreur correspondante
    if ($valid['result']===false)
    {
      throw new mfValidatorError($this, $valid['error'], array('value' => $vatnumber));
      if ($this->getOption('throw_global_error'))
          throw $error; // ????
      //l'erreur s'applique sur le champ vat_number
      throw new mfValidatorErrorSchema($this, array($this->getOption('vat_number') => $error));
    }
    //si valide, on retourne les valeurs
    if ($this->getOption('output')=='string')
        return $valid['result']->countryCode.$valid['result']->vatNumber;
    else
        return $valid['result']."TEXT";    
  }
 
  /**
   * vérifie la validité du numéro de TVA en prenant en compte le pays donné
   *
   * @param array $args
   * @return array
   */
  protected function haleValidateVAT($vatnumber,$country) {
    if ( '' != $vatnumber )
    {
      // on sérialize le numéro TVA
      $vat_number 	= str_replace(array(' ', '.', '-', ',', ', '), '', $vatnumber);
      // on récupère le code pays
      $countryCode 	= substr($vat_number, 0, 2);
      if ($country==null)
          $country= $countryCode;
      //on récupère le numéro TVA
      $vatNumber 	= substr($vat_number, 2);
      //on vérifie la syntaxe du numéro
      if (strlen($countryCode) != 2 || is_numeric(substr($countryCode, 0, 1)) || is_numeric(substr($countryCode, 1, 2)))
      {
        $error = array('result' => false, 'error'=>'invalid_syntax');
        return $error;
      }
 
      //on vérifie que le pays correspond bien au pays indiqué dans le numéro de TVA
      if ( $country != $countryCode )
      {
        $error = array('result' => false, 'error'=>'invalid_country');
        return $error;
      }
      //appelle le webservice
      try
      {
          $fp = fopen(self::server,"r"); // Test URL before  to avoid Fatal error
          fclose($fp);
          if (!$fp)
            return array('result' => false, 'error'=>'soap service out');  
          $client = new SoapClient(self::server);      
          $params = array('countryCode' => $countryCode, 'vatNumber' => $vatNumber);
          $result = $client->checkVat($params);
     //   var_dump($result);
      }
      catch (Exception $e)
      {
        $error = array('result' => false, 'error'=>'invalid');      
        return $error;
      }
      
      //vérifie la validité et renvoie l'erreur correspondante
      //var_dump($result);
      if ($result->valid)
        return array('result' => $result);
      else
        return  array('result' => false, 'error'=>'invalid');
    }
    return array('result' => false, 'error'=>'required');
  }
  

}

