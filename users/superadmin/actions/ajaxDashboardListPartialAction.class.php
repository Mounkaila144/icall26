<?php

require_once dirname(__FILE__)."/../locales/FormFilters/UsersSuperAdminFormFilter.class.php";
require_once dirname(__FILE__)."/../locales/Pagers/UserPager.class.php";

class users_ajaxDashboardListPartialAction extends mfAction {
    
        function execute(mfWebRequest $request) {   
            $messages = mfMessages::getInstance();
            $this->formFilter= new UsersSuperAdminFormFilter();
            $this->pager=new UserPager();             
            try
            {
                    $this->formFilter->bind($request->getPostParameter('filter'));
                    if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                    {                     
                        $this->pager->setQuery($this->formFilter->getQuery());
                        $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                        $this->pager->setPage($this->request->getGetParameter('page'));
                        $this->pager->execute(); 
                    }
                    else
                    {                    
                         $messages->addErrors(array_merge($this->form->getErrorSchema()->getGlobalErrors(),
                                                          $this->form->getErrorSchema()->getErrors()));
                    }    
            }
            catch (mfException $e)
            {
                $messages->addError($e);
            }
        }
}

