<?php

class users_ajaxDashboardAllPermissionsListAction  extends mfAction {
    
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $this->formFilter= new AllPermissionsSuperAdminFormFilter();
        $this->pager=new Pager('Permission');   
        try
        {
                $this->user=new User($request->getPostParameter('user'));
                $this->formUsersGroupsPermissions=new usersGroupsPermissionsForm(); // Just to get token
                $this->formFilter->bind($request->getPostParameter('filter'));     
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery(),array("user_id"=>$this->user->get('id',0)));
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

}