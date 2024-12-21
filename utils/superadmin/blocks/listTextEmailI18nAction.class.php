<?php


class utils_listTextEmailI18nActionComponent extends mfActionComponent {
     
    const SITE_NAMESPACE = 'system/site';
     
    function execute(mfWebRequest $request) {                          
        $messages = mfMessages::getInstance();    
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);                   
        try
        {         
            $this->formFilter= new TextEmailI18nFormFilter(array('module'=>$this->getParameter('module')),$site);          
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
       // var_dump($this->pager);
    }
                    
}    