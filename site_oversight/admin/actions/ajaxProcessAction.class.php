<?php

 
class site_oversight_ajaxProcessAction extends mfAction {


    function execute(mfWebRequest $request) {
        $messages = mfMessages::getInstance();                             
        $this->user=$this->getUser();
        try
        {
             $engine= new SiteOversightEngine();
             $engine->process();
             $messages->addInfo(__('Oversight process is done')) ;             
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }         
        $this->forward($this->getModuleName(),'ajaxListPartialMessage');
    }

}

