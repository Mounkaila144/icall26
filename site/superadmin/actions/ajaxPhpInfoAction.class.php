<?php

class site_ajaxPhpInfoAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {
        phpinfo();
        return mfView::NONE;
    }
}

