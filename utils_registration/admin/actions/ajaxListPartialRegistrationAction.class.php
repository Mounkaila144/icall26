<?php
require_once dirname(__FILE__). '/../locales/Pagers/RegistrationPager.class.php';
require_once dirname(__FILE__).'/../locales/FormFilters/RegistrationFormFilter.class.php';

class utils_registration_ajaxListPartialRegistrationAction extends mfAction {
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        $this->user=$this->getUser();  
        
        $this->formFilter= new RegistrationFormFilter();                  
        $this->pager=new RegistrationPager();       
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid() || $request->getPostParameter('filter')==null)
               {    
                  // echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUser()->getCountry()); 
                    $this->pager->setParameter('user_id',$this->getUser()->getGuardUser()->get('id'));  
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();              
               }           
               else 
               {
                    $messages->addError(__("Filter has some errors."));                    
               }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
