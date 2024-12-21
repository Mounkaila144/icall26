<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UserProfileFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/UserProfilePager.class.php";

class users_ajaxListPartialProfileAction extends mfAction {


   
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->formFilter= new UserProfileFormFilter ($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getCountry())),$this->site);                  
        $this->pager=new UserProfilePager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage("*");
                $this->pager->setParameter('lang',(string)$this->formFilter['lang']);                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
       // var_dump($this->pager[0]);
    }
    
}    