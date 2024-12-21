<?php
require_once dirname(__FILE__)."/../locales/Forms/ServicesZapierClientForm.class.php";
class services_zapier_ajaxNewClientAction extends mfAction
{
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->item = new ServicesZapierClient();
        $this->form = new ServicesZapierClientForm($request->getPostParameter('Client'));
        if ($request->getPostParameter('Client')) {
            try {
                $this->form->bind($request->getPostParameter('Client'));
                if ($this->form->isValid()) {
                    $this->item->add([
                        'scope' => $this->form->getValue('scope'),
                        'client_id' => bin2hex(openssl_random_pseudo_bytes(16)),
                        'client_secret' => bin2hex(openssl_random_pseudo_bytes(32)),
                        'grant_types' => 'authorization_code refresh_token',
                        'redirect_uri' =>  $this->form->getValue('redirect_uri'),
                        'name' => $this->form->getValue('name')
                    ]);
                    $this->item->save();
                    $messages->addInfo(__("Client has been created."));
                    $this->forward('services_zapier', 'ajaxListPartialClient');
                } else {
                    $messages->addError(__("Form has some errors"));
                    $this->item->add($request->getPostParameter('Client'));
                   //echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo '</pre>';

                }
            } catch (mfException $e) {
                $messages->addError($e);
            }
        }
    }
}






