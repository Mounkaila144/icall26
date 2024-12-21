<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerCommentsPager.class.php";


class customers_comments_ajaxListPartialCommentForMeetingAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);        
        if ($this->meeting->isNotLoaded())
            return ;       
        $this->formFilter= new CustomerCommentsFormFilter($this->site);                  
        $this->pager=new CustomerCommentsPager($this->formFilter->getObjectsForPager());
        try
        {               
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               { 
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('customer_id',$this->meeting->getCustomer()->get('id'));                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->executeSite($this->site);    
               }
        }
        catch (mfException $e)
        {          
            $messages->addError($e);
        }   
    }
    
}    