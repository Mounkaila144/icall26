<?php


class PartnerPolluterModelDocNewForPolluterForm extends mfForm {
         
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
        $this->embedForm('model', new PartnerPolluterModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new PartnerPolluterModelI18nBaseForm($this->getDefault('model_i18n')));       
        $this->model_i18n->addValidator('signature',new ValidatorSignatures(array('required'=>false)));
        $this->model_i18n->addValidator('initiator_signature',new ValidatorSignature(array('required'=>false)));
        $this->model_i18n->addValidator('mapping',new mfValidatorString(array('max_length'=>32768,'required'=>false)));
        $this->model_i18n->addValidator('file',new mfValidatorFile(array(     
                                                          'mime_types'=>array(
                                                                 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                                                              'application/octet-stream',
                                                              'application/zip'
                                                                            ),
                                                          'max_size'=>4 *1024 *1024,
                                                 )));
                 
        unset($this->model_i18n['id'],$this->model['id'],$this->model_i18n['content']);
    }
}

