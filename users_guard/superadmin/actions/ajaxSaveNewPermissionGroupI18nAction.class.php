<?php

require_once dirname(__FILE__)."/../locales/Forms/PermissionsGroupNewForm.class.php";

class users_guard_ajaxSaveNewPermissionGroupI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                                 
        try
        {      
            $this->form= new PermissionsGroupNewForm($this->getUser()->getCountry(),$request->getPostParameter('PermissionGroup'),$this->site);             
            $this->item=new PermissionGroupI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('PermissionGroup'));
            if ($this->form->isValid())
            {
                $this->item->getPermissionGroup()->add($this->form['group']->getValues());
                $this->item->add($this->form['group_i18n']->getValues());
                if ($this->item->getPermissionGroup()->isExist())
                    throw new mfException (__("Permission group already exists"));                    
                $this->item->getPermissionGroup()->save();                                                                           
                $this->item->set('group_id',$this->item->getPermissionGroup());                                    
                if ($this->item->isExist())
                    throw new mfException (__("Permission group already exists"));                                                                                                                                       
                $this->item->save();
                $messages->addInfo("Permission group has been saved.");
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('users_guard','ajaxListPartialPermissionsGroup');
            }   
            else
            {               
               // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                // Repopulate
                $this->item->add($this->form['group_i18n']->getValues());
                $this->item->getPermissionGroup()->add($this->form['group']->getValues());
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
