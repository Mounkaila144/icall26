<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeZoneFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeZonePager.class.php";

class app_domoprime_ajaxListPartialZoneAction extends mfAction {
	
    

    function execute(mfWebRequest $request)
    {           
      $messages = mfMessages::getInstance();   
      $this->formFilter= new DomoprimeZoneFormFilter();
        $this->pager=new DomoprimeZonePager();  
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute();  
                }                
                else
                {
                    $messages->addError(__("Filter has some errors."));
                }    
                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }        
    } 
}

