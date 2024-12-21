<?php

class SiteThemeForm extends mfForm {
    
    function configure()
    {
        $this->setValidators(array(
            'site_id'=>new mfValidatorInteger(),
            'theme'=>new mfValidatorChoice(array("key"=>true,"choices"=>ThemeUtils::getFrontendThemesByName()))
            ));
    }
}


class site_ajaxSaveThemeAction extends mfAction {

    function execute(mfWebRequest $request) 
    {           
        $messages = mfMessages::getInstance();    
        $this->site=new Site($request->getPostParameter('Site'));
        if ($this->site->isNotLoaded() || ($this->site->getSiteName()!=$request->getSite()->getSiteName()))
        {
            $this->site=null;
        }
        else
        {
            $this->form = new SiteThemeForm();
            $this->form->bind($request->getPostParameter('Site'));
            if ($this->form->isValid())
            {
                $this->site->set('site_frontend_theme',(string)$this->form['theme']);
               // var_dump($this->site);
                $this->site->save();
                $this->site->removeFrontendHostCache();
                $messages->addInfo(__("theme has been updated."));
                $this->forward('site','ajaxList');
            }   
              
        }         
    }

}

