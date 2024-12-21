<?php
 
require_once __DIR__."/../locales/FormFilters/SiteTextFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/SiteTextPager.class.php";

class site_text_ajaxListPartialTextAction extends mfAction {
      
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();
        $this->formFilter= new SiteTextFormFilter($this->user);
        $this->pager=new SiteTextPager();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                  // echo $this->formFilter->getQuery();
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                             
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }
               else
               {
                     $messages->addError(__('Filter has some errors.'));
               }    
        }
        catch (Exception $e)
        {
            $messages->addError($e);
        }            
    }
    
}    