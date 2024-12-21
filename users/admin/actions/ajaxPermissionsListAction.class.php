<?php

class users_ajaxPermissionsListAction  extends mfAction {
    
     
       
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->formFilter= new UserPermissionsFormFilter();
        $this->pager=new Pager('UserPermission');   
        try
        {
            $this->item=$request->getRequestParameter('User', new User($request->getPostParameter('User'),'admin'));
            $this->formFilter->bind($request->getPostParameter('filter'));     
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {                       
                $this->pager->setQuery($this->formFilter->getQuery(),$this->item->get('id'));
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($this->request->getGetParameter('page'));
                $this->pager->execute($this->item->get('application')); 
            }               
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
    }

}