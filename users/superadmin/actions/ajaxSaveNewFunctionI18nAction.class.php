<?php

require_once dirname(__FILE__)."/../locales/Forms/UserFunctionNewForm.class.php";

class users_ajaxSaveNewFunctionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                                 
        try
        {      
            $this->form= new UserFunctionNewForm($this->getUser()->getCountry(),$request->getPostParameter('UserFunction'),$this->site);             
            $this->user_function_i18n=new UserFunctionI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('UserFunction'));
            if ($this->form->isValid())
            {               
                $this->user_function_i18n->add($this->form['function_i18n']->getValues());   
                $this->user_function_i18n->getUserFunction()->add($this->form['function']->getValues());   
                $this->user_function_i18n->getUserFunction()->save();                                                                            
                $this->user_function_i18n->set('function_id',$this->user_function_i18n->getUserFunction());                                    
                if ($this->user_function_i18n->isExist())
                    throw new mfException (__("Function already exists"));                                                                                                                                       
                $this->user_function_i18n->save();
                $messages->addInfo("function has been saved.");
                $request->addRequestParameter('lang',$this->user_function_i18n->get('lang'));
                $this->forward('users','ajaxListPartialFunction');
            }   
            else
            {               
                // Repopulate
                $this->user_function_i18n->add($this->form['function_i18n']->getValues());   
                $this->user_function_i18n->getUserFunction()->add($this->form['function']->getValues());   
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
