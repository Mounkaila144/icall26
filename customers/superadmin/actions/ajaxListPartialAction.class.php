<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomersFormFilter.class.php";

class customers_ajaxListPartialAction extends mfAction {
	
    
   
    const SITE_NAMESPACE = 'system/site';
    
    function execute(mfWebRequest $request)
    {           
      $messages = mfMessages::getInstance();   
      $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);               
      $this->forwardIf(!$this->site,"sites","Admin"); 
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
                    $this->pager->executeSite($this->site);  
                }
                else
                {
                     $messages->addErrors(array_merge($this->form->getErrorSchema()->getGlobalErrors(),
                                                      $this->form->getErrorSchema()->getErrors()));
                }  
                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
    } 
}

