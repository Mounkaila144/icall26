<?php

require_once dirname(__FILE__)."/../locales/Forms/GroupForm.class.php";

class users_guard_ajaxSaveGroupAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
         $this->forwardIf(!$this->site,"sites","ajaxAdmin"); 
        try {
            $this->form = new GroupForm();
            $this->group=new Group($request->getPostParameter('Group'),array('admin','frontend'),$this->site);
            $this->form->bind($request->getPostParameter('Group'));
            if ($this->form->isValid()) {
                if ($this->group->isExist())
                     return $messages->addError(__("Group already exists")); 
                $this->group->add($this->form->getValues());
                $this->group->save();
                $messages->addInfo(__("Group [%s] has been saved",$this->group->get('name')));
                $this->forward('users_guard','ajaxListPartialGroup');
            }
            else
            {
               $messages->addError(__("Form has some errors."));
            }    
        }       
        catch (mfException $e)
        {
           $messages->addError($e);
        }             
    }
}
  