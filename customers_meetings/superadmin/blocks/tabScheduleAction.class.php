<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsScheduleFormFilter.class.php";
//require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsSchedulePager.class.php";


class customers_meetings_tabScheduleActionComponent extends mfActionComponent {

   const SITE_NAMESPACE = 'system/site';
   
    function execute(mfWebRequest $request)
    {                   
        $messages = $this->getMessage(); 
        $this->site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);                    
        $this->formFilter= new CustomerMeetingsScheduleFormFilter($this->getUser()->getCountry(),$this->site);                                  
      //  $this->pager=new CustomerMeetingsSchedulePager($this->formFilter->getObjectsForPager());                 
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                  // $this->formFilter->setParameters(array('date_in'))
                  // echo $this->formFilter->getQuery()."<br/>";
                  //  $this->pager->setQuery($this->formFilter->getQuery()); 
                  //  $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                  //  $this->pager->setParameter('lang',$this->getUser()->getCountry());                
                  //  $this->pager->setPage($request->getGetParameter('page'));
                  //  $this->pager->executeSite($this->site);   
                   $this->formFilter->execute();
               }                          
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }          
       // var_dump($this->formFilter->getCalendar());
     /*  foreach ($this->formFilter->getCalendar()->getDays() as $day)
        {
           echo $day."<br/>";
            var_dump($day->getSchedule());
        } */
       // return mfView::NONE;
     /*   foreach ($this->formFilter->getCalendar()->getHours() as $time)
        {    
            foreach ($this->formFilter->getCalendar()->getDays() as $day)
            {
              // var_dump($time->getTime()); 
              // var_dump($day->getScheduleTime("06:00"));
                echo "Day=".$day."<br/>";
               var_dump($day->getScheduleTime($time->getTime()));
               // var_dump($this->formFilter->getCalendar()->getDayTime($time->getTime()));
            }
            
            //die(__METHOD__);
        }
        return mfView::NONE;*/
    } 
    
    
}