<?php

class sites_ajaxDeleteSitesAction extends mfAction {
    
    function execute(mfWebRequest $request) { 
      $messages = mfMessages::getInstance();
      try 
      {
          $form=new SitesDeleteForm($request->getPostParameter('sites'));
          $form->bind($request->getPostParameter('sites'));
          if ($form->isValid())
          {
              if (in_array(mfConfig::getSuperAdmin('host'),$form->getValue("selection")))
                 throw new mfException(__("delete superadmin host [%s] is forbidden.",mfConfig::getSuperAdmin('host')));
              $sites= new SiteCollectionByHost($form->getValue("sites")); 
              $this->getEventDispather()->notify(new mfEvent($sites, 'sites.change','delete')); 
              //var_dump($sites);
              $sites->delete();  
              $response = array("action"=>"DeleteSites",
                                "selection" =>$form->getValue("selection")
                               ); 
          }    
          else
          {
              $messages->addErrors(array_merge($form->getErrorSchema()->getGlobalErrors(),$form->getErrorSchema()->getErrors()));
          }    
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasErrors()?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
