<?php


class ProductViewForm extends ProductBaseForm {
    
    protected $user=null;
    
    function __construct($defaults = array(),$user=null,$site = null) {
        $this->user=$user;
        parent::__construct($defaults, $site);
    }
   
    function getUser()
    {
        return $this->user;
    }
    
    
    function configure() {
        parent::configure();
        $this->setValidator('action_id', new mfValidatorChoice(array("required"=>false,"key"=>true,"choices"=>array(""=>"")+ProductAction::getActionsForSelect($this->getSite()))));
        $this->setValidator('unit', new mfValidatorString(array("max_length"=>"64","required"=>false)));
         $this->setValidator('tva_id', new mfValidatorChoice(array("key"=>true,"choices"=>TaxUtils::getTaxesForSelect($this->getSite()))));       
       $this->setValidator('price', new mfValidatorI18nNumber());
    }
}


