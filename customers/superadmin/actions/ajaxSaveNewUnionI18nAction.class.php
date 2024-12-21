<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerUnionNewForm.class.php";

class customers_ajaxSaveNewUnionI18nAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
            
    function execute(mfWebRequest $request) {                      
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                                 
        try
        {      
            $this->form= new CustomerUnionNewForm($this->getUser()->getCountry(),$request->getPostParameter('CustomerUnion'),$this->site);             
            $this->item=new CustomerUnionI18n(null,$this->site);
            $this->form->bind($request->getPostParameter('CustomerUnion'),$request->getFiles('CustomerUnion'));
            if ($this->form->isValid())
            {
                $this->item->getCustomerUnion()->add($this->form['union']->getValues());
                $this->item->add($this->form['union_i18n']->getValues());
                if ($this->item->getCustomerUnion()->isExist())
                    throw new mfException (__("Union already exists"));                   
                $this->item->getCustomerUnion()->save();                                                                           
                $this->item->set('union_id',$this->item->getCustomerUnion());                                    
                if ($this->item->isExist())
                    throw new mfException (__("status already exists"));                                                                                                                                       
                $this->item->save();
                $messages->addInfo("file has been saved.");
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers','ajaxListPartialUnion');
            }   
            else
            {               
                // Repopulate
                $this->item->add($this->form['union_i18n']->getValues());
                $this->item->getCustomerUnion()->add($this->form['union']->getValues());
                $messages->addError("form has some errors."); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }

}
