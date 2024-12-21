<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionsForm.class.php";

class users_ajaxViewUserFunctionAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();               
        $this->user=$this->getUser();
        $this->item=new User($request->getPostParameter('User'),'admin');  
        $this->form = new UserFunctionsForm(array('selection'=>$this->item->getFunctionsId()));      
        $this->functions=UserFunctionBaseUtils::getFieldValuesForI18nSelect('value',$this->getUser()->getCountry());        
    }

}
