<?php

require_once dirname(__FILE__)."/../locales/FormFilters/usersFormFilter.class.php";
require_once __DIR__."/../locales/Pagers/UserPager.class.php";

class users_ajaxListPartialAction extends mfAction {
    
 
     
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();          
           if (!$this->getUser()->hasCredential(array(array('superadmin','admin','settings_user_list'))))
            $this->forwardTo401Action();
        $this->user=$this->getUser();           
        $this->formFilter= new UsersFormFilter($this->getUser());      
        $this->pager=new UserPager();         
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {        
                   //echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setParameter('lang',$this->getUSer()->getCountry());
                    $this->pager->setParameter('user_id',$this->getUSer()->getGuardUser()->get('id'));
                    $this->pager->setPage($this->request->getGetParameter('page'));                    
                    $this->pager->execute();                    
                   //  echo mfSiteDatabase::getInstance()->getQuery();
                }   
                else
                {
                    var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
                    $messages->addError(__('Filter has some errors.'));
                }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
       $this->number_of_users_connected= UserUtils::getNumberOfUsersConnected();        
      //  var_dump($this->pager->getItems());
    }

}

