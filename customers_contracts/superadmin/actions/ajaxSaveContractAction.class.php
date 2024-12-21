<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractViewForm.class.php";



class customers_contracts_ajaxSaveContractAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
    function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                 
        $this->form= new CustomerContractViewForm(array(),$this->site);
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site);  
        if ($this->contract->isNotLoaded())
            return ;
        if ($request->isMethod('POST') && $request->getPostParameter('Contract'))
        {
            $this->form->bind($request->getPostParameter('Contract'));
            if ($this->form->isValid())
            {
                 $this->contract->add($this->form->getValues());
                 $this->contract->save();
                 $messages->addInfo(__("Contract has been saved."));
                 
            }   
            else
            {               
                $messages->addError(__("Form has some errors."));
                $this->contract->add($request->getPostParameter('Contract'));
            }
        }    
        $this->settings_contract=CustomerContractSettings::load($this->site);
    }

}
