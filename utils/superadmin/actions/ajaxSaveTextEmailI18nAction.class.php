<?php



class utils_ajaxSaveTextEmailI18nAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {                          
        $messages = mfMessages::getInstance();       
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);   
        $this->forwardIf(!$site,"sites","ajaxAdmin");        
        try
        {                          
            $this->form=new TextEmailI18nForm();                    
            $this->form->bind($request->getPostParameter('textEmailI18n'));
            if ($this->form->isValid())
            {
                $this->item=new TextEmailI18n($this->form->getValues(),$site);
                if ($this->item->isLoaded())
                {    
                     $this->item->set('body',(string)$this->form['body']);
                     $this->item->set('subject',(string)$this->form['subject']);
                     $this->item->save();
                     $messages->addInfo(__('text is updated.'));
                     $request->addRequestParameter('module', $this->item->get('module'));
                     $this->forward('utils','ajaxListTextEmailI18n');        
                }
            }            
           $this->language=$this->getUser()->getLanguage();
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }              
      //  var_dump($this->item);
      //  return mfView::NONE;
    }

}

