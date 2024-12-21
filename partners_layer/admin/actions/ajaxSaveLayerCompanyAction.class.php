<?php
require_once dirname(__FILE__).'/../locales/Forms/PartnerLayerCompanyViewForm.class.php';

class partners_layer_ajaxSaveLayerCompanyAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();     
        $this->item = new PartnerLayerCompany($request->getPostParameter('PartnerLayer')); // new object       
        $this->form = new PartnerLayerCompanyViewForm($request->getPostParameter('PartnerLayer'));  
        $this->form->bind($request->getPostParameter('PartnerLayer'));
        try
        {
            if ($this->form->isValid())
            {
                
                $this->item->add($this->form->getValues()); // repopulate     
                if ($this->item->isExist())
                    throw new mfException(__("Partner layer already exists."));                                                
                $this->getEventDispather()->notify(new mfEvent( $this->item, 'partner.layer.update'));  
                $this->item->calculateCoordinates();
                $this->item->save();
                $messages->addInfo(__("Partner layer [%s] has been saved.",$this->item->get('name')));                   
                $this->forward("partners_layer","ajaxListPartialLayerCompany");
            }    
            else
            {
                 $messages->addError(__("Form has some errors."));   
                 $this->item->add($request->getPostParameter('PartnerLayer')); // repopulate               
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
    }
    
}
