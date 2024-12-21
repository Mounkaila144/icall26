<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingCommentsPager.class.php";


class customers_meetings_comments_ajaxListPartialCommentAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();       
        $this->meeting=new CustomerMeeting($request->getPostParameter('Meeting'));        
        if ($this->meeting->isNotLoaded())
            return ;       
        $this->formFilter= new CustomerMeetingCommentsFormFilter();                  
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
                $this->pager->execute();    
               }
        }
        catch (mfException $e)
        {          
            $messages->addError($e);
        }   
    }
    
}    