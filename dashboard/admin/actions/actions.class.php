<?php


class dashboardActions extends mfActions {               
       
  /*  function executeIndex(mfWebRequest $request)
    {
        
     //   echo "<div>".__METHOD__."</div>";
     //  echo "<div>Culture=".$request->getCulture()."</div>";
     //  echo "<div>CultureForced=".$request->getForcedCulture()."</div>";
     //  echo "<div>CulturePrefered=".$request->getPreferredLanguage()."</div>";
    }*/
    
    function executeAjaxIndex()
    {
       
    }
    
     function executeError404(mfWebRequest $request)
    {             
        $this->getResponse()->setHttpHeader('HTTP/1.1 404 Page not found');
        $this->getResponse()->setHttpHeader('Status','404');
        if ($request->isXmlHttpRequest())
        {
            $this->getResponse()->sendHttpHeaders(); 
            return mfView::NONE;
        }  
    }
    
    function executeError401(mfWebRequest $request)
    {       
        $this->getResponse()->setHttpHeader('HTTP/1.1 401 Unauthorized Page');
        $this->getResponse()->setHttpHeader('Status','401');
        if ($request->isXmlHttpRequest())
        {
            $this->getResponse()->sendHttpHeaders(); 
            return mfView::NONE;
        }    
    }
}


