<?php

require_once __DIR__."/../locales/Forms/DomoprimeEnergyAffectationForm.class.php";

class app_domoprime_iso_ajaxAffectToContractAction extends mfAction {
           
    function execute(mfWebRequest $request) {      
      $messages = mfMessages::getInstance();        
      $this->item =new DomoprimeEnergy($request->getPostParameter('DomoprimeEnergy'));
      if ($this->item->isNotLoaded())
          return ;
      $this->form = new DomoprimeEnergyAffectationForm();
     //  var_dump($this->item->getI18n()->get('value'));
    }
}

