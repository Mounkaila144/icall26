<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UserGroupsSuperAdminFormFilter.class.php";

class users_ajaxDashboardGroupsListAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();
        $this->formFilter= new UserGroupsSuperAdminFormFilter();
        $this->pager=new Pager('UserGroup');   
        try
        {
                $this->user=$request->getRequestParameter('user', new User($request->getPostParameter('user')));
                $this->formFilter->bind($request->getPostParameter('filter'));     
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery(),$this->user->get('id'));
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