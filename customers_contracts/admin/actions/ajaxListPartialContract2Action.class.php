<?php

require_once dirname(__FILE__)."/../locales/Pagers/CustomerContractPager2.class.php";

class customers_contracts_ajaxListPartialContract2Action extends mfAction {

   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();    
      //  $time_in = microtime(true);
        $this->user=$this->getUser();                      
        $this->formFilter= new CustomerContractsFormFilter2($this->getUser(),$request->getPostParameter('filter'));              
        $this->pager=new CustomerContractPager2($this->formFilter); //->getObjectsForPager(),$this->formFilter->getAlias());                 
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
               {                                      
                   //  echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();        
                   //  echo mfSiteDatabase::getInstance()->getQuery();
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));     
                  // var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                    SystemDebug::getInstance()->var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }      
         $this->settings_contracts=CustomerContractSettings::load();           
       //  var_dump(urldecode($this->formFilter->getParametersForUrl(['equal','in','begin','search','range','rangeOr','date_install','date_sav'])));
       //  $this->pager->getNumberOfIsDocuments();
         $this->formFilter->updateColumns();    
      // echo mfSiteDatabase::getInstance()->getCountQuery()  ;
       //  var_dump($this->formFilter['cols']->getValue());
       // echo "<pre>";  echo "=====".var_dump($this->pager->getItems()); echo "=====";
      // echo "Time=".(microtime(true)-$time_in);
       // die(__METHOD__);
    }
    
}    