<?php

require_once dirname(__FILE__).'/../locales/Forms/SiteServiceServerSelectedForm.class.php';
require_once dirname(__FILE__).'/../locales/FormFilters/SiteServicesServerFormFilter.class.php';
require_once dirname(__FILE__).'/../locales/Pagers/SiteServicesServerPager.class.php';

class site_services_ajaxListPartialSiteServicesServersAction extends mfAction{
 
 
    public function execute(\mfWebRequest $request) {
        $messages = mfMessages::getInstance();
              
        $this->user=$this->getUser();   
        $form=new SiteServiceServerSelectedForm();
        $form->bind($request->getPostParameter('Selection'));   
        $this->formFilter= new SiteServicesServerFormFilter($form->getValue('servers'),$request->getPostParameter('filter'));                  
        $this->pager=new SiteServicesServerPager();
        try
        {                             
           $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {                                   
               // echo $this->formFilter->getQuery()."<br/>";
                $this->pager->setQuery($this->formFilter->getQuery()); 
                $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                 
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->execute();  
            }  
            else
            {
                $messages->addError(__('Filter has error.'));
            //    var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {          
            $messages->addError($e);
        }         
    }

}
