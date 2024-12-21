<?php


class customers_meetings_forms_ajaxBuildSchemaAction extends mfAction {
    
    const SITE_NAMESPACE = 'system/site';    
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();
        try 
      {
          $site=$this->getUser()->getStorage()->read(self::SITE_NAMESPACE);
          if (!$site) 
              throw new mfException(__("thanks to select a site"));    
          $settings=CustomerMeetingFormsSettings::load($site);
          if ($settings->get('fields_feature')!='YES')
              throw new mfException(__("This action is not permitted."));
          CustomerMeetingForms::buildSchema($site);   
          $response = array("action"=>"BuildSchema","info"=>__("Schema has been built."));
          if (!$settings->isAvailable())          
              $response['warning']=__('Schema/Data are not built.');
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
