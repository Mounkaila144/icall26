<?php


 require_once dirname(__FILE__)."/../locales/Forms/PermissionsGroupViewForm.class.php";
 
class  users_guard_ajaxSavePermissionGroupI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
   
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new PermissionsGroupViewForm($request->getPostParameter('PermissionGroupI18n'),$this->site);                    
        try
        {            
            $this->item=new PermissionGroupI18n($this->form->getDefault('group_i18n'),$this->site);               
            $this->form->bind($request->getPostParameter('PermissionGroupI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['group_i18n']->getValues());
                $this->item->getPermissionGroup()->add($this->form['group']->getValues());  
                if ($this->item->getPermissionGroup()->isExist() || $this->item->isExist())
                            throw new mfException (__("Permission group already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('group_id',$this->item->getPermissionGroup());                                                                                                                                                                 
                }         
                $this->item->getPermissionGroup()->save();
                $this->item->save();
                $messages->addInfo(__('Permission group has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('users_guard','ajaxListPartialPermissionsGroup');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item->getPermissionGroup()->add($this->form['group']->getValues());
               $this->item->add($this->form['group_i18n']->getValues());   
              // var_dump($this->form->getErrorSchema());
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

