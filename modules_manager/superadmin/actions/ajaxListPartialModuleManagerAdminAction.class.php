<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ModuleManagerAdminFormFilter.class.php";

class modules_manager_ajaxListPartialModuleManagerAdminAction extends mfAction {

    
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->formFilter= new ModuleManagerAdminFormFilter();
                $this->pager=new Pager('moduleManagerAdmin');
                try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                
        }
        catch (Exception $e)
        {
            $messages->addError($e);
        }        
    }
    
}   