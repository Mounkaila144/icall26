<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeEnergyNewForm.class.php";

class app_domoprime_ajaxSaveNewEnergyI18nAction extends mfAction {
    
       
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();              
        try
        {      
            $this->form= new DomoprimeEnergyNewForm($this->getUser()->getCountry(),$request->getPostParameter('DomoprimeEnergy'));             
            $this->item_i18n=new DomoprimeEnergyI18n();
            $this->form->bind($request->getPostParameter('DomoprimeEnergy'),$request->getFiles('DomoprimeEnergy'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getEnergy()->add($this->form['energy']->getValues());
                $this->item_i18n->add($this->form['energy_i18n']->getValues());
              //  if ($this->item_i18n->getEnergy()->isExist())
             //       throw new mfException (__("energy already exists"));                                                 
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Energy already exists")); 
                $this->item_i18n->getEnergy()->save();
                $this->item_i18n->set('energy_id',$this->item_i18n->getEnergy());   
                $this->item_i18n->save();
                $messages->addInfo("Energy has been saved.");
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime','ajaxListPartialEnergy');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['energy_i18n']->getValues());
                $this->item_i18n->getEnergy()->add($this->form['energy']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
