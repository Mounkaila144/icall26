<?php

class site_languages_ajaxListPartialAction extends mfAction {
    
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();       
        $this->formFilter= new languagesFrontendFormFilter();
        $this->pager=new Pager('Language');     
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
            else
            {
                $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                                                 $this->formFilter->getErrorSchema()->getErrors()));
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
}

