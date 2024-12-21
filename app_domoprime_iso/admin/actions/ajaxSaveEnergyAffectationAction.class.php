<?php

require_once __DIR__."/../locales/Forms/DomoprimeEnergyAffectationForm.class.php";
 
class  app_domoprime_iso_ajaxSaveEnergyAffectationAction extends mfAction {
 
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $form = new DomoprimeEnergyAffectationForm($request->getPostParameter('DomoprimeEnergyAffectation'));                    
        try
        {                       
            $form->bind($request->getPostParameter('DomoprimeEnergyAffectation'));                            
            if ($form->isValid())               
            {   
                if($form->isSameEnergy())                   
                    return array('info'=>__('Energy is already affected.'));                                 
                DomoprimeCustomerRequest::affectNewEnergy($form->getCurrentEnergy(),$form->getEnergy());
                return array('info'=>__('Energy has been affected.'));                
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));                            
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
   }

}

