<?php

class users_ajaxListAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
        $this->forwardIf(!$site,"sites","Admin");
        $this->formFilter= new UsersFormFilter();
        $this->pager=new Pager('User');  
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
                                                      $this->formFilter->getErrorSchema()->getErrors()));
                }  
                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
      //  var_dump($this->pager->getItems());
    }

}

