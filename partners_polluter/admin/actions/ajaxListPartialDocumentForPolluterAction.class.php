<?php

require_once dirname(__FILE__)."/../locales/FormFilters/DocumentForPolluterFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/DocumentForPolluterPager.class.php";

class partners_polluter_ajaxListPartialDocumentForPolluterAction extends mfAction{
    
       function execute(mfWebRequest $request) {              

        $messages = mfMessages::getInstance(); 
        $this->polluter=$request->getRequestParameter('polluter',new PartnerPolluterCompany($request->getPostParameter('Polluter')));
        if ($this->polluter->isNotLoaded())
            return ;
       $this->formFilter= new DocumentForPolluterFormFilter($request->getRequestParameter('lang',$request->getPostParameter('lang',$this->getUser()->getCountry())));
        $this->pager=new DocumentForPolluterPager();  
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                    //echo $this->formFilter->getQuery();
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',(string)$this->formFilter['lang']);         
                    $this->pager->setParameter('polluter_id',$this->polluter->get('id'));        
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->execute();  
                 // echo mfSiteDatabase::getInstance()->getQuery();
                }                
                else
                {
                    $messages->addError(__("Filter has some errors."));
                  //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                }    
                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        } 
           
       }
    
}
