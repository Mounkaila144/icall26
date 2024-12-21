<?php


 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeEnergyViewForm.class.php";
 
class  app_domoprime_ajaxSaveEnergyI18nAction extends mfAction {
    
   
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new DomoprimeEnergyViewForm($request->getPostParameter('DomoprimeEnergyI18n'));                    
        try
        {            
            $this->item_i18n=new DomoprimeEnergyI18n($this->form->getDefault('energy_i18n'));               
            $this->form->bind($request->getPostParameter('DomoprimeEnergyI18n'),$request->getFiles('DomoprimeEnergyI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['energy_i18n']->getValues());
                $this->item_i18n->getEnergy()->add($this->form['energy']->getValues());  
                if ($this->item_i18n->isExist())
                            throw new mfException (__("Energy already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                
                {                           
                    $this->item_i18n->set('energy_id',$this->item_i18n->getEnergy());                                                                                                                                                                
                }         
                $this->item_i18n->getEnergy()->save();
                $this->item_i18n->save();
                $messages->addInfo(__('Energy has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime','ajaxListPartialEnergy');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item_i18n->getEnergy()->add($this->form['energy']->getValues());
               $this->item_i18n->add($this->form['energy_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

