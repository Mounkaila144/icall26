<?php

require_once dirname(__FILE__).'/../locales/FormFilters/SessionFormFilter.class.php';
require_once dirname(__FILE__).'/../locales/Pagers/SessionPager.class.php';

class users_guard_ajaxDashboardListPartialSessionAction extends mfAction{
    
    function execute(mfWebRequest $request){
        
        $messages = mfMessages::getInstance();        
        try
        {
            $this->formFilter= new SessionFormFilter();
            $this->pager=new SessionPager();
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {   
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($this->request->getGetParameter('page'));
                $this->pager->execute();  
            }
            else {
                
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }   
}
