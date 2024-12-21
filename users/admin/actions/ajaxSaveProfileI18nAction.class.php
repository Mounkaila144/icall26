<?php


 require_once dirname(__FILE__)."/../locales/Forms/UserProfileViewForm.class.php";
 
class  users_ajaxSaveProfileI18nAction extends mfAction {
    
    
    
  
        
    function execute(mfWebRequest $request) {                   
        $messages = mfMessages::getInstance();                         
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_profile_view'))))
           $this->forwardTo401Action();
        try
        {            
            $this->form = new UserProfileViewForm($request->getPostParameter('UserProfileI18n'));
            $this->item_i18n=new UserProfileI18n($this->form->getDefault('profile_i18n'));   
            $this->form->setProfile($this->item_i18n->getProfile());
            $this->form->bind($request->getPostParameter('UserProfileI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['profile_i18n']->getValues());  
                $this->item_i18n->getProfile()->add($this->form['profile']->getValues()); 
                if (  $this->item_i18n->isExist() || $this->item_i18n->getProfile()->isExist())
                      throw new mfException (__("Profile already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())
                {                                                                                       
                    $this->item_i18n->set('profile_id',$this->item_i18n->getProfile());                                                                                                                                                                  
                }                    
                $this->item_i18n->getProfile()->save();
                $this->item_i18n->save();
                $this->item_i18n->getProfile()->updateFunctionsAndGroups($this->form->getFunctions(),$this->form->getGroups());                                         
                $messages->addInfo(__('Profile has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('users','ajaxListPartialProfile');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));                             
               $this->item_i18n->add($this->form['profile_i18n']->getValues());   
               $this->item_i18n->getUserProfile()->add($this->form['profile']->getValues());                
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

