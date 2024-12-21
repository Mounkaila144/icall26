<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeStatisticOperationFormFilter.class.php";

class app_domoprime_ajaxStatisticOperationsAction extends mfAction {
    
     
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();   
        $this->user=$this->getUser();
        try
        {
            $this->formFilter=new DomoprimeStatisticOperationFormFilter($this->getUser());
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {             
              $this->formFilter->execute();
            }
            else
            {
              $messages->addError(__("Filter has some errors."));  
            //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);   
        }
        $this->settings_contracts=CustomerContractSettings::load();
       // $this->filter=new CustomerContractsFormFilter($this->user);
        //var_dump($this->formFilter['mode']->getValue());
       // var_dump($this->formFilter->getfilterToJson());
    }

}
