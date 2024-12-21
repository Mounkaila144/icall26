<?php


 require_once dirname(__FILE__)."/../locales/Forms/SystemMenuViewForm.class.php";
 
class  dashboard_ajaxSaveSystemMenuI18nAction extends mfAction {
    
   
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new SystemMenuViewForm($request->getPostParameter('SystemMenuI18n'));     
        try
        {        
            $this->item_i18n=new SystemMenuI18n($this->form->getDefault('menu_i18n')); 
           //  echo "<pre>---";  var_dump($this->item_i18n->get('menu_id'));echo "</pre>";
            $this->form->bind($request->getPostParameter('SystemMenuI18n'));            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['menu_i18n']->getValues());
                //var_dump($this->item_i18n);
                $this->item_i18n->getMenu()->add($this->form['menu']->getValues());  
                if ($this->item_i18n->isExist())
                           
                            throw new mfException (__("Menu already exists"));                                                      
                                        
                $this->item_i18n->set('menu_id',$this->item_i18n->get('menu_id'));                                                                                                                                                             
                
              
                 
                $this->item_i18n->save();
                
                $messages->addInfo(__("Menu [%s] has been saved.",$this->item_i18n->get('value')));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $this->forward('dashboard','ajaxListMenu');
            }   
            else
            {      
                echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
               $messages->addError(__('form has some errors.'));              
              // $this->item_i18n->getStatus()->add($this->form['menu']->getValues());
               $this->item_i18n->add($this->form['menu_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):array('action'=>'SaveSystemMenuI18n');
   }

}

