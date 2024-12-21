<?php


class defaultActions extends mfActions {
    
    
     
    function executeLogin()
    {
       
    }
    
    function executeError404(mfWebRequest $request)
    {
        $this->redirect('/admin/');
        if ($request->isXmlHttpRequest())
        {
            $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
            $this->getResponse()->setHttpHeader('Status','404');
            $this->getResponse()->sendHttpHeaders();
            return mfView::NONE;
        }
    }
           
    function executeIndex(mfWebRequest $request)
    {    
//       $this->redirect('/admin/');
    }

    function executeSiteNotAvailable(mfWebRequest $request )
    {           
        $this->redirect('/admin/');
    }
    
    function executeLogout()
    {
         $this->getUser()->setAuthenticated(false);         
         $this->redirect($this->getRequest()->getReferer());        
    }
    
   

}


