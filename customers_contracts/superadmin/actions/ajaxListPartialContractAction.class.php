<?php

//require_once dirname(__FILE__)."/../locales/FormFilters/CustomerContractsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerContractsPager.class.php";

class customers_contracts_ajaxListPartialContractAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    
   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();               
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");             
        $this->formFilter= new CustomerContractsFormFilter($this->getUser(),$this->site);            
        $this->pager=new CustomerContractsPager($this->formFilter->getObjectsForPager());                 
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
               {    
                   // echo $this->formFilter->getQuery();
                 //  var_dump( $this->formFilter->getValues());
                    $this->pager->setQuery($this->formFilter->getQuery());                     
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry());  
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->executeSite($this->site);              
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));
                  //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                   // var_dump($this->formFilter['in']->getErrors());
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }          
     //    $this->turnover=CustomerContractUtils::getTurnover($this->site);
         $this->settings_contracts=CustomerContractSettings::load($this->site);      
    }
    
}    