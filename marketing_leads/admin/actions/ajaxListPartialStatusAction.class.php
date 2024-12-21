<?php

require_once dirname(__FILE__)."/../locales/FormFilters/MarketingLeadsWpFormsStatusFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/MarketingLeadsWpFormsStatusPager.class.php";

class marketing_leads_ajaxListPartialStatusAction extends mfAction {

    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->formFilter = new MarketingLeadsWpFormsStatusFormFilter($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getLanguage())));                  
        $this->pager = new MarketingLeadsWpFormsStatusPager();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
//                echo $this->formFilter->getQuery()."<br />";
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',(string)$this->formFilter['lang']);                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute(); 
//                echo $this->pager->getQueryForDebug()."<br />";
            }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
    }
    
}    