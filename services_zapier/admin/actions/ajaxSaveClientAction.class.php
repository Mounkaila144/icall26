<?php
require_once dirname(__FILE__)."/../locales/Forms/ServicesZapierClientViewForm.class.php";

class services_zapier_ajaxSaveClientAction extends mfAction {

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        try
        {
            $this->client=new ServicesZapierClient($request->getParameter('Client'));
            if ($this->client->isNotLoaded())
            {
                $messages->addError(__('Client is invalid'));
                $this->forward('services_zapier','ajaxListPartialClient');
            }
            $this->form= new ServicesZapierClientViewForm($request->getPostParameter('Client'));
            $this->form->bind($request->getPostParameter('Client'));
            if ($this->form->isValid())
            {
                $this->client->set('name',$this->form->getValue('name'));
                $this->client->set('scope',$this->form->getValue('scope'));
                $this->client->set('redirect_uri',$this->form->getValue('redirect_uri'));
                $this->client->save();
                $messages->addInfo(__("Client has been updated."));
                $this->forward('services_zapier','ajaxListPartialClient');
            }
            else
            {
                $messages->addError(__("Form has some errors"));
                echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo '</pre>';

            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
