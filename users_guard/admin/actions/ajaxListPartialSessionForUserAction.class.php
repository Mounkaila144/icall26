<?php

require_once dirname(__FILE__)."/../locales/FormFilters/SessionForUserFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/SessionForUserPager.class.php";

class users_guard_ajaxListPartialSessionForUserAction   extends mfAction {
    
      
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();        
        $this->user=new User($request->getParameter('User'),'admin');
        if ($this->user->isNotLoaded())
            return ;
        try
        {
                $this->formFilter= new SessionForUserFormFilter();
                $this->pager=new SessionForUserPager();
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {   
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('user_id',$this->user->get('id'));
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