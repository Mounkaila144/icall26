<?php



class DomoprimeMultipleContractProcessSelectionForm extends mfForm {

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
        $this->actions=new mfArray(array("state","sms_customer"));
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->actions)));
     //   $this->setValidator('created_at',new mfValidatorI18nDate(array("required"=>false,"date_format"=>"a")));
     //   $this->setValidator('in_at',new mfValidatorI18nDateTime(array("required"=>false,"date_format"=>"a","scale_minute"=>15,"scale_hour"=>1,"hour_min"=>6,"hour_max"=>23)));             
     //   $this->setValidator('telepro_id', new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No teleprospector"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('TELEPRO',$this->getUser()))));                
     //   $this->setValidator('sales_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))));
     //   $this->setValidator('sale2_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>array("0"=>__("No commercial"))+UserFunctionUtils::getUsersByFunctionForSelectForUser('SALES',$this->getUser()))));
        $this->setValidator('state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerContractStatusUtils::getStatusForI18nSelect())));
        $this->setValidator('sms_customer_model_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>CustomerModelSmsUtils::getModelSmsForSelect())));                         
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
    
   /*  function getSelectionJson()
    {
        return json_encode($this['selection']->getValue());
    }*/
    
   /* function getSelection()
    {
        return new mfArray($this['selection']->getValue());
    }*/
    
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