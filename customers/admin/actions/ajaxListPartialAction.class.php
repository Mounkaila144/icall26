<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomersFormFilter.class.php";

class customers_ajaxListPartialAction extends mfAction {
	
    
    
    
    function execute(mfWebRequest $request)
    {           
      $messages = mfMessages::getInstance();      
      $this->user=$this->getUser();
      $this->formFilter= new CustomersFormFilter();
        $this->pager=new Pager('Customer');  
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute();  
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
    } 
}

