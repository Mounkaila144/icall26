<?php
/*
 AGRIFRPP825
 http://www.swiftbic.com
 
http://fr.wikipedia.org/wiki/ISO_9362

DEUTDEDBDUE 	DEUTSCHE BANK 	DE 	FRANKFURT AM MAIN 	Allemagne
COBADEFFXXX 	COMMERZBANK AG 	DE 	Francfort-sur-le-Main 	Allemagne
GKCCBEBB 	DEXIA BANK SA 	BE 	Bruxelles 	Belgique
ATCICIABXXX 	Banque atlantique Côte d'Ivoire 	CI 	Abidjan 	Côte d'Ivoire
GEBABEBB 	Fortis Banque S.A. 	BE 	Bruxelles 	Belgique
PSSTFRPPNTE 	La Banque postale 	FR 	Centre financier de Nantes 	France
PSSTFRPPMON 	La Banque postale 	FR 	Centre financier de Montpellier 	France
STBKTNTTXXX 	Société tunisienne de banque 	TN
*/

class mfValidatorBIC extends mfValidatorRegex
{
  const REGEX_BIC = '~^[a-zA-Z]{4}[a-zA-Z]{2}[a-zA-Z0-9]{2}([a-zA-Z0-9]{3})?$~';

  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
    $this->setOption('pattern', self::REGEX_BIC);
    $this->addOption('country',"");    
  }

  function doIsValid($value) {
      $value=parent::doIsValid($value);
      if ($this->getOption('country')!=""&&(substr($value,4,2)!=strtoupper($this->getOption('country'))))
          throw new mfValidatorError($this, 'invalid bad country', array());  
      return $value;
  }
  
 }
