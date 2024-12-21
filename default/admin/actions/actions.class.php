<?php


class defaultActions extends mfActions {
          
    function executeIndex(mfWebRequest $request)
    {
    }
    
    function executeError404(mfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
        $this->getResponse()->setHttpHeader('Status','404');
    }        
    
    function executeSiteNotAvailable(mfWebRequest $request)
    {
    
    }
    
    function executeError404File(mfWebRequest $request)
    {       
        $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
        $this->getResponse()->setHttpHeader('Status','404');        
    }
}


