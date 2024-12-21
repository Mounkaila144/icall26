<?php


 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeTypeLayerViewForm.class.php";
 
class  app_domoprime_iso_ajaxSaveTypeLayerI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new DomoprimeTypeLayerViewForm($request->getPostParameter('DomoprimeTypeLayerI18n'));                    
        try
        {            
            $this->item_i18n=new DomoprimeTypeLayerI18n($this->form->getDefault('type_i18n'));               
            $this->form->bind($request->getPostParameter('DomoprimeTypeLayerI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['type_i18n']->getValues());
                $this->item_i18n->getType()->add($this->form['type']->getValues());  
                if ($this->item_i18n->getType()->isExist() || $this->item_i18n->isExist())
                            throw new mfException (__("type already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                
                {                           
                    $this->item_i18n->set('type_id',$this->item_i18n->getType());                                                                                                                                                                 
                }         
                $this->item_i18n->getType()->save();
                $this->item_i18n->save();
                $messages->addInfo(__('Type has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime_iso','ajaxListPartialTypeLayer');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item_i18n->getType()->add($this->form['type']->getValues());
               $this->item_i18n->add($this->form['type_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

