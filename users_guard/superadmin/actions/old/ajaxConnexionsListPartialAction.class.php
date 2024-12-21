<?php

class userGuard_ajaxConnexionsListPartialAction  extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);        
        $this->forwardIf(!$site,"sites","Admin");
        $this->formFilter= new ConnexionsFormFilter($site); 
        $this->pager=new Pager('Session');        
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->executeSite($site);  
                }
                else
                {
                  $messages->addErrors(array_merge($this->formFilter->getErrorSchema()->getGlobalErrors(),
                            $this->formFilter['range']['last_time']->getError()->getErrors()
                                                   ));
                }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
    }

}