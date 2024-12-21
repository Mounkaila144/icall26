<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerCommentsPager.class.php";



class customers_comments_listForMeetingActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';    
    
    function execute(mfWebRequest $request)
    {                
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);            
        $this->customer=$this->getParameter('customer');             
        $this->key=$this->getParameter('key');             
        $this->formFilter= new CustomerCommentsFormFilter(array(),$this->site);                  
        $this->pager=new CustomerCommentsPager($this->formFilter->getObjectsForPager());
        try
        {                                
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('customer_id',$this->customer->get('id'));                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->executeSite($this->site);                                                          
        }
        catch (mfException $e)
        {          
            $this->getMessage()->addError($e);
        }   
      //  var_dump($this->pager);
    } 
    
    
}