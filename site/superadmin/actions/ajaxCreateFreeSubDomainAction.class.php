<?php

class site_ajaxCreateFreeSubDomainAction extends mfAction {
    
    
    function execute(mfWebRequest $request) {                      
        $messages = mfMessages::getInstance();              
        try
        {
           //var_dump(extract_subdomains("sub1.sub2.example.co.uk"));
           if ($request->getPostParameter('Site') && $request->isMethod('POST'))
           {    
                $site=new Site($request->getPostParameter('Site')); 
                if ($site->isLoaded())
                {
                    if (!$site->isSubDomain())
                       throw new mfException(__('sub domain is invalid.')); 
                    $soap=new SoapOvh();
                    $soap->login();                                    
                    $soap->subDomainAdd($this->getRequest()->getSite()->getSite()->getHostName(), $site->getSubDomains());
                    $soap->logout();
                    $response=array('info'=>__('sub domain has been created.'));
                }    
           }
                      
        }
        catch (SoapFault $e)
        {
            $messages->addError($e);
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }  
        return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;  
    }

    
    
  
}

