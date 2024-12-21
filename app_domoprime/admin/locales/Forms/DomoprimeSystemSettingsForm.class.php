<?php



class DomoprimeSystemSettingsForm extends mfForm {

    protected $user=null,$selection=null,$_actions=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure() {           
        $this->_actions=new mfArray(array('contract_forms','calculation_double','quotation_double','forms_double','yousign_meeting_document'));       
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->_actions->toArray())));
    }
    
    function getActions()
    {
        return $this->_actions;
    }
      
    
    function hasAction($action)
    {
        return in_array($action,(array)$this['actions']->getValue());
    }
    
    function hasActions()
    {           
        return $this['actions']->getValue();
    }
    
    function hasActionInValidator($action)
    {
        return in_array($action,$this->actions->getOption('choices'));
    }
    
    
    function getNumberOfContractNotAffected()
    {
        return CustomerMeetingForms::getNumberOfContractNotAffected();
    }
    
    function getNumberOfDoubleCalculation()
    {
        return DomoprimeUtils::getNumberOfDoubleCalculation();
    }
    
     function getNumberOfDoubleQuotation()
    {
        return DomoprimeUtils::getNumberOfDoubleQuotation();
    }
    
    function getNumberOfDoubleDocument()
    {
        return DomoprimeYouSignMeetingDocumentForm::getNumberOfDoubleDocument();
    }
    
    function getNumberOfDoubleForm()
    {
        return CustomerMeetingForms::getNumberOfDouble();
    }
    
    function process()
    {
        CustomerMeetingForms::setAffectMissingContracts();
    }
}
