<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerContractCompanyFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerContractCompanyPager.class.php";

class customers_contracts_ajaxListPartialCompanyAction extends mfAction{
   
    public function execute(\mfWebRequest $request) {

            $messages = mfMessages::getInstance(); 
            $this->user=$this->getUser();
            $this->formFilter= new CustomerContractCompanyFormFilter();                  
            $this->pager=new CustomerContractCompanyPager();
            try
            {       
                 $this->formFilter->bind($request->getPostParameter('filter'));
                   if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                   {                   
                  //   echo $this->formFilter->getQuery()."<br/>";
                     $this->pager->setQuery($this->formFilter->getQuery()); 
                     $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                  //   $this->pager->setParameter('lang',$this->getUser()->getCountry());    
                     $this->pager->setPage($request->getGetParameter('page'));
                     $this->pager->execute();   
                  //   echo mfSiteDatabase::getInstance()->getQuery();
                   }
            }
            catch (mfException $e)
            {          
                $messages->addError($e);
            }   
        
    }

}
