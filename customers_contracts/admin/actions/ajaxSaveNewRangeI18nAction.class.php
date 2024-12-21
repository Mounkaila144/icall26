<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractRangeNewForm.class.php";

class customers_contracts_ajaxSaveNewRangeI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {             
       
        $messages = mfMessages::getInstance();                                  
        try
        {      
            $this->form= new CustomerContractRangeNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerContractRange'));             
            $this->item_i18n=new CustomerContractRangeI18n();
            $this->form->bind($request->getPostParameter('CustomerContractRange'),$request->getFiles('CustomerContractRange'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getRange()->add($this->form['range']->getValues());
                $this->item_i18n->add($this->form['range_i18n']->getValues());
                if ($this->item_i18n->getRange()->isExist())
                    throw new mfException (__("Range already exists"));                    
                $this->item_i18n->getRange()->save();                                                                            
                $this->item_i18n->set('range_id',$this->item_i18n->getRange());                                    
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Range already exists"));                                                                                                                                       
                $this->item_i18n->save();
                $messages->addInfo(__("Range has been saved."));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('customers_contracts','ajaxListPartialRange');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['range_i18n']->getValues());
                $this->item_i18n->getRange()->add($this->form['range']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
