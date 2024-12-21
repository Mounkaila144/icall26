<?php


class customers_meetings_forms_ajaxBuildDataAction extends mfAction {
    
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
          $count=CustomerMeetingForms::buildData($site);      
          $settings->set('is_schema_build','YES');
          $settings->save();
          $response = array("action"=>"BuildData","info"=>__("Data has been built - remaining data %s.",$count));
      } 
      catch (mfException $e) {
          $messages->addError($e);
      }
      return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}
