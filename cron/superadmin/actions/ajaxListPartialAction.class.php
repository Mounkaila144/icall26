<?php

class cron_ajaxListPartialAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();
        $this->formFilter= new cronFormFilter();
        $this->pager=new Pager('Cron');  
        $this->credential=$this->getUser()->hasCredential('superadmin_cron');
        try
        {
                $this->formFilter->bind($request->getPostParameter('filter'));
                if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
                {
                    
                    $this->pager->setQuery($this->formFilter->getQuery());
                    $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
                    $this->pager->setPage($this->request->getGetParameter('page'));
                    $this->pager->executeSuperAdmin();  
                }              
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
      //  return mfView::NONE;
       // $cronController=new mfCronController();
       // $cronController->updateDatabase();
    }

}

