<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportViewCsvFileForm.class.php";

class marketing_leads_ajaxViewLogFromLineAction extends mfAction {
        
    function execute(mfWebRequest $request) {
        
        $messages = mfMessages::getInstance();
        
        try
        {
            $this->form = new MarketingLeadsWpFormsLeadsImportViewCsvFileForm($request->getPostParameters());
            $this->form->bind($request->getPostParameters());
            if($this->form->isValid())
            {
                $this->import = $request->getRequestParameter('import',new MarketingLeadsWpFormsLeadsImportFile($request->getPostParameter('Import')));
                $this->pager = new PagerViewCsvFile($this->import);
                $this->pager->setPage($request->getGetParameter('page'));
                $this->pager->setPointer($this->form->getValue('Line'));
                $this->pager->setErrorField($this->form->getValue('Field'));
                $this->pager->execute();                                
            }
            else
            {
//                echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";
                $messages->addError("Form is invalide !");
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getErrorsMessage()));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }       
    }
    
}