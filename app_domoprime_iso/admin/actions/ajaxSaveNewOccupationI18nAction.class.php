<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeOccupationNewForm.class.php";

class app_domoprime_iso_ajaxSaveNewOccupationI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {                      
        $messages = mfMessages::getInstance();                                  
        try
        {      
            $this->form= new DomoprimeOccupationNewForm($this->getUser()->getCountry(),$request->getPostParameter('DomoprimeOccupation'));             
            $this->item_i18n=new DomoprimeOccupationI18n();
            $this->form->bind($request->getPostParameter('DomoprimeOccupation'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getOccupation()->add($this->form['occupation']->getValues());
                $this->item_i18n->add($this->form['occupation_i18n']->getValues());
                if ($this->item_i18n->getOccupation()->isExist())
                    throw new mfException (__("occupation already exists"));                       
                $this->item_i18n->getOccupation()->save();                                                                           
                $this->item_i18n->set('occupation_id',$this->item_i18n->getOccupation());                                    
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Occupation already exists"));                                                                                                                                       
                $this->item_i18n->save();
                $messages->addInfo(__("Occupation has been saved."));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime_iso','ajaxListPartialOccupation');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['occupation_i18n']->getValues());
                $this->item_i18n->getOccupation()->add($this->form['occupation']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
