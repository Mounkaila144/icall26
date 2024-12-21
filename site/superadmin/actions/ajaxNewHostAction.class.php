<?php

require_once dirname(__FILE__)."/../locales/Forms/HostForm.class.php";

class site_ajaxNewHostAction extends mfAction {

    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();
        try 
        {
            $this->form = new HostForm();
            $this->host = new Site($request->getPostParameter('Site'));
            if (!$request->isMethod('POST') || !$request->getPostParameter('Site'))
                return ;
            $this->form->bind($request->getPostParameter('Site'));
            if ($this->form->isValid()) {
                    if ($this->host->isLoaded())
                        throw new mfException(__("Host already exists")); // Message d'information
                    $this->host->add($this->form->getValues())->save();     
                    $this->getEventDispather()->notify(new mfEvent($this->host, 'host.create','new')); 
                    $messages->addInfo(__("Host %s has been created.", $this->host->getHost()));
                    $this->forward('site','ajaxListPartial');
            }
            else
            {
                $this->host->add($request->getPostParameter('Site')); // Repopulate
                $messages->addError(__("Form has some errors."));            
            }    
        }        
        catch (mfException $e)
        {
            $messages->addError($e);
        }

    }

}

