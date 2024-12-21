<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ProductActionsFormFilter.class.php";

class products_ajaxListPartialActionAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->formFilter= new ProductActionsFormFilter($this->site);
        $this->pager=new Pager('ProductAction');
         try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->executeSite($this->site);              
               }                 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
    }
    
}    