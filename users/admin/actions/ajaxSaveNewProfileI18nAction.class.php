<?php

require_once dirname(__FILE__)."/../locales/Forms/UserProfileNewForm.class.php";

class users_ajaxSaveNewProfileI18nAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_users_profile_new'))))
           $this->forwardTo401Action();
        try
        {      
            $this->form= new UserProfileNewForm($this->getUser()->getCountry(),$request->getPostParameter('UserProfile'));             
            $this->item_i18n=new UserProfileI18n();
            $this->form->bind($request->getPostParameter('UserProfile'));
            if ($this->form->isValid())
            {               
                $this->item_i18n->add($this->form['profile_i18n']->getValues());   
                $this->item_i18n->getProfile()->add($this->form['profile']->getValues());   
                $this->item_i18n->getProfile()->save();                                                                            
                $this->item_i18n->set('profile_id',$this->item_i18n->getProfile());                                    
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Profile already exists"));                                                                                                                                       
                $this->item_i18n->save();
                $this->item_i18n->getProfile()->updateFunctionsAndGroups($this->form->getFunctions(),$this->form->getGroups());                                         
                $messages->addInfo(__("Profile has been saved."));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('users','ajaxListPartialProfile');
            }   
            else
            {               
                // Repopulate
              //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $this->item_i18n->add($this->form['profile_i18n']->getValues());   
                $this->item_i18n->getProfile()->add($this->form['profile']->getValues());   
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
