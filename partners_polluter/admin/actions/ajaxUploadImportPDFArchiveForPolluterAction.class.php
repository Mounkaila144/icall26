<?php


require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelPdfImportArchiveForPolluterForm.class.php";

 
class  partners_polluter_ajaxUploadImportPDFArchiveForPolluterAction extends mfAction {


    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        try
        {              
            $this->item = new PartnerPolluterCompany($request->getPostParameter('Polluter'));
            if ($this->item->isNotLoaded())
                throw new mfException(__('Polluter is invalid.'));
            $this->form = new PartnerPolluterModelPdfImportArchiveForPolluterForm();
            $this->form->bind($request->getPostParameter('PolluterModelI18n'),$request->getFiles('PolluterModelI18n'));
            if($this->form->isValid()) 
            {                    
                $archive = new PartnerPolluterCompanyModelsUnArchive($this->form->getZip(),$this->item);
                $archive->process();             
                $messages->addInfo(__("%s Models has been imported.",$archive->getNumberOfModels()));
                $messages->addInfo(__("%s Documents has been imported. [%s]",[$archive->getNumberOfDocuments(),$archive->getDocuments()->implode()]));
                if ($archive->hasErrors())
                    $messages->addError(__("Errors: %s",$archive->getErrors()->implode()));
                $request->addRequestParameter('polluter', $this->item);
                $this->forward("partners_polluter","ajaxListPartialModelI18nForPolluter");     
            }
            else 
            {
                $messages->addError(__('Form has some errors.'));
            }
        }
        catch (mfException $e) {
            $messages->addError($e);
        }       
    }

}

