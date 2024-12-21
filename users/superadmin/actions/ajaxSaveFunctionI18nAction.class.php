<?php


 require_once dirname(__FILE__)."/../locales/Forms/UserFunctionViewForm.class.php";
 
class  users_ajaxSaveFunctionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new UserFunctionViewForm($request->getPostParameter('UserFunctionI18n'),$this->site);                    
        try
        {            
            $this->item=new UserFunctionI18n($this->form->getDefault('function_i18n'),$this->site);               
            $this->form->bind($request->getPostParameter('UserFunctionI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['function_i18n']->getValues());  
                $this->item->getUserFunction()->add($this->form['function']->getValues()); 
                if ($this->item->isExist() || $this->item->getUserFunction()->isExist())
                      throw new mfException (__("Function already exists"));                                                      
                if ($this->item->isNotLoaded())
                {                                                                                       
                    $this->item->set('function_id',$this->item->getUserFunction());                                                                                                                                                                  
                }                    
                $this->item->getUserFunction()->save();
                $this->item->save();
                $messages->addInfo(__('Function has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('users','ajaxListPartialFunction');
            }   
            else
            {                    
               $messages->addError(__('form has some errors.'));                             
               $this->item->add($this->form['function_i18n']->getValues());   
               $this->item->getUserFunction()->add($this->form['function']->getValues());                
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

