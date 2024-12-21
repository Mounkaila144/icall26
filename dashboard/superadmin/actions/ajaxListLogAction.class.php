<?php


class dashboard_ajaxListLogAction extends mfAction {
	
    function preExecute() {
        $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');       
    }
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();       
        $this->pager=new PagerFiles();
        $this->formFilter=new logFilesFormFilter();
        try
        {
            $this->formFilter->bind($request->getPostParameter('filter'));    
            if ($this->formFilter->isValid()||$request->getPostParameter('filter')==null)
            {
              $this->pager->setFiles($this->formFilter->getFiles());
              $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);
              $this->pager->setPage($this->request->getGetParameter('page'));
              $this->pager->execute();           
            }              
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }
    }
    
    
 
}

