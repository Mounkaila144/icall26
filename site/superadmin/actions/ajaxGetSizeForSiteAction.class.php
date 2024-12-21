<?php

class site_ajaxGetSizeForSiteAction extends mfAction {

    function execute(mfWebRequest $request) {       
        $messages=mfMessages::getInstance();      
        try
        {
                $site=new Site($request->getPostParameter('Site'));                
                if ($site->isLoaded())
                { 
                        $site->set('site_size',$site->getFolderSize());
                        $site->set('site_db_size',$site->getDatabaseSizeFromServer());
                        $site->save();
                        $response = array( "action"=>"GetSizeForSite",
                                           'site_db_size'=>format_size($site->get('site_db_size')),
                                            'site_size'=>format_size($site->get('site_size')),
                                           "info"=>__('Sizes have been calculated.'),
                                           "site_host" => $site->get("site_host"));
                }
        }
        catch (mfException $e)
        {
           $messages->addError($e);
        }      
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;      
    }

}

