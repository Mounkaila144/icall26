<?php
require_once dirname(__FILE__).'/../locales/Forms/TabPositionsForm.class.php';


class dashboard_ajaxPositionTabAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
         $messages= mfMessages::getInstance();
         $this->tabs=SystemTab::load('dashboard.site')->loadI18n()->getSystemTabs()->getAll();                          
         $this->form=new TabPositionsForm($request->getPostParameter('TabPositions'));
         if (!$request->isMethod('POST') || !$request->getPostParameter('TabPositions')) 
             return ;         
         $this->form->bind($request->getPostParameter('TabPositions'));
         if ($this->form->isValid())
         {
             SystemTab::updatePositions('dashboard.site',$this->form->getPositions(),$this->tabs);
                         
             $messages->addInfo(__('Tabs positions have been updated.'));
             //$request->addRequestParameter('product', $this->product);
             //$this->forward($this->getModuleName(), 'ajaxListPartialItemMasterSlave');
         }   
         else
         {
             $messages->addError(__('Form has some errors.'));
           //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
         }  
    }

}
