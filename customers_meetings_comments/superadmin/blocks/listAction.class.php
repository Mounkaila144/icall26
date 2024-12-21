<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingCommentsFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingCommentsPager.class.php";



class customers_meetings_comments_listActionComponent extends mfActionComponent {

    const SITE_NAMESPACE = 'system/site';    
    
    function execute(mfWebRequest $request)
    {                
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);            
        $this->meeting=$this->getParameter('meeting');             
        $this->key=$this->getParameter('key');             
        $this->formFilter= new CustomerMeetingCommentsFormFilter(array(),$this->site);                  
        $this->pager=new CustomerMeetingCommentsPager($this->formFilter->getObjectsForPager());
        try
        {                                
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('meeting_id',$this->meeting->get('id'));                
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