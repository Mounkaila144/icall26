<?php

class users_guard_ajaxGroupsListAction  extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
                      
        $this->formFilter= new GroupsFormFilter();
        $this->pager=new Pager('Group');        
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
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }               
    }
   
}