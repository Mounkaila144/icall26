<?php


class PartnerPolluterPdfNewForPolluterForm extends mfForm {
         
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
        $this->embedForm('model', new ProductModelBaseForm($this->getDefault('model')));
        $this->embedForm('model_i18n', new ProductModelI18nBaseForm($this->getDefault('model_i18n')));       
        $this->model_i18n->addValidator('signature',new mfValidatorString(array('required'=>false)));
        $this->model_i18n->addValidator('file',new mfValidatorFile(array(     
                                                          'mime_types'=>array('application/pdf','application/x-pdf'),
                                                          'max_size'=>2 *1024 *1024,
                                                 )));
                 
        unset($this->model_i18n['id'],$this->model['id'],$this->model_i18n['content']);
    }
}

