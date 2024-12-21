<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimeRegionPriceForClassFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimeRegionPriceForClassPager.class.php";

class app_domoprime_ajaxListPartialRegionPriceForClassAction extends mfAction {

 
   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();     
        $this->class=$request->getRequestParameter('class',new DomoprimeClass($request->getPostParameter('DomoprimeClass')));
        if ($this->class->isNotLoaded())
            return ;       
        $this->formFilter= new DomoprimeRegionPriceForClassFormFilter();                  
        $this->pager=new DomoprimeRegionPriceForClassPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {                       
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getCountry());              
                $this->pager->setParameter('class_id',$this->class->get('id'));      
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();         
              //  echo mfSiteDatabase::getInstance()->getQuery();
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
       // var_dump($this->pager[0]);
    }
    
}    