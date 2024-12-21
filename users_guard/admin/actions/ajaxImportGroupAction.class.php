<?php

require_once __DIR__."/../locales/Forms/ImportGroupForm.class.php";
require_once __DIR__."/../locales/Imports/ImportGroupProcess.class.php";

class users_guard_ajaxImportGroupAction extends mfAction {
    
    
       
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();    
         if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_import_group'))))
            $this->forwardTo401Action();
        $this->form=new ImportGroupForm($request->getPostParameter('ImportGroup'));
        if (!$request->getPostParameter('ImportGroup'))
            return ;
        try
        {
            $this->form->bind($request->getPostParameter('ImportGroup'),$request->getFiles('ImportGroup'));
            if ($this->form->isValid())
            {
                $group=new Group(null,'admin');
                $group->add($this->form->getValues());
                if ($group->isExist())
                      throw new mfException(__('Group already exists.'));
                $group->save();
                $csv= new ImportGroupProcess($group,$this->form->getFile());
                $csv->process();
                $messages->addInfo(__('Group [%s] has been imported.',$this->form->getValue('name')));
                $this->getEventDispather()->notify(new mfEvent($csv,'user.guard.group.import'));
                $this->forward('users_guard','ajaxListPartialGroup');
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
