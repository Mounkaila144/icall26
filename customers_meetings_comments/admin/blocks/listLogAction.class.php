<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingLogCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingCommentsPager.class.php";



class customers_meetings_comments_listLogActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {                        
        $this->user=$this->getUser();       
        $this->meeting=$this->getParameter('meeting');             
        $this->key=$this->getParameter('key');             
        $this->formFilter= new CustomerMeetingLogCommentsFormFilter($this->user);                  
        $this->pager=new CustomerMeetingCommentsPager($this->formFilter->getObjectsForPager());
        try
        {                                
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('meeting_id',$this->meeting->get('id'));                
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