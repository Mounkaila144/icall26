<?php

class SiteInitialization extends mfFormSite {
    
    function __construct($defaults = array(), $site = null) {
        parent::__construct($defaults, array(), $site);
    }
    
    function configure() {
        $this->setValidators(array(
            
        ));
    }
}

class site_ajaxInitializationAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
      $messages=mfMessages::getInstance(); 
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
      $this->tabs=TabsManager::getInstance('site.initialization',$this->site)->getSortedTabs();    
      $this->form=new SiteInitialization($request->getPostParameter('SiteInitialization'),$this->site);
      $this->getEventDispather()->notify(new mfEvent($this->form, 'site.initialization.form.config'));      
      if (!$request->isMethod('POST') || !$request->getPostParameter('SiteInitialization'))
           return ;
      $this->form->bind($request->getPostParameter('SiteInitialization'));
      try
      {
        if ($this->form->isValid())
        {
            $this->getEventDispather()->notify(new mfEvent($this->form, 'site.initialization.execute'));  
            $messages->addInfo(__('Site is initialized'));
        }  
        else 
        { 
            $messages->addError(__('Form has some errors.'));
        }
      }
      catch (mfException $e)
      {
           $messages->addError($e);
      }
      
    }

}

