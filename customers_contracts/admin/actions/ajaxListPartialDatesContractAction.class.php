<?php

require_once __DIR__."/../locales/FormFilters/CustomerContractDatesFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/CustomerContractDatesPager.class.php";

class customers_contracts_ajaxListPartialDatesContractAction extends mfAction {

   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                   
        $this->user=$this->getUser();                      
        $this->formFilter= new CustomerContractDatesFormFilter($this->getUser());                                 
        $this->pager=new CustomerContractDatesPager($this->formFilter->getObjectsForPager());                 
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
               {                                      
                // echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();              
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));     
                 //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                    SystemDebug::getInstance()->var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }      
        $this->settings_contracts=CustomerContractSettings::load();    
        if ($request->getPostParameter('filter')==null)
        {
            $engine=new CustomerContractDatesEngine();
            $engine->process();
            $messages->addInfo(__('Dates have been processed (%s contracts not valid).',$engine->getNumberOfContractNotValid()));
        }
       //  var_dump(urldecode($this->formFilter->getParametersForUrl(['equal','in','begin','search','range','rangeOr','date_install','date_sav'])));
    }
    
}    