<?php

require_once dirname(__FILE__)."/../locales/Forms/UserAttributionNewForm.class.php";

class users_ajaxSaveNewAttributionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                                 
        try
        {      
            $this->form= new UserAttributionNewForm($this->getUser()->getCountry(),$request->getPostParameter('UserAttribution'),$this->site);             
            $this->item=new UserAttributionI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('UserAttribution'));
            if ($this->form->isValid())
            {               
                $this->item->add($this->form['attribution_i18n']->getValues());   
                $this->item->getUserAttribution()->add($this->form['attribution']->getValues());   
                $this->item->getUserAttribution()->save();                                                                            
                $this->item->set('attribution_id',$this->item->getUserAttribution());                                    
                if ($this->item->isExist())
                    throw new mfException (__("Attribution already exists"));                                                                                                                                       
                $this->item->save();
                $messages->addInfo("Attribution has been saved.");
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('users','ajaxListPartialAttribution');
            }   
            else
            {               
                // Repopulate
                $this->item->add($this->form['attribution_i18n']->getValues());   
                $this->item->getUserAttribution()->add($this->form['attribution']->getValues());   
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
