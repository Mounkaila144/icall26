<?php


require_once dirname(__FILE__)."/../locales/Forms/DomoprimeSimulationModelViewForm.class.php";


class  app_domoprime_iso_ajaxSaveSimulationModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                  
        $messages = mfMessages::getInstance();     
        $this->form = new DomoprimeSimulationModelViewForm($request->getPostParameter('DomoprimeSimulationModelI18n'));                    
        try
        {            
            $this->item_i18n=new DomoprimeSimulationModelI18n($this->form->getDefault('model_i18n'));               
            $this->form->bind($request->getPostParameter('DomoprimeSimulationModelI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                $this->item_i18n->getModel()->add($this->form['model']->getValues());  
                if ($this->item_i18n->getModel()->isExist() || $this->item_i18n->isExist())
                            throw new mfException (__("Model already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                
                {                           
                    $this->item_i18n->set('model_id',$this->item->getModel());                                                                                                                                                             
                }         
                $this->item_i18n->getModel()->save();
                $this->item_i18n->save();
                $messages->addInfo(__("Model [%s] has been saved.",$this->item_i18n->get('value')));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime_iso','ajaxListPartialSimulationModel');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));              
               $this->item_i18n->getModel()->add($this->form['model']->getValues());
               $this->item_i18n->add($this->form['model_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        $this->country=$this->getUser()->getCountry();
   }

}

