<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UserGroupsFormFilter.class.php";

class users_ajaxGroupsListAction  extends mfAction {
    
     
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->formFilter= new UserGroupsFormFilter();
        $this->pager=new Pager('UserGroup');   
        try
        {                
                $this->item=$request->getRequestParameter('User', new User($request->getPostParameter('User'),'admin'));
                if ($this->item->isNotLoaded())
                   return ;
                $this->formFilter->bind($request->getPostParameter('filter'));     
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery(),$this->item->get('id'));
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute('admin'); 
                }                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }             
    }

}