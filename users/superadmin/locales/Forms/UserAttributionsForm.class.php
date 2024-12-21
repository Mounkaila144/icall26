<?php


class UserAttributionsForm extends mfFormSite {
                
    
    function __construct($defaults = array(), $site = null) 
    {      
        parent::__construct($defaults, array(), $site);
    }
    
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
               ->makeSiteSqlQuery($this->getSite());
            $values['selection']=array();
            if (!$db->getNumRows())
                return $values;
            while ($row=$db->fetchArray())                                             
                $values['selection'][]=$row['id'];                 
        } 
        return $values;
    }
}

