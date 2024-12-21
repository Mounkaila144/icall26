<?php


 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeClassViewForm.class.php";
 
class  app_domoprime_ajaxSaveClassI18nAction extends mfAction {
    
   
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new DomoprimeClassViewForm($this->getUser(),$request->getPostParameter('DomoprimeClassI18n'));                    
        try
        {            
            $this->item_i18n=new DomoprimeClassI18n($this->form->getDefault('class_i18n'));               
            $this->form->bind($request->getPostParameter('DomoprimeClassI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['class_i18n']->getValues());
                $this->item_i18n->getClass()->add($this->form['class']->getValues());  
                if ($this->item_i18n->getClass()->isExist() || $this->item_i18n->isExist())
                            throw new mfException (__("Class already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                
                {                           
                    $this->item_i18n->set('class_id',$this->item_i18n->getClass());                                                                                                                                                                
                }         
                $this->item_i18n->getClass()->save();
                $this->item_i18n->save();
                $messages->addInfo(__('Class has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('app_domoprime','ajaxListPartialClass');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item_i18n->getClass()->add($this->form['class']->getValues());
               $this->item_i18n->add($this->form['class_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

