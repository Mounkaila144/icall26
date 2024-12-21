<?php

// www.ecosol16.net/admin/api/v2/applications/iso/admin/SendQuotationEmailForContract

class app_domoprime_api2SendQuotationEmailForContractAction extends mfAction{

    public function execute(\mfWebRequest $request) {

        $this->getResponse()->setHttpHeader('Access-Control-Allow-Origin', '*')
                ->setHttpHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->setHttpHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');  
        $messages = mfMessages::getInstance();

        if (!$this->getUser()->hasCredential(array(array('superadmin', 'api_v2_app_domoprime_send_quotation_email_for_contract'))))
            $this->forwardTo401Action();

        try {
            
            $contract = new CustomerContract($request->getGetAndPostParameter('contract'));
            if ($contract->isNotLoaded())
                throw new mfException(__('Contract is invalid'));;
            $item = new DomoprimeQuotation($contract);
            if ($item->isNotLoaded())
                throw new mfException(__('Quotation is invalid'));;
            $model_email = new CustomerModelEmailI18n($request->getGetAndPostParameter('model'));
            if ( $model_email->isNotLoaded())
                throw new mfException(__('Model is invalid'));;
            if (!$item->getContract()->getCustomer()->get('email'))
                throw new mfException(__("Email doesn't exist, you have to complete it."));
            $company = SiteCompanyUtils::getSiteCompany();
            // Send Email
            $email = new CustomerEmailSent();
         //  $this->getMailer()->debug();
            try {
                $model = null;
                $settings = new DomoprimeSettings();
                if ($item->hasContract() && $item->getContract()->hasPolluter()) {
                    $polluter_quotation_model = new DomoprimePolluterQuotation($item->getContract()->getPolluter());
                    $model = $polluter_quotation_model->getModel();
                }
                if ($model == null || $model->isNotLoaded()) {
                    $model = $settings->getModelForQuotation();
                }
                if ($model->isNotLoaded())
                    throw new mfException(__("Model is invalid."));
                $pdf = DomoprimePdfEngine::getInstance()->getQuotationEngine($model, $item, $polluter_quotation_model);
                $pdf->save();
                $this->getMailer()->sendMail(
                        'app_domoprime',
                        'emailQuotation',
                        $company->get('email'),
                        $item->getContract()->getCustomer()->get('email'),
                        $model_email->get('subject'),
                        array("quotation" => $item, 'model' => $model_email),
                        array($pdf->getFilename())
                );

                $messages->addInfo(__(' Quotation has been sent to [{customer} - {email}].', array('customer' => (string) $item->getContract()->getCustomer(), 'email' => $item->getContract()->getCustomer()->get('email'))));

                $email->isSent();
                $response = array('info' => __(' Quotation has been sent to [{customer} - {email}].', array('customer' => (string) $item->getContract()->getCustomer(), 'email' => $item->getContract()->getCustomer()->get('email'))), "action" => "SendEmail");
            } catch (Swift_TransportException $e) {
                $messages->addError($e);
            } catch (Swift_MimeException $e) {
                $messages->addError($e);
            } catch (Exception $e) {
                $messages->addError($e);
            }

            // History
            $email->set('customer_id', $item->getContract()->getCustomer());
            $email->set('email', $item->getContract()->getCustomer()->get('email'));
            $email->set('subject', $model_email->get('subject'));
            $email->set('model_id',$model_email);
            // Record Email               
            $email->set('body', $this->getMailer()->getContent());
            $email->save();
            // Record history
            $history = new CustomerEmailHistory();
            $history->setUser($this->getUser()->getGuardUser());
            $history->setEmail($email);
            $history->save();
        } catch (mfException $e) {
            $messages->addError($e);
        }
        return $messages->hasMessages('error') ? array("error" => $messages->getDecodedErrors()) : $response;
    }

}
