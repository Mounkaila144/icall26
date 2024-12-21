<?php


require_once dirname(__FILE__)."/DomoprimeClassI18nForm.class.php";


class DomoprimeClassViewForm extends mfForm {
      
    protected $user=null;
    
    function __construct($user,$defaults = array(), $options = array()) {
        $this->user=$user;
        parent::__construct($defaults, $options);
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function configure()
    {
        $this->embedForm('class', new DomoprimeClassBaseForm($this->getDefault('class')));
        $this->embedForm('class_i18n', new DomoprimeClassI18nForm($this->getDefault('class_i18n')));
        unset($this->class_i18n['id'],$this->class['id']);       
        if ($this->getUser()->hasCredential(array(array('app_domoprime_class_view_no_multiple_floor_top_wall'))))          
            unset($this->class['multiple'],$this->class['multiple_floor'],$this->class['multiple_top'],$this->class['multiple_wall']);       
    }

  

}
