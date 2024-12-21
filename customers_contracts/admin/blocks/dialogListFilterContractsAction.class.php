<?php

require_once dirname(__FILE__)."/../locales/FormFilters/dialogListFilterContractsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DialogListFilterContractsPager.class.php";

class customers_contracts_dialogListFilterContractsActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                               
       $this->formFilter=new dialogListFilterContractsFormFilter($this->getUser());          
       $this->formFilter->setDefault('selected',$this->getParameter('selected'));       
       $this->pager=new DialogListFilterContractsPager($this->formFilter->getObjectsForPager());
       try
       {                             
               $this->pager->setQuery($this->formFilter->getQuery()); 
               $this->pager->setNbItemsByPage((string)$this->formFilter['nbitemsbypage']);    
               $this->pager->setParameter('lang',$this->getUser()->getCountry());  
               $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
               $this->pager->setPage($request->getGetParameter('page'));                
               $this->pager->executeSite($this->getParameter('site'));      
        }
        catch (mfException $e)
        {
            $this->getMessage()->addError($e);           
        }    
      //  var_dump($this->pager->getItems());
    }     
    
}