<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerUnionViewForm.class.php";
 
class  customers_ajaxSaveUnionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';       
        
    function execute(mfWebRequest $request) {             
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);    
        $this->forwardIf(!$this->site,"sites","Admin");
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerUnionViewForm($request->getPostParameter('CustomerUnionI18n'),$this->site);                    
        try
        {            
            $this->item=new CustomerUnionI18n($this->form->getDefault('union_i18n'),$this->site);               
            $this->form->bind($request->getPostParameter('CustomerUnionI18n'),$request->getFiles('CustomerUnionI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['union_i18n']->getValues());
                $this->item->getCustomerUnion()->add($this->form['union']->getValues());  
                if ($this->item->getCustomerUnion()->isExist() || $this->item->isExist())
                     throw new mfException (__("union already exists"));                                                                            
                $this->item->getCustomerUnion()->save();
                $this->item->save();
                $messages->addInfo(__('Union has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers','ajaxListPartialUnion');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item->getCustomerUnion()->add($this->form['union']->getValues());
               $this->item->add($this->form['union_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
   }

}

