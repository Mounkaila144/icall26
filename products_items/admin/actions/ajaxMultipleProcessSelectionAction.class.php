<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleProcessSelectionForm.class.php";


class products_items_ajaxMultipleProcessSelectionAction extends mfAction {
    
       
    
   
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                        
        $this->user=$this->getUser();
        $this->form=new MultipleProcessSelectionForm($this->getUser(),$request->getPostParameter('MultipleSelection'));        
        $this->form->bind($request->getPostParameter('MultipleSelection'));
        try
        {
            if ($this->form->isValid())  
            {                                                    
                $multiple=new ProductItemMultipleProcess($this->form['actions']->getValue(),$this->form->getSelection(),$this->form->getValues(),$this->getUser());
                $multiple->process();                          
                $messages->addInfos($multiple->getMessages());         
                $messages->addErrors($multiple->getErrors());
            }  
            else
            {
             //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                //var_dump($this->form->getDefaults());
              //  echo "<pre>"; var_dump($request->getPostParameter('MultipleMeetingSelection')); echo "</pre>";
                $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
