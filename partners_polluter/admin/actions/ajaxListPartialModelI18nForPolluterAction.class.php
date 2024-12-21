<?php

require_once dirname(__FILE__)."/../locales/FormFilters/PolluterModelI18nForPolluterFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/PolluterModelI18nForPolluterPager.class.php";

class partners_polluter_ajaxListPartialModelI18nForPolluterAction extends mfAction{
    
       function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->polluter=$request->getRequestParameter('polluter',new PartnerPolluterCompany($request->getPostParameter('Polluter')));
        if ($this->polluter->isNotLoaded())
            return ;
        $this->formFilter= new PolluterModelI18nForPolluterFormFilter($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getCountry())));
        $this->pager=new PolluterModelI18nForPolluterPager();  
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                  //  echo $this->formFilter->getQuery();
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',(string)$this->formFilter['lang']);         
                    $this->pager->setParameter('polluter_id',$this->polluter->get('id'));        
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute();  
                }                
                else
                {
                    $messages->addError(__("Filter has some errors."));
                   // var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                }    
                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
           
       }
    
}
