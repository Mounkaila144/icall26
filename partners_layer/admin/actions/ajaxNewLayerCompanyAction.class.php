<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerLayerCompanyNewForm.class.php";


class partners_layer_ajaxNewLayerCompanyAction extends mfAction{
    
    function execute(mfWebRequest $request){              
        $messages = mfMessages::getInstance();      
        $this->item = new PartnerLayerCompany();
        $this->form = new PartnerLayerCompanyNewFom($request->getPostParameter('PartnerLayer'));      
        if ($request->getPostParameter('PartnerLayer'))
        {
            try {
                $this->form->bind($request->getPostParameter('PartnerLayer'));
                if ($this->form->isValid()){                        
                    $this->item->add($this->form->getValues());
                    if ($this->item->isExist())
                       throw new mfException (__("Partner Layer already exists"));                                                                             
                    $this->item->calculateCoordinates();
                    $this->item->save();                    
                    $messages->addInfo(__("Partner Layer [%s] has been saved.",array($this->item->get('name'))));                   
                    $this->forward("partners_layer","ajaxListPartialLayerCompany");
                }
                else
                {
                 //  echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo'</pre>';
                   $messages->addError(__("Form has some errors."));   
                   $this->item->add($this->form->getValues()); // repopulate                
                }    
            } 
            catch (mfException $e)
            {
               $messages->addError($e);
            }  
        }    
    }
}
