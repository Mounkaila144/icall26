<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UserGroupsFormFilter.class.php";

class users_ajaxGroupsListAction  extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
    
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);         
        $this->formFilter= new UserGroupsFormFilter();
        $this->pager=new Pager('UserGroup');   
        try
        {                
                $this->user=$request->getRequestParameter('User', new User($request->getPostParameter('User'),'admin',$this->site));
                if ($this->user->isNotLoaded())
                   return ;
                $this->formFilter->bind($request->getPostParameter('filter'));     
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery(),$this->user->get('id'));
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute('admin',$this->site); 
                }                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }             
    }

}