<?php

require_once dirname(__FILE__)."/../locales/FormFilters/ImportFilesFormFilter.class.php";

class utils_dialogFileManagerFtpForImportActionComponent extends mfActionComponent {
    
    function preExecute() {
        $this->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    //    $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');       
    }
    
    function execute(mfWebRequest $request)
    {                                 
        $this->pager=new PagerFiles();             
        $this->formFilter=new ImportFilesFormFilter($this->getParameter('path'));    
    //    var_dump($this->formFilter->getFiles());
        $this->pager->setFiles($this->formFilter->getFiles());
        $this->pager->setNbItemsByPage($this->formFilter['nbitemsbypage']);     
        $this->pager->execute();        
    } 
       
}

