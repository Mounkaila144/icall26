<?php



class utils_ajaxSaveTextI18nAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {                          
        $messages = mfMessages::getInstance();       
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);   
        $this->forwardIf(!$site,"sites","ajaxAdmin"); 
        $class=ucfirst(strtolower($request->getRequestParameter('class')))."TextI18n";
        if (!class_exists($class))
             $this->forward404();   
        $this->class=strtolower($request->getRequestParameter('class'));
        try
        {
           $this->form=new TextI18nForm();           
           $this->form->bind($request->getPostParameter('textI18n'));
           if ($this->form->isValid())
           {
               $this->item=new $class($this->form->getValues(),$site);
               if ($this->item->isLoaded())
               {    
                    $this->item->set('text',(string)$this->form['text']);
                    $this->item->save();                    
                    $messages->addInfo(__('text is updated.'));
                    $this->forward('utils','ajaxListTextI18n');
               }
           }              
           $this->language=$this->getUser()->getLanguage();
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }              
    }

}

