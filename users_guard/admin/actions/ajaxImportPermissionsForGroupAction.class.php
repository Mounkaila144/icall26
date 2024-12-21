<?php

require_once __DIR__."/../locales/Forms/ImportExistingGroupForm.class.php";
require_once __DIR__."/../locales/Imports/ImportPermissionsForGroupProcess.class.php";

class users_guard_ajaxImportPermissionsForGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();       
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_import_permissions_group'))))
            $this->forwardTo401Action();
        $this->form=new ImportExistingGroupForm($request->getPostParameter('ImportGroup'));
        $this->group=new Group($request->getPostParameter('Group'),'admin') ;
        if ($this->group->isNotLoaded() || !$request->getPostParameter('ImportGroup'))
            return ; 
        try
        {            
            $this->form->bind($request->getPostParameter('ImportGroup'),$request->getFiles('ImportGroup'));
            if ($this->form->isValid())
            {               
                if ($this->group->isLoaded())
                {
                    $csv= new ImportPermissionsForGroupProcess($this->group,$this->form->getFile());
                    $csv->process();
                    $this->getEventDispather()->notify(new mfEvent($csv,'user.guard.group.permissions.import'));
                    $messages->addInfo(__('Permissions has been imported in group [%s].',$this->group->get('name')));
                //    $this->forward($this->getModuleName(),'ajaxListPartialGroup');
                }
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
    }

}
