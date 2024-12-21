<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeTypeLayerNewForm.class.php";

class app_domoprime_iso_ajaxSaveNewTypeLayerI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();                                  
        try
        {      
            $this->form= new DomoprimeTypeLayerNewForm($this->getUser()->getCountry(),$request->getPostParameter('DomoprimeTypeLayer'));             
            $this->item_i18n=new DomoprimeTypeLayerI18n();
            $this->form->bind($request->getPostParameter('DomoprimeTypeLayer'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getType()->add($this->form['type']->getValues());
                $this->item_i18n->add($this->form['type_i18n']->getValues());
                if ($this->item_i18n->getType()->isExist())
                    throw new mfException (__("Type already exists"));                  
                $this->item_i18n->getType()->save();                                                                         
                $this->item_i18n->set('type_id',$this->item_i18n->getType());                                    
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Type already exists"));                                                                                                                                       
                $this->item_i18n->save();
                $messages->addInfo(__("Type has been saved."));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime_iso','ajaxListPartialTypeLayer');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['type_i18n']->getValues());
                $this->item_i18n->getType()->add($this->form['type']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
