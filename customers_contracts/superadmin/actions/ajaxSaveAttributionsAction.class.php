<?php

 require_once dirname(__FILE__)."/../locales/Forms/CustomerAttributionsForm.class.php";



class customers_contracts_ajaxSaveAttributionsAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
  /*  function preExecute()
    {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }*/
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$this->site,"site","Admin");                        
        $this->contract=new CustomerContract($request->getPostParameter('Contract'),$this->site); 
        if ($this->contract->isNotLoaded())
            return ;
        $this->form= new CustomerAttributionsForm(array(),$this->site);    
        if ($request->isMethod('POST') && $request->getPostParameter('Attributions'))
        {
            $this->form->bind($request->getPostParameter('Attributions'));
            if ($this->form->isValid())
            {              
                foreach ($this->contract->getContributors() as $contributor)
                {                   
                    $contributor->add($this->form->getContributor($contributor->get('type')));                                    
                    $contributor->save();
                    $this->contract->set($contributor->get('type')."_id",(int)$contributor->get('user_id'));
                }    
                $this->contract->set('team_id',(string)$this->form['team_id']);
                $this->contract->save();
                $messages->addInfo(__("Attributions have been updated."));                
                $this->forward('customers_contracts', 'ajaxListAttributions');
            }   
            else
            {
                 //  var_dump($this->form->getErrorSchema()-> getErrorsMessage());
                  $messages->addError(__("Form has some errors."));
            }    
        }    
    }

}
