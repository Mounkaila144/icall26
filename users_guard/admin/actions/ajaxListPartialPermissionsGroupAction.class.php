<?php

require_once dirname(__FILE__)."/../locales/FormFilters/PermissionsGroupFormFilter.class.php";

class users_guard_ajaxListPartialPermissionsGroupAction  extends mfAction {
    
     
     function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();            
        $this->formFilter= new PermissionsGroupFormFilter($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getCountry())),$this->site);
        $this->pager=new Pager($this->formFilter->getObjectsForPager());   
        try
        {               
                $this->formFilter->bind($request->getPostParameter('filter'));     
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {                       
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',(string)$this->formFilter['lang']);       
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute();
                } 
               // else var_dump($this->formFilter->getErrorSchema());
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
      //  var_dump($this->pager);
    }

}