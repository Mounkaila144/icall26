<?php

class themes_ajaxRefreshThemesAction extends mfAction {
    
     function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();               
        try
        {
            ThemesUtils::refresh();
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        } 
        $this->forward('themes','ajaxList');
    }

}

