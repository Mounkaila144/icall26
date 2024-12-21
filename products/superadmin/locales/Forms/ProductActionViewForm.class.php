<?php


class ProductActionViewForm extends ProductActionBaseForm {
    
    protected $user=null;
    
    function __construct($defaults = array(),$user=null,$site = null) {
        $this->user=$user;
        parent::__construct($defaults, array(), $site);
    }
   
    function getUser()
    {
        return $this->user;
    }
    
}


