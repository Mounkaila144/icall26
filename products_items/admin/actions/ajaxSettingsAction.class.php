<?php

class products_items_ajaxSettingsAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->settings= new ProductItemSettings();                           
        $this->form=new ProductItemSettingsForm();           
        if ($request->getPostParameter('Settings'))
        {
            try 
            {               
                $this->form->bind($request->getPostParameter('Settings'));
                if ($this->form->isValid())
                {                             
                    $this->settings->add($this->form->getValues());
                    $this->settings->save();
                    $messages->addInfo(__("Settings have been saved."));
                    $this->forward('products','ajaxListPartialProduct');
                }
                else
                {          
                 //   var_dump($this->form->getErrorSchema()->getErrorsMessage());
                  $messages->addError(__('Settings has some errors.'));
                  $this->settings->add($request->getPostParameter('Settings')); // Repopulate
                }  
            }
            catch (mfException $e)
            {
              $messages->addError($e);
            }       
        }    
    }

}
