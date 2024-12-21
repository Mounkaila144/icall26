<?php

require_once dirname(__FILE__)."/../locales/Forms/UserAttributionNewForm.class.php";

class users_ajaxSaveNewAttributionI18nAction extends mfAction {
    
           
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();                                  
        try
        {      
            $this->form= new UserAttributionNewForm($this->getUser()->getCountry(),$request->getPostParameter('UserAttribution'),$this->site);             
            $this->item=new UserAttributionI18n();
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
                $messages->addInfo(__("Attribution has been saved."));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('users','ajaxListPartialAttribution');
            }   
            else
            {               
                // Repopulate
                $this->item->add($this->form['attribution_i18n']->getValues());   
                $this->item->getUserAttribution()->add($this->form['attribution']->getValues());   
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
