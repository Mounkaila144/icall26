<?php

class themes_ajaxViewThemeAction extends mfAction {
    
    
     
    function execute(mfWebRequest $request) {   
       $messages = mfMessages::getInstance();
       $this->theme=new Themes($request->getPostParameter('theme'));
    }

}

