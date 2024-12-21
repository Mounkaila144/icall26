<?php

require_once dirname(__FILE__)."/../locales/FormFilters/CustomerMeetingsNotUniquePhoneFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/CustomerMeetingsDuplicatePhonePager.class.php";

class customers_meetings_ListPhoneNotUniqueActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {              
        $meeting=$this->getParameter('meeting');        
        $this->user=$this->getUser();
        $this->formFilter= new CustomerMeetingsNotUniquePhoneFormFilter($this->getUser());                                                                     
        $this->pager=new CustomerMeetingsDuplicatePhonePager();                   
        try
        {                                         
                $this->pager->setQuery($this->formFilter->getQuery());                         
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id')); 
                $this->pager->setParameter('phone',$meeting->getCustomer()->get('phone')); 
                $this->pager->setParameter('meeting_id',$meeting->get('id')); 
                $this->pager->setParameter('callcenter_id',$this->getUser()->getGuardUser()->get('callcenter_id')); 
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();                                 
        }
        catch (mfException $e)
        {        
            $this->getMessage()->addError($e);
        }  
        $this->settings_meetings=CustomerMeetingSettings::load();           
     //   var_dump($this->pager);
    } 
    
    
}