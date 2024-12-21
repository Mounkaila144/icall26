<?php


class sitesActions extends mfActions {
    
    function executeList(mfWebRequest $request) {    
        $messages=mfMessages::getInstance();  
        $this->formFilter= new SitesFormFilter();
        $this->pager=new Pager('Site');     
        try 
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
           
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
                $this->pager->setQuery($this->formFilter->getQuery());               
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($this->request->getGetParameter('page'));
                $this->pager->executeSuperAdmin();
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
        $this->action_item=ActionsManager::getInstance("sites.list.action_item")->getActions();  
        $this->actions=ActionsManager::getInstance("sites.list.actions")->getActions();        
        
    }
    
    
   function executeAjaxList(mfWebRequest $request) {       
        $this->executeList($request);
    }
    
}


