<?php


class UserAttributionsForm extends mfForm {
                
    
  
    function configure()
    {
       $this->setValidators(array(
           'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection')))
       ));
       $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback' => array($this, 'reorganize'))));
    }
    
    function reorganize($validator,$values)
    {
        if ($this->errorSchema->hasErrors())
            return $values;       
        if ($values['selection'])
        { 
            // Take only existing functions even if some wrong values
            $db=mfSiteDatabase::getInstance();           
            $db->setQuery("SELECT id FROM ".UserAttribution::getTable()." WHERE id IN('".implode("','",$values['selection'])."');")
               ->makeSqlQuery();
            $values['selection']=array();
            if (!$db->getNumRows())
                return $values;
            while ($row=$db->fetchArray())                                             
                $values['selection'][]=$row['id'];                 
        } 
        return $values;
    }
}

