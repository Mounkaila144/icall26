<?php

class userGuard_ajaxDashboardConnexionsListPartialAction  extends mfAction {
    
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $this->formFilter= new ConnexionsSuperAdminFormFilter(); 
        $this->pager=new Pager('Session');        
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {    
                    $this->pager->setQuery( $query); 
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute(); 
                }
                else
                {
                  $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                            $this->formFilter['range']['last_time']->getError()->getErrors()
                                                   ));
                }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
    }

}