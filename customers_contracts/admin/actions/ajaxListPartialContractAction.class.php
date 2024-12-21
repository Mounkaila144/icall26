<?php

require_once dirname(__FILE__)."/../locales/Pagers/CustomerContractsPager.class.php";

class customers_contracts_ajaxListPartialContractAction extends mfAction {

   
        
    function execute(mfWebRequest $request) {
       
        $messages = mfMessages::getInstance();   
          $time_in = microtime(true);
        $this->user=$this->getUser();                      
        $this->formFilter= new CustomerContractsFormFilter($this->getUser(),$request->getPostParameter('filter'));              
        $this->pager=new CustomerContractsPager($this->formFilter); //->getObjectsForPager(),$this->formFilter->getAlias());                 
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
                //   var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                    SystemDebug::getInstance()->var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
         //   echo "<pre>"; var_dump($e-> getTraceAsString());
        }      
         $this->settings_contracts=CustomerContractSettings::load();           
       //  var_dump(urldecode($this->formFilter->getParametersForUrl(['equal','in','begin','search','range','rangeOr','date_install','date_sav'])));
       //  $this->pager->getNumberOfIsDocuments();
         $this->formFilter->updateColumns();    
        // echo "Time=".(microtime(true)-$time_in); 
       //  var_dump($this->formFilter['cols']->getValue());        
       //  echo "<pre>"; var_dump($this->pager->getItems());
         
       //  var_dump($messages->getDecodedMessages());
       //  var_dump($this->formFilter->order['surface_home']->getCHoices());
         //  var_dump($this->formFilter->order->hasValidator('surface_home'));
        //  die(__METHOD__);
    }
    
}    