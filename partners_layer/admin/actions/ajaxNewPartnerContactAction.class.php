<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLayerContactNewForm.class.php";
 

class partners_layer_ajaxNewPartnerContactAction extends mfAction {
    
        
     
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();     
        $item = new PartnerLayerCompany($request->getPostParameter('PartnerLayer')); // new object 
        if ($item->isNotLoaded())
        {
            $messages->addError(__('Partner Layer is invalid.'));
            $this->forward ('partners_layer','ajaxListPartialLayerCompany');
        }    
        $this->item = new PartnerLayerContact(); // new object
        $this->item->set('company_id',$item);
        $this->form = new PartnerLayerContactNewForm();    
        try
        {
            if ($request->isMethod('POST') && $request->getPostParameter('PartnerLayerContact'))
            {
                $this->form->bind($request->getPostParameter('PartnerLayerContact'));
                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                        throw new mfException(__("Contact already exists."));
                    $this->item->save();
                    $messages->addInfo(__("Contact [%s] has been saved",(string)$this->item));                   
                    $this->forward("partners_layer","ajaxListPartnerContact");
                }    
                else
                {
                     $messages->addError(__("Form has some errors."));   
                     $this->item->add($request->getPostParameter('PartnerLayerContact')); // repopulate        
                }    
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }

}
