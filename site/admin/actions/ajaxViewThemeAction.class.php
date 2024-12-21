<?php

class SiteThemeViewForm extends mfForm {
    
    function configure()
    {
        $this->setValidator('theme', new mfValidatorChoice(array("key"=>true,"choices"=>ThemeUtils::getFrontendThemesByName())));
    }
}


class site_ajaxViewThemeAction extends mfAction {

    function execute(mfWebRequest $request) {           
        $messages = mfMessages::getInstance();     
        $this->site=new Site($request->getPostParameter('Site'));
        if ($this->site->isNotLoaded() || ($this->site->getSiteName()!=$request->getSite()->getSiteName()))
        {
            $this->site=null;
        }
        else
        {            
            $this->form = new SiteThemeViewForm();             
        }         
    }

}

