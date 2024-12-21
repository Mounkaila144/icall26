<?php

require_once dirname(__FILE__)."/../locales/FormFilters/dialogListFilterContractsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DialogListFilterContractsPager.class.php";

class customers_contracts_ajaxDialogListFilterContractsAction extends mfAction {

    
    function execute(mfWebRequest $request)
    {        
       $messages = mfMessages::getInstance();          
       $this->formFilter=new dialogListFilterContractsFormFilter($this->getUser());          
      // $this->formFilter->setDefault('selected',$this->getParameter('selected'));
       $this->pager=new DialogListFilterContractsPager($this->formFilter->getObjectsForPager());
       try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
               {    
                  //  echo $this->formFilter->getQuery();
                 //  var_dump( $this->formFilter->getValues());
                    $this->pager->setQuery($this->formFilter->getQuery());                     
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry());  
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();   
                  //  echo $this->pager->getQueryForDebug();
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));      
                  //  var_dump($this->formFilter->getErrorSchema());
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }          
       // var_dump(array_keys($this->pager->getItems()));
    }     
    
}