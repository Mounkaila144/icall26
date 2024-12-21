<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingCommentsPager.class.php";


class customers_meetings_comments_ajaxListPartialCommentAction extends mfAction {

const SITE_NAMESPACE = 'system/site';
    
 
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);  
        $this->forwardIf(!$this->site,"sites","Admin");
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'),$this->site);        
        if ($this->meeting->isNotLoaded())
            return ;       
        $this->formFilter= new CustomerMeetingCommentsFormFilter($this->site);                  
        $this->pager=new CustomerMeetingCommentsPager($this->formFilter->getObjectsForPager());
        try
        {               
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               { 
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('meeting_id',$this->meeting->get('id'));                
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