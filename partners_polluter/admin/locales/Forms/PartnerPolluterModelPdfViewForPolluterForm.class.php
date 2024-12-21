<?php


require_once dirname(__FILE__)."/PartnerPolluterModelI18nForm.class.php";


class PartnerPolluterModelPdfViewForPolluterForm extends mfForm {
      
    protected $files=null;
    
    function __construct($defaults = array(), $files = array()) {
        $this->files=$files;        
        parent::__construct($defaults);
    }
            
    function configure()
    {              
        $this->embedForm('model', new PartnerPolluterModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new PartnerPolluterModelI18nForm($this->getDefault('model_i18n')));  
        $this->model_i18n->addValidator('signature',new ValidatorSignatures(array('required'=>false)));      
        $this->model_i18n->addValidator('initiator_signature',new ValidatorSignatures(array('required'=>false)));    
        if (!$this->getDefault('model_i18n') || $this->files)
        {                        
            $this->model_i18n->addValidator('file',new mfValidatorFile(array(     
                                                              'required'=>false,
                                                              'mime_types'=>array('application/pdf','application/x-pdf'),
                                                              'max_size'=>4 *1024 *1024,
                                                     )));
        } 
        unset($this->model_i18n['id'],$this->model['id'],$this->model_i18n['content']);
    }


}
