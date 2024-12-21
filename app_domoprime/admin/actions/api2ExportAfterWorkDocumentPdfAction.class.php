<?php

// www.ecosol16.net/admin/api/v2/applications/iso/admin/ExportAfterWorkDocumentPdf

class app_domoprime_api2ExportAfterWorkDocumentPdfAction extends mfAction {


    function execute(mfWebRequest $request) {
        
        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin','*')
                            ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                            ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
        
        $messages = mfMessages::getInstance(); 
        
        if (!$this->getUser()->hasCredential([['superadmin','api_v2_app_domoprime_after_work_document_export_pdf']]))
            $this->forwardTo401Action();
        try {
            $contract = new CustomerContract($request->getGetAndPostParameter('contract'));
            if ($contract->isNotLoaded())
                throw new mfException(__("Contract is invalid."));
            $settings = new DomoprimeSettings();
            if ($settings->getModelForAfterWorkDocument()->isNotLoaded())
                throw new mfException(__("Model is invalid."));
            $this->getEventDispather()->notify(new mfEvent($contract, 'app_domoprime.afterwork.process.pdf'));
            if ($settings->getModelForAfterWorkDocument()->getI18n()->hasFile()) {
                if (!mfModule::isModuleInstalled('system_resources') || !SystemResourceSettings::load()->hasResource('pdftk'))
                    throw new mfException(__('Resource PDFtk not available'));
                $pdf = new DomoprimeAfterWorkDocumentPdf($contract, $settings->getModelForAfterWorkDocument());
                $pdf->save();
                ob_start();
                ob_end_clean();
                $response = $this->getResponse();
                $response->setHttpHeader('Cache-Control: no-cache, must-revalidate');
                $response->setHeaderFile($pdf->getFilename());
                $response->sendHttpHeaders();
                readfile($pdf->getFilename());
            } else {
                echo "Not supported";
                die();
            }
        } catch (mfException $e) {
            //echo $e->getMessage();
            $this->forward('default','404');
        }
        die();
    }
}

