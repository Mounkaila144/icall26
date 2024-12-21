<?php

class sites_ajaxDialogListFilterMultipleSitesAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();          
        $this->formFilter= new dialogListFilterMultipleSitesFormFilter($request->getPostParameter('filter'));                 
        $this->pager=new Pager('site');
        try
        {            
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->executeSuperAdmin();                           
                }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
    }
}    