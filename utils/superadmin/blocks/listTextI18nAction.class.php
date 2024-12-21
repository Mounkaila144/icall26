<?php


class utils_listTextI18nActionComponent extends mfActionComponent {
     
    const SITE_NAMESPACE = 'system/site';        
     
    function execute(mfWebRequest $request) {                          
        $messages = mfMessages::getInstance();       
        $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);            
        $class=ucfirst(strtolower($this->getParameter('class')))."TextI18n";       
        if (!class_exists($class))
            return mfView::NONE;    
        $this->class=strtolower($this->getParameter('class'));
        try
        {                    
            $this->formFilter= new TextI18nFormFilterBase($class,$site);          
            $this->pager=new Pager($class);    
            $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {    
                $this->pager->setQuery($this->formFilter->getQuery());
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
    }    
                    
}    