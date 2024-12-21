<?php


 require_once dirname(__FILE__)."/../locales/Forms/UserAttributionViewForm.class.php";
 
class  users_ajaxSaveAttributionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new UserAttributionViewForm($request->getPostParameter('UserAttributionI18n'),$this->site);                    
        try
        {            
            $this->item=new UserAttributionI18n($this->form->getDefault('attribution_i18n'),$this->site);               
            $this->form->bind($request->getPostParameter('UserAttributionI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['attribution_i18n']->getValues());  
                $this->item->getUserAttribution()->add($this->form['attribution']->getValues()); 
                if ($this->item->isExist() || $this->item->getUserAttribution()->isExist())
                      throw new mfException (__("Attribution already exists"));                                                      
                if ($this->item->isNotLoaded())
                {                                                                                       
                    $this->item->set('attribution_id',$this->item->getUserAttribution());                                                                                                                                                                  
                }                    
                $this->item->getUserAttribution()->save();
                $this->item->save();
                $messages->addInfo(__('Attribution has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('users','ajaxListPartialAttribution');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));                             
               $this->item->add($this->form['attribution_i18n']->getValues());   
               $this->item->getUserAttribution()->add($this->form['function']->getValues());                
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

