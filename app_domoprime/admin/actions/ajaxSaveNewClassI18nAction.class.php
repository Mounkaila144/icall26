<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeClassNewForm.class.php";

class app_domoprime_ajaxSaveNewClassI18nAction extends mfAction {
    
       
            
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();              
        try
        {      
            $this->form= new DomoprimeClassNewForm($this->getUser(),$this->getUser()->getLanguage(),$request->getPostParameter('DomoprimeClass'));             
            $this->item_i18n=new DomoprimeClassI18n();
            $this->form->bind($request->getPostParameter('DomoprimeClass'),$request->getFiles('DomoprimeClass'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getClass()->add($this->form['class']->getValues());
                $this->item_i18n->add($this->form['class_i18n']->getValues());
                if ($this->item_i18n->getClass()->isExist())
                    throw new mfException (__("class already exists"));                                                 
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Class already exists")); 
                $this->item_i18n->getClass()->save();
                $this->item_i18n->set('class_id',$this->item_i18n->getClass());   
                $this->item_i18n->save();
                $messages->addInfo("Class has been saved.");
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime','ajaxListPartialClass');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['class_i18n']->getValues());
                $this->item_i18n->getClass()->add($this->form['class']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
