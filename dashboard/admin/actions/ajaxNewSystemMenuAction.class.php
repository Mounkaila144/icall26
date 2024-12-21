<?php
require_once dirname(__FILE__)."/../locales/Forms/SystemMenuNodeForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/SystemMenuNewForm.class.php";
class dashboard_ajaxNewSystemMenuAction extends mfAction {
    
    
    
     function execute(mfWebRequest $request) {
      
        $messages = mfMessages::getInstance(); 
        $form=new SystemMenuNodeForm();
       
        $form->bind($request->getPostParameter('SystemMenuNode'));
   //    echo "<pre>"; var_dump($form->getValues());echo "</pre>";
        if (!$form->isValid())
        {
           // var_dump($form->getErrorSchema()->getErrorsMessage());
            $messages->addError(__("Language is not valid."));
            $this->forward($this->getModuleName(),'ajaxListPartialMenu');  
        }             
        $this->item_i18n=new SystemMenuI18n(array('lang'=>$form->getLanguage())); 
        $this->item=new SystemMenu();
        $this->form = new SystemMenuNewForm();   
        $this->node = $form->getNode();      
       // echo "<pre>"; var_dump($form->getNode());echo "</pre>";
                      
        // $this->form = new SystemMenuNewForm($form->getNode(),$form->getLanguage());           
    }
}
