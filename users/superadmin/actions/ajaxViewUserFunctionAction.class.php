<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionsForm.class.php";

class users_ajaxViewUserFunctionAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
       
    function execute(mfWebRequest $request) {                        
        $messages = mfMessages::getInstance();        
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->user=new User($request->getPostParameter('User'),'admin',$this->site);  
        $this->form = new UserFunctionsForm(array('selection'=>$this->user->getFunctionsId()),$this->site);      
        $this->functions=UserFunctionBaseUtils::getFieldValuesForI18nSelect('value',$this->getUser()->getCountry(),$this->site);        
    }

}
