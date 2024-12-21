<?php

require_once dirname(__FILE__).'/../locales/Forms/SiteServiceSiteSelectedForm.class.php';
require_once dirname(__FILE__).'/../locales/FormFilters/SiteServicesSiteFormFiter.class.php';
require_once dirname(__FILE__).'/../locales/Pagers/SiteServicesSitePager.class.php';

class site_services_ajaxListPartialSiteServicesAction extends mfAction{
   
    
    public function execute(\mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();              
        $this->user=$this->getUser();
        $form=new SiteServiceSiteSelectedForm();
        $form->bind($request->getPostParameter('Selection'));       
        $this->formFilter= new SiteServicesSiteFormFiter($form->getValue('sites'),$request->getPostParameter('filter'));                  
        $this->pager=new SiteServicesSitePager();
        try
       {     
          $this->formFilter->bind($request->getPostParameter('filter'));
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {  
            //echo $this->formFilter->getQuery()."<br/>";
                    $this->pager->setQuery($this->formFilter->getQuery()); 
                   $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);                 
                    $this->pager->setPage($request->getGetParameter('page'));
                    $this->pager->execute();  
               }  
               else{
                  $messages->addError(__("Filter has some errors."));
                  var_dump($this->formFilter->getErrorSchema()->getErrorsMessage());
               }
        }
        catch (mfException $e)
        {          
            $messages->addError($e);
        } 
        $this->settings=SiteServicesSettings::load();              
    }
    

}