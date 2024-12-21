<?php


 class SystemMenuNewForm extends mfForm {
         
     protected $language=null,$node=null,$_category=null;
    
    function __construct(SystemMenu $node,$language='en',$defaults=array())
    {     
        $this->node=$node;
        $this->language=$language;                    
        parent::__construct(array_merge(array('menu_i18n'=>array('lang'=>$language)),$defaults));
    }
    
    function getNode()
    {
        return $this->node;
    }
    
    function getMenuI18n()
    {
        if ($this->_menu_i18n===null)
        {                      
            $this->_menu_i18n=new SystemMenuI18n(array('lang'=>(string)$this->getLanguage()));           
            $this->_menu_i18n->set('menu_id',$this->getMenu());
        }
        return $this->_menu_i18n;
    }
          
     function getLanguage()
    {          
        if ($this->isValid())
            return $this['menu_i18n']['lang']->getValue(); 
        return new Language($this->defaults['menu_i18n']['lang']);
    }
    
  /*  function configure()
    {       
        $this->setValidator('id', new AppAdsUserAdvertCategoryValidator(array('required'=>false,'empty_value'=>new AppAdsUserAdvertCategory())));
        $this->setValidator('tab',new mfValidatorInteger(array('required'=>false,'min'=>0)));     
        $this->embedForm('category', new AppAdsUserAdvertCategoryBaseForm($this->getDefault('category')));
        $this->embedForm('menu_i18n', new AppAdsUserAdvertCategoryI18nBaseForm($this->getDefault('menu_i18n')));     
        $this->menu_i18n->setValidator('menu_id',new ObjectExistsValidator('AppAdsUserAdvertCategory',array('key'=>false,'empty_value'=>null,'required'=>false)));
        $this->category->addValidator('sale_state_id',new mfValidatorChoice(array('key'=>true,'required'=>false,'choices'=>AppAdsUserAdvertCategorySaleState:: getAllI18nForSelect()->unshift(array(''=>'--')))));                  
    }*/
       
    function hasMenu()
    {
        return (boolean)$this['menu_i18n']['menu_id']->getValue();
    }
    
    function getMenu()
    {
        if ($this->_category===null)
        {    
            if ($this->isValid())         
                $this->_category= $this->hasMenu()?$this['menu_i18n']['menu_id']->getValue():$this->getNode()->create();   
            else            
                $this->_category=new SystemMenu($this->defaults['id']);              
            $this->_category->set('state',null);
        }
        return $this->_category;
    }
    
    
  
}

