<?php

class themes_ajaxListPartialAction extends mfAction {
    
     function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();       
        $this->pager=new Pager('Themes');
        $this->formFilter=new ThemesFormFilter();         
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

