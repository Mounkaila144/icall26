<?php


 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeOccupationViewForm.class.php";
 
class  app_domoprime_iso_ajaxSaveOccupationI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new DomoprimeOccupationViewForm($request->getPostParameter('DomoprimeOccupationI18n'));                    
        try
        {            
            $this->item_i18n=new DomoprimeOccupationI18n($this->form->getDefault('occupation_i18n'));               
            $this->form->bind($request->getPostParameter('DomoprimeOccupationI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['occupation_i18n']->getValues());
                $this->item_i18n->getOccupation()->add($this->form['occupation']->getValues());  
                if ($this->item_i18n->getOccupation()->isExist() || $this->item_i18n->isExist())
                            throw new mfException (__("Occupation already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                                                       
                    $this->item_i18n->set('occupation_id',$this->item_i18n->getOccupation());                                                                                                                                                                                   
                $this->item_i18n->getOccupation()->save();
                $this->item_i18n->save();
                $messages->addInfo(__('Occupation has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime_iso','ajaxListPartialOccupation');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item_i18n->getOccupation()->add($this->form['occupation']->getValues());
               $this->item_i18n->add($this->form['occupation_i18n']->getValues()); 
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

