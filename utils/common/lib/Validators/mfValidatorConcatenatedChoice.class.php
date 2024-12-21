<?php

class mfValidatorConcatenatedChoice extends mfValidatorChoice
{
  
  protected function doIsValid($value)
  {
    $choices = $this->getChoices();
    if ($this->getOption('multiple'))
    {
      $value = $this->cleanMultiple($value, $choices);
    }
    else
    {
      if (!$this->inChoices($value, $choices))
      {
        throw new mfValidatorError($this, 'invalid', array('value' => $value));
      }
    }
    
    // string 3_1_7
    return array('energy_id'=>'7',"sector_id"=>1,"class_id"=>3);
    
    

    return $value;
  }
  
  
/*
 *   separator
 *   {energy_id}_{sector_id}_{class_id}
 *   'energy_id' => 'DomoprimeEnergy'
 */
  /*
   * Formfilter
   * class_energy_sector  =>array('energy_id'=>'DomoprimeEnergy','sector_id'=>'DomoprimeSector','class_id'=>'DomoprimeClass'),
   * 
   */
 /* function getSchema()
  {
      return $this->schema; 
  }*/
  
}
