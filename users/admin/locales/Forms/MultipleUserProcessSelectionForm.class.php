<?php



class MultipleUserProcessSelectionForm extends mfForm {

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
        $this->_actions=new mfArray();        
        if (!$this->hasDefaults())
        {    
            $this->setDefaults(array(
              
            ));
        }
        $this->setValidators(array(
            'count'=>new mfValidatorInteger(),   
            'selection'=>new mfValidatorSchemaForEach(new mfValidatorInteger(),count($this->getDefault('selection'))),            
        ));             
           
        if ($this->getUser()->hasCredential(array(array('superadmin'))))
        {                        
            $this->_actions->push("generate_password");    
            $this->_actions->push("profile");           
            $this->_actions->push("secure_by_code");           
        }
      //  mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this, 'users.multiple.form.config'));   
        $this->setValidator('actions', new mfValidatorChoice(array('required'=>false,'multiple'=>true,'choices'=>$this->_actions)));
        $this->setValidator('profile_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=> array(''=>'')+UserProfile::getProfilesI18nForSelect()->toArray())));
        $this->setValidator('is_secure_by_code',new mfValidatorBoolean(array('true'=>'YES','false'=>'NO')));
        
    }
    
    
    function getActions()
    {
       return $this['actions']->getArray();   
    }
    
    function getSelection()
    {
        return $this['selection']->getArray();        
    }
             
    function setSelection(mfArray $selection)
    {
        $this->setDefault('selection', $selection->toArray());
        $this->setDefault('count', $selection->count());
    }       
      
}