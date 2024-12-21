<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingImportGoogleSheetLogFormFilter.class.php";
require_once dirname(__FILE__) . "/../locales/Pagers/CustomerMeetingImportGoogleSheetLogPager.class.php";

class customers_meetings_imports_google_sheet_ajaxListPartialLogAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $item= new CustomerMeetingImportGoogleSheetFormat($request->getPostParameter('filter')["format_id"]);
        if ($item->isNotLoaded())
            throw new mfException(__("Format is invalid"));
        $this->formFilter= new CustomerMeetingImportGoogleSheetlogFormFilter();
        $this->pager=new CustomerMeetingImportGoogleSheetlogPager();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
                $this->format_id=$item->id;
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('format_id',$this->format_id);
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

