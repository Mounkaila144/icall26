<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLayerContactViewForm.class.php";
 

class partners_layer_ajaxSavePartnerContactAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();   
        $this->item = new PartnerLayerContact($request->getPostParameter('PartnerLayerContact')); // new object       
        if ($this->item->isNotLoaded())
        {
            $messages->addError(__('Contact is invalid.'));
            $this->forward ('partners_layer','ajaxListPartialLayerCompany');
        }
        $this->form = new PartnerLayerContactViewForm($request->getPostParameter('PartnerLayerContact'));  
        try
        {           
            $this->form->bind($request->getPostParameter('PartnerLayerContact'));
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                if ($this->item->isExist())
                    throw new mfException(__("Contact already exists."));
                $this->item->save();
                $messages->addInfo(__("Contact [%s] has been saved.",(string)$this->item));  
                $request->addRequestParameter('PartnerLayer', $this->item->getPartner());
                $this->forward("partners_layer","ajaxListPartnerContact");
            }    
            else
            {
                 $messages->addError(__("Form has some errors."));   
                 $this->item->add($request->getPostParameter('PartnerLayerContact')); // repopulate        
            }                  
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
