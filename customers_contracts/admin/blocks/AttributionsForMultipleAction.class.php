<?php

require_once __DIR__."/../locales/Forms/AttributionsMultipleForm.class.php";

class customers_contracts_AttributionsForMultipleActionComponent extends mfActionComponent {

 
    function execute(mfWebRequest $request)
    {          
        if (!$this->getUser()->hasCredential(array(array('superadmin','contract_attributions_multiple'))))
                return mfView::NONE;
        $this->attributions_form=new AttributionsMultipleForm($this->getUser(),$this->getParameter('form')->getSelection());
     //   var_dump($this->attributions_form->team['attribution_id']);
    //    var_dump(get_class($this->attributions_form->getValidatorByType('team','attribution_id')));
    } 
    
    
}