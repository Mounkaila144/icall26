<?php
// 153,81,435,153|2;156,281,439,353|5

class  DomoprimePreMeetingModelPdfNewForm extends mfForm {
         
    protected $language=null;
    
    function __construct($language='en',$defaults=array())
    {       
        $this->language=$language;
        $defaults=array_merge(array('model_i18n'=>array('lang'=>$this->getLanguage())),$defaults);      
        parent::__construct($defaults,array());
    }
           
    function getLanguage()
    {
        return $this->language;
    }
    
    function configure()
    {
        $this->embedForm('model', new  DomoprimePreMeetingModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new DomoprimePreMeetingModelI18nBaseForm($this->getDefault('model_i18n')));       
       // $this->model_i18n->addValidator('signature',new ValidatorSignatures(array('required'=>false)));
      //  $this->model_i18n->addValidator('initiator_signature',new ValidatorSignature(array('required'=>false)));
        $this->model_i18n->addValidator('file',new mfValidatorFile(array(     
                                                          'mime_types'=>array('application/pdf','application/x-pdf'),
                                                          'max_size'=>4 *1024 *1024,
                                                 )));
           
         $this->model->addValidators(array(
            'layer_logo'=>new ValidatorSignatures2(array('required'=>false)),    
            'polluter_logo'=>new ValidatorSignatures2(array('required'=>false)),    
            'company_logo'=>new ValidatorSignatures2(array('required'=>false)),    
                 'company_header'=>new ValidatorSignatures2(array('required'=>false)),    
            'company_footer'=>new ValidatorSignatures2(array('required'=>false)),    
        ));                 
        unset($this->model_i18n['id'],$this->model['id'],$this->model_i18n['content']);
         $this->validatorSchema->setPostValidator(new mfValidatorCallback(array('callback'=>array($this, 'reorganize'))));
    }
    
     function reorganize($validator,$values)
    {
        if ($this->hasErrors())
            return $values;        
        $values['model']['options']= serialize(array('layer_logo'=>$values['model']['layer_logo'],
                                            'polluter_logo'=>$values['model']['polluter_logo'],
                                            'company_logo'=>$values['model']['company_logo'],
                                            'company_header'=>$values['model']['company_header'],
                                            'company_footer'=>$values['model']['company_footer'],
            ));
        return $values;
    }  
    
    
}

