<?php


class MultipleMarketingLeadsProcessSelectionForm extends mfForm {

    protected $user=null,$selection=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {           
        $settings=  CustomerContractSettings::load();
        if (!$this->hasDefaults())
        {    
            $this->setDefaults(array(
               // 'in_at'=>array('date'=>date('Y-m-d'),'hour'=>'06','minute'=>'00'),
              //  'in_at'=>date("Y-m-d")." 06:00:00",
              //  'created_at'=>date('Y-m-d')
            ));
        }
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(),   
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),            
        ));     
        $this->actions=new mfArray(array("state"));
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->actions)));
        $this->setValidator('state',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=> MarketingLeadsWpFormsStatus::getStatusWithI18nForSelect()->toArray())));//array("NEW"=>__("NEW"),"NOT EXPORTED"=>__("NOT EXPORTED"),"EXPORTED"=>__("EXPORTED"))

    }
    
    function getActions()
    {
        return $this->actions;
    }
    
    
    function getSelection()
    {
        if ($this->selection===null)
            $this->selection=new mfArray($this['selection']->getValue());
        return $this->selection;
    }
       
    function getSelectionCount()
    {
        return count($this['selection']->getValue());
    }
    
    function setSelection($selection)
    {
        $this->setDefault('selection', $selection);
        $this->setDefault('count', count($selection));
    }
    
    function hasAction($action)
    {
        return in_array($action,(array)$this['actions']->getValue());
    }
    
    function hasActions()
    {           
        return $this['actions']->getValue();
    }
    
    function getSelectionForUrl()
    {       
        return http_build_query(array('selection'=>$this->getSelection()->implode()));
    }
}