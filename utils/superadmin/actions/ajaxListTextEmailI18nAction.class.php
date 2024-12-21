<?php

 
class utils_ajaxListTextEmailI18nAction extends mfAction {
    
     const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {          
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);   
        $this->forwardIf(!$site,"sites","Admin");            
        $messages = mfMessages::getInstance();                     
        try
        {
            $this->formFilter= new TextEmailI18nFormFilter($request->getPostParameter('filter',array('module'=>$request->getRequestParameter('module'))),$site);          
            $this->pager=new Pager('TextEmailI18n');    
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery());
                $this->pager->setParameters(array('module'=>(string)$this->formFilter['module']));
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setPage($request->getGetParameter('page'));            
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
        //var_dump($this->formFilter->getDefault('order'),(string)$this->formFilter['order']['lang']);
    }

}

