<?php


 
class utils_ajaxNewTextEmailI18nAction extends mfAction {

     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {    
           
        $messages = mfMessages::getInstance();
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$site,"sites","ajaxAdmin");         
        try 
        {
           $this->item=new TextEmailI18n(null,$site);
           $this->form = new TextEmailI18nForm($request->getPostParameter('textEmailI18n',array('lang'=>$this->getUser()->getLanguage(),
                                                                                                'module'=>$request->getParameter('module')
                                                                                               )
                                               ));                                  
            if ($request->getPostParameter('textEmailI18n'))
            {    
                $this->form->bind($request->getPostParameter('textEmailI18n'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__('this text already exists'));
                    $this->item->save();
                    $messages->addInfo(__('text is saved.'));      
                    $request->addRequestParameter('module', $this->item->get('module'));
                    $this->forward('utils','ajaxListTextEmailI18n');        
                }
                else
                {                    
                    $this->item->add($request->getPostParameter('textEmailI18n'));                    
                }    
            }  
        
        } 
        catch (mfException $e)
        {          
           $messages->addError($e);
        }   
        $this->language=$this->getUser()->getLanguage();             
    }

}