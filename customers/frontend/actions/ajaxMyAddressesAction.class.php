<?php


require_once dirname(__FILE__)."/../locales/FormFilters/MyAddressesFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MyAddressesPager.class.php";



class customers_ajaxMyAddressesAction extends mfAction {
    
     
    function execute(mfWebRequest $request) {                  
         if (!$this->getUser()->isAuthenticated() || !$this->getUser()->isCustomerUser())             
            $this->forwardTo401Action();
        $messages = mfMessages::getInstance();     
        $this->user=$this->getUser();
        $this->formFilter= new MyAddressesFormFilter();                  
        $this->pager=new MyAddressesPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                     
                $this->pager->setParameter('user_id',$this->user->getGuardUser()->get('id'));  
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
       // var_dump($this->pager[0]);
    }          
    
   
}


