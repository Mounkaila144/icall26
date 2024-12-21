<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UsersTeamFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/PagerTeam.class.php";

class users_ajaxListPartialTeamAction extends mfAction {


  
        
    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->formFilter= new UsersTeamFormFilter();                  
        $this->pager=new PagerTeam();
        try
        {
               $this->formFilter->bind($request->getPostParameter('filter'));
               if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
               {    
                   //echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage("*");                               
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();              
               }                                    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }   
        $this->user_settings=UserSettings::load();
       // var_dump($this->pager[0]);
    }
    
}    