<?php


class defaultActions extends mfActions {
    
     
    function executeLogin(mfWebRequest $request)
    {
     $login=$request->getPostParameter('f_login');
     $password=$request->getPostParameter('f_password');
     $this->time_out=$this->getUser()->getSessionExpired()?$this->getUser()->getOption('timeout'):false;
     
     if ($login=='fmallet'&&$password=='antromane')
     {
          $this->getUser()->setAuthenticated(true);          
          // Go to the page requested          
          $this->redirect($this->getRequest()->getReferer());          
          return;
     }
    }
    
    function executeError404(mfWebRequest $request)
    {               
       $this->getResponse()->setHttpHeader('Status','404');
     /*  if ($request->isXmlHttpRequest())
        {   
            $this->getResponse()->setHttpHeader('HTTP/1.1 404 url not found');       
            $this->getResponse()->sendHttpHeaders();
            return mfView::NONE;
        }*/
        $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
    }
    
    function executeLogout(mfWebRequest $request)
    {
         $this->getUser()->setAuthenticated(false);         
         $this->redirect($this->getRequest()->getReferer());        
    }

    function executeError404file(mfWebRequest $request)
    {
        $this->getResponse()->setHttpHeader('HTTP/1.1 404 File not found');
        $this->getResponse()->setHttpHeader('Status','404');
        $this->file=$request->getRequestParameter('file',$request->getURI());
    }
}


