<?php

class site_dialogListFilterMultipleSitesActionComponent extends mfActionComponent {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();          
        $this->formFilter= new dialogListFilterMultipleSitesFormFilter(array("selected"=>(array)$this->getParameter('selected')));                 
        $this->pager=new Pager('site');
        try
        {
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->executeSuperAdmin();                           
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }
}    