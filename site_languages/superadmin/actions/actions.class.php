<?php

class site_languagesActions extends mfActions {
    
    const SITE_NAMESPACE = 'system/site';
     
    function executeList(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->formFilter= new languagesFormFilter();
        $this->pager=new Pager('Language');     
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$site,"sites","Admin");
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($request->getGetParameter('page'));            
                $this->pager->executeSite($site);
            }
            else
            {
              $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                                               $this->formFilter->getErrorSchema()->getErrors()));  
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
    function executeAjaxList(mfWebRequest $request) 
    {
        $this->executeList($request);
    }
    
    function executeAjaxListPartial(mfWebRequest $request) 
    {
        $this->executeList($request);
    }
    
    function executeDashboardList(mfWebRequest $request) 
    {
        $messages = mfMessages::getInstance();     
        $this->formFilter= new languagesSuperAdminFormFilter();
        $this->pager=new Pager('Language');     
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
                 $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                                               $this->formFilter->getErrorSchema()->getErrors()));  
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }            
    }
    
    function executeAjaxDashboardList(mfWebRequest $request) 
    {
        $this->executeDashboardList($request);
    }
    
     function executeAjaxDashboardListPartial(mfWebRequest $request) 
    {
        $this->executeDashboardList($request);
    }
}

