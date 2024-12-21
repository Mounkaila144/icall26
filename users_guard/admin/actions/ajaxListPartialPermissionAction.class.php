<?php

require_once dirname(__FILE__)."/../locales/FormFilters/PermissionsFormFilter.class.php";

class users_guard_ajaxListPartialPermissionAction   extends mfAction {
    
      
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();                        
        try
        {            
              if (!$this->getUser()->hasCredential(array(array('superadmin','settings_user_permissions'))))
                    $this->forwardTo401Action();
                $this->formFilter= new PermissionsFormFilter();
                $this->pager=new Pager('Permission');
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