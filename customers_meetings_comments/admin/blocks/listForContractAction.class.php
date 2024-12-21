<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingCommentsPager.class.php";



class customers_meetings_comments_listForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                        
        $this->user=$this->getUser();       
        $this->contract=$this->getParameter('contract');                            
        $this->formFilter= new CustomerMeetingCommentsFormFilter($this->user);                  
        $this->pager=new CustomerMeetingCommentsPager($this->formFilter->getObjectsForPager());
        try
        {                                
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('meeting_id',$this->contract->getMeeting()->get('id'));                
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();                                                          
        }
        catch (mfException $e)
        {          
            $this->getMessage()->addError($e);
        }   
      //  var_dump($this->pager);
    } 
    
    
}