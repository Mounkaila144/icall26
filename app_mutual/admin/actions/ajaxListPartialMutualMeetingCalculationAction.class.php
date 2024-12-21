<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MutualMeetingCalculationFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MutualMeetingCalculationPager.class.php";

class app_mutual_ajaxListPartialMutualMeetingCalculationAction extends mfAction {
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();      
        $this->formFilter = new MutualMeetingCalculationFormFilter();                  
        $this->pager = new MutualMeetingCalculationPager();
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
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }
    
}    