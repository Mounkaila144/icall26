<?php

require_once dirname(__FILE__)."/../locales/Forms/SystemMenuPositionsForm.class.php";

class dashboard_ajaxPositionsMenuAction extends mfAction {
    
       
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();       
     //   $this->form = new SystemMenuViewForm();
        $this->item_i18n=new SystemMenuI18n($request->getPostParameter('SystemMenuI18n'));      
       // echo "<pre>";var_dump($this->item_i18n->getMenu()->getChilds());  echo "</pre>";      
        $this->form=new SystemMenuPositionsForm($request->getPostParameter('SystemMenuPositions'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('SystemMenuPositions'))
            return ;       
        $this->form->bind($request->getPostParameter('SystemMenuPositions'));
        if ($this->form->isValid())
        {           
           // AppAdsUserAdvertFeature::updatePositions($this->form->getPositions());
            
            var_dump($this->form->getPositions());
            
            $messages->addInfo(__('Categories have been updated.'));                     
            $this->forward($this->getModuleName(),'advert/ajaxListPartialCategory');
        }  
        else 
        {
            //  echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
             $messages->addError(__('Form has some errors.'));      
        } 
    }
    
}