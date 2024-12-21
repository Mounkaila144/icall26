<?php

require_once dirname(__FILE__)."/../locales/FormFilters/GroupsFormFilter.class.php";

class users_guard_ajaxListPartialGroupAction  extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_group'))))
            $this->forwardTo401Action();
        $this->formFilter= new GroupsFormFilter($request->getPostParameter('filter'));
        $this->pager=new Pager('Group');        
        $this->user=$this->getUser();
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {      
                  // echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage("*");
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute(); 
                }  
                else
                {
                    $messages->addError(__('Filter has errors.'));
                   //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }               
    }
   
}