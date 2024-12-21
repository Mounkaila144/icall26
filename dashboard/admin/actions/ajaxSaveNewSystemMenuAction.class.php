<?php


 require_once dirname(__FILE__)."/../locales/Forms/SystemMenuNewForm.class.php";
 
class  dashboard_ajaxSaveNewSystemMenuAction extends mfAction {
    
   function execute(mfWebRequest $request) { 
        
        $messages = mfMessages::getInstance();              
        $this->form = new SystemMenuNewForm($request->getPostParameter('SystemMenuNode'));     
        try
        {        
            $this->item=new SystemMenu();
            $this->item_i18n=new SystemMenuI18n();
            $this->form->bind($request->getPostParameter('SystemMenuNode'));            
            if ($this->form->isValid())
            {        
                $this->item->add($this->form['menu']->getValues());       
                $this->item_i18n->add($this->form['menu_i18n']->getValues());
                if ($this->item->isExist())
                    throw new mfException (__("Menu already exists"));                  
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Title already exists"));          
                $this->item->set('type','USER');
                if($this->form->hasParent())
                {
                  $this->node = $this->form->getParent();  
                  $this->item->at($this->node)->asFirstChild()->save(); 
                }
                else
                {
                  $this->item->save();
                }               
                $this->item_i18n->set('menu_id',$this->item);
                $this->item_i18n->save();
                $messages->addInfo(__("Menu [%s] has been saved.",$this->item->get('name')));
                $this->forward('dashboard','ajaxListMenu');
            }   
            else
            {      
               
            //   echo "<pre>";var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
               $messages->addError(__('form has some errors.'));              
               $this->item_i18n->add($this->form['menu_i18n']->getValues());
               $this->item->add($this->form['menu']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
       return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):array("action"=>"SaveNewSystemMenu");
   }

}

