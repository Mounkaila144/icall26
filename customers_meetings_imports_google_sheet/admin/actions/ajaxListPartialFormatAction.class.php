<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingImportGoogleSheetFormatFormFilter.class.php";
require_once dirname(__FILE__) . "/../locales/Pagers/CustomerMeetingImportGoogleSheetFormatPager.class.php";

class customers_meetings_imports_google_sheet_ajaxListPartialFormatAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->formFilter= new CustomerMeetingImportGoogleSheetFormatFormFilter();
        $this->pager=new CustomerMeetingImportGoogleSheetFormatPager();
        if (!$this->formFilter->getSettings()->checkFile()) {
            throw new mfException(__("Secret file does not exist"));
        }
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

