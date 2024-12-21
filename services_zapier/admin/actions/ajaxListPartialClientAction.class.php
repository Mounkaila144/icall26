<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ServicesZapierClientFormFilter.class.php";
require_once dirname(__FILE__) . "/../locales/Pagers/ServicesZapierClientPager.class.php";

class services_zapier_ajaxListPartialClientAction extends mfAction
{
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->formFilter= new ServicesZapierClientFormFilter();
        $this->pager=new ServicesZapierClientPager();
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

