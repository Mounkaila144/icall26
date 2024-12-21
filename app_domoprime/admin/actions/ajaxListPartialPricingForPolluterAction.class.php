<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DomoprimePolluterClassPricingFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DomoprimePolluterClassPricingPager.class.php";

class app_domoprime_ajaxListPartialPricingForPolluterAction extends mfAction{
    
       function execute(mfWebRequest $request) {              

        $messages = mfMessages::getInstance();  
        $this->user=$this->getUser();
        $this->polluter =$request->getRequestParameter('polluter',new DomoprimePollutingCompany($request->getPostParameter('Polluter'))); // new object       
        if ($this->polluter->isNotLoaded())
            return ;
        $this->formFilter= new DomoprimePolluterClassPricingFormFilter();
        $this->pager=new DomoprimePolluterClassPricingPager();  
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->setParameter('polluter_id',$this->polluter->get('id'));
                    $this->pager->setParameter('lang',$this->getUser()->getLanguage());
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

