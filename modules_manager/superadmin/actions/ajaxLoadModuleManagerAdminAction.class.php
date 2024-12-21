<?php

class modules_manager_ajaxLoadModuleManagerAdminAction extends mfAction {
           
    function execute(mfWebRequest $request)
    {
         $messages = mfMessages::getInstance();   
         $this->form=new moduleAdminLoadForm();               
    }
}

