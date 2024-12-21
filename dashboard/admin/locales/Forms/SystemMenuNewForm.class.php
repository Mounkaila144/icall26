<?php


 class SystemMenuNewForm extends mfForm {
         
     protected $language=null;
    
    function __construct($language='fr',$defaults=array())
    {              
        $this->language=$language;             
        parent::__construct(array_merge(array('menu_i18n'=>array('lang'=>$language)),$defaults));
    }
          
   /*  function getLanguage()
    {          
        if ($this->isValid())
            return $this['menu_i18n']['lang']->getValue(); 
        return new Language($this->defaults['menu_i18n']['lang']);
    }*/
    
    function configure()
    {       
       // var_dump(new SystemMenuForm());
        $this->embedForm('menu', new SystemMenuBaseForm($this->getDefault('menu')));
        $this->embedForm('menu_i18n', new SystemMenuI18nBaseForm($this->getDefault('menu_i18n')));     
        $this->menu->setValidator('parent_id',new ObjectExistsValidator('SystemMenu',array('key'=>false,'required'=>false)));
       /* if ($this->defaults['menu']['name'])
            $this->menu_i18n['title']->setOption('required',false);*/
        unset($this->menu_i18n['id'],$this->menu['id']);       
    }
     
    
      function hasParent()
    {
        return (boolean)$this['menu']['parent_id']->getValue(); 
    }
    
    function getParent()
    {
        return $this['menu']['parent_id']->getValue();
    }
    
    
}

