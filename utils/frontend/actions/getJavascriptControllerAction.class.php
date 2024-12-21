<?php
// http://www.monsys2.net/js/jquery.custom.messages_[culture].js

class utils_getJavascriptControllerAction extends mfAction {
    
    function configure() {
        $culture=$this->getRequest()->getRequestParameter('culture');
        if ($culture)
            $this->getContext()->getI18n()->setCulture($culture);
    }
    
    function execute(mfWebRequest $request) {   
        $template=$request->getRequestParameter('file').".js.tpl";
        $this->getViewManager()->setTemplate($template);
        $this->getViewManager()->cache_id=$this->getRequest()->getRequestParameter('culture');
        if ($this->getViewManager()->isCached($template))
           $this->setCache();     
        if (!$this->getViewManager()->templateExists())
        {
            $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
            $this->getResponse()->setHttpHeader('Status','404');
            return mfView::HEADER_ONLY;
        }    
    }

}

