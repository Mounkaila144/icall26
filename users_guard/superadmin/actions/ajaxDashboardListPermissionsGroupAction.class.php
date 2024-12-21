<?php

require_once dirname(__FILE__)."/../locales/FormFilters/GroupPermissionsSuperAdminFormFilter.class.php";

class users_guard_ajaxDashboardListPermissionsGroupAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $this->formFilter= new GroupPermissionsSuperAdminFormFilter();
        $this->pager=new Pager('GroupPermission');   
        try
        {
                $this->group=$request->getRequestParameter('group', new Group($request->getPostParameter('group')));
                $this->formFilter->bind($request->getPostParameter('filter'));     
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery(),$this->group->get('id'));
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