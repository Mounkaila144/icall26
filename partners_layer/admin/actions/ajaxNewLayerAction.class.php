<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLayerCompanyWithContactNewForm.class.php";
 

class partners_layer_ajaxNewLayerAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        $this->item = new PartnerLayerContact(); // new object        
        $this->form = new PartnerLayerCompanyWithContactNewForm($request->getPostParameter('PartnerLayer'));      
        if ($request->getPostParameter('PartnerLayer'))
        {
            try {
                $this->form->bind($request->getPostParameter('PartnerLayer'));
                if ($this->form->isValid()) {
                    $this->item->add($this->form['contact']->getValues());
                    $this->item->getPartner()->add($this->form['company']->getValues());
                    if ($this->item->getPartner()->isExist())
                        throw new mfException (__("Partner layer already exists")); 
                    if ($this->item->isExist())
                        throw new mfException (__("Contact already exists")); 
                    $this->item->getPartner()->save();
                    $this->item->set('company_id',$this->item->getPartner());                                        
                    $this->item->save();
                    $messages->addInfo(__("Partner layer [%s] (%s) has been saved",array($this->item->getPartner()->get('name'),(string)$this->item)));                   
                    $this->forward("partners_layer","ajaxListPartialLayerCompany");
                }
                else
                {
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($this->form['contact']->getValues()); // repopulate
                   $this->item->getPartner()->add($this->form['company']->getValues()); // repopulate
                   
                   //var_dump($this->form->getErrorSchema()->getErrorsMessage());
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }

}
