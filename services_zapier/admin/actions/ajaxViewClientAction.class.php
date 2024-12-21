<?php
require_once dirname(__FILE__)."/../locales/Forms/ServicesZapierClientViewForm.class.php";

class services_zapier_ajaxViewClientAction extends mfAction {
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->client=new ServicesZapierClient($request->getPostParameter('ServicesZapierClient'));
        if ($this->client->isNotLoaded())
        {
            $messages->addError(__('Client is invalid'));
            $this->forward('services_zapier','ajaxListPartialClient');
        }
        $this->form=new ServicesZapierClientViewForm();



    }

}
