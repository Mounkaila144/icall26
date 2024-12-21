<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAssetModelNewForm.class.php";

class app_domoprime_ajaxSaveNewAssetModelI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();                                     
        try
        {      
            $this->form= new DomoprimeAssetModelNewForm($this->getUser()->getCountry(),$request->getPostParameter('DomoprimeAssetModel'));             
            $this->item_i18n=new DomoprimeAssetModelI18n();
            $this->form->bind($request->getPostParameter('DomoprimeAssetModel'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getModel()->add($this->form['model']->getValues());
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                if ($this->item_i18n->getModel()->isExist())
                    throw new mfException (__("Model already exists."));                                                      
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Model already exists"));          
                $this->item_i18n->getModel()->save();
                $this->item_i18n->set('model_id',$this->item_i18n->getModel());  
                $this->item_i18n->save();
                $messages->addInfo(__("Model [%s] has been created.",$this->item_i18n->get('value')));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime','ajaxListPartialAssetModel');
            }   
            else
            {               
                // Repopulate
               // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                $this->item_i18n->getModel()->add($this->form['model']->getValues());
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
