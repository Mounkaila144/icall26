<?php

require_once dirname(__FILE__)."/../locales/FormFilters/PartnerLayerCompanyFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/PartnerLayerCompanyPager.class.php";

class partners_layer_ajaxListPartialLayerCompanyAction extends mfAction{
    
       function execute(mfWebRequest $request) {              

        $messages = mfMessages::getInstance();   
        $this->formFilter= new PartnerLayerCompanyFormFilter();
        $this->pager=new PartnerLayerCompanyPager();  
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
                    $messages->addError(__("Filter has some errors."));
                }    
                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
           
       }
    
}
