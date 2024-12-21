<?php

require_once dirname(__FILE__)."/../locales/FormFilters/SiteOversightUserActionFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/SiteOversightUserActionPager.class.php";

class site_oversight_ajaxListPartialActionAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();           
        $this->user=$this->getUser();
        $this->formFilter = new SiteOversightUserActionFormFilter();
        $this->pager = new SiteOversightUserActionPager();
        $this->user=$this->getUser();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
            }    
            else
            {
                $messages->addError(__('Filter has some errors.'));
               // var_dump($this->formFilter->getErrorSchema()->getErrorsAction());
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }

}

