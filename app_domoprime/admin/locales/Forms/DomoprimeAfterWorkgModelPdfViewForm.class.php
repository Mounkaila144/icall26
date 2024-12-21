<?php


require_once dirname(__FILE__)."/DomoprimeAfterWorkModelI18nForm.class.php";


class  DomoprimeAfterWorkModelPdfViewForm extends mfForm {
      
    protected $files=null;
    
    function __construct($defaults = array(), $files = array()) {
        $this->files=$files;        
        parent::__construct($defaults);
    }
            
    function configure()
    {              
        $this->embedForm('model', new DomoprimeAfterWorkModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new  DomoprimeAfterWorkModelI18nForm($this->getDefault('model_i18n')));  
       // $this->model_i18n->addValidator('signature',new ValidatorSignatures(array('required'=>false)));      
      //  $this->model_i18n->addValidator('initiator_signature',new ValidatorSignatures(array('required'=>false)));    
        if (!$this->getDefault('model_i18n') || $this->files)
        {                        
            $this->model_i18n->addValidator('file',new mfValidatorFile(array(     
                                                              'required'=>false,
                                                              'mime_types'=>array('application/pdf','application/x-pdf'),
                                                              'max_size'=>4 *1024 *1024,
                                                     )));
        } 
          $this->model->addValidators(array(
            'layer_logo'=>new ValidatorSignatures(array('required'=>false)),    
            'polluter_logo'=>new ValidatorSignatures(array('required'=>false)),    
            'company_logo'=>new ValidatorSignatures(array('required'=>false)),    
            'partner_logo'=>new ValidatorSignatures(array('required'=>false)),    
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
                                            'partner_logo'=>$values['model']['partner_logo']
            ));
        return $values;
    }         

    /*  function getValues()
    {
        $values=parent::getValues();
        $values['options']= serialize(array('layer_logo'=>$this->getValue('layer_logo'),
            'polluter_logo'=>$this->getValue('polluter_logo'),
            'company_logo'=>$this->getValue('company_logo'),));
        return $values;
    }*/

}
