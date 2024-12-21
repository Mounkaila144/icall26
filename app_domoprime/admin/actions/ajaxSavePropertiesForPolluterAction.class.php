<?php

require_once dirname(__FILE__).'/../locales/Forms/DomoprimePolluterPropertyViewForm.class.php';

class app_domoprime_ajaxSavePropertiesForPolluterAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
       $messages = mfMessages::getInstance();           
       $this->polluter = new PartnerPolluterCompany($request->getPostParameter('Polluter'));         
       if ($this->polluter->isNotLoaded())
           return ;
       $this->item=new DomoprimePolluterProperty($this->polluter);
       $this->form = new DomoprimePolluterPropertyViewForm();  
       $this->form->bind($request->getPostParameter('PolluterProperty'));
       if ($this->form->isValid())
       {         
            $this->item->add($this->form->getValues())->save();
            $messages->addInfo(__("Property has been updated.")); 
            $this->forward($this->getModuleName(), 'ajaxListPartialPollutingCompany');
       }   
       else
       {
           $messages->addError(__("Form has some errors."));
       }    
    }
}

