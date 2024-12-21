<?php
require_once __DIR__."/../locales/FormFilters/CustomerContractReferenceForSelectFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/CustomerContractReferenceForSelectPager.class.php";

class customers_contracts_ajaxListPartialContractReferenceForSelectAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $messages=mfMessages::getInstance();  
        $formFilter= new CustomerContractReferenceForSelectFormFilter($request->getPostParameter('filter'));
        $pager=new CustomerContractReferenceForSelectPager();     
        try 
        {
            $formFilter->bind($request->getPostParameter('filter'));           
            if ($formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
                echo $formFilter->getQuery();
                $pager->setQuery($formFilter->getQuery());               
                $pager->setNbItemsByPage($formFilter['nbitemsbypage']);
                $pager->setPage($request->getGetParameter('page'));
                $pager->execute();            
            } 
            else
            {
                $messages->addError(__('Filter has some errors.'));
              //  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {
              $messages->addError($e);
        }          
        //var_dump($pager->getItems());
       // die(__METHOD__);
        return array('action'=>'ListPartialContractReferenceForselect',
                     'next_page'=>$pager->getNextPage(),
                     'page'=>$pager->getPage(),
                     'items'=>$pager->getItems()->toArrayForReferenceSelect());        
    }

}
