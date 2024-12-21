<?php

class GoogleOauthSettingConfigFileUploadForm extends mfForm {
    
    function configure() {
        $this->setValidators(array(
            'file'=>new mfValidatorFile(array('max_size'=>16 * 1024 * 1024 * 1024))
        ));
    }
    
    function getSettings()
    {
        return $this->settings=$this->settings===null?new GoogleOauthSettings():$this->settings;
    }
    
    function getFile()
    {
        return $this['file']->getValue();
    }
    
    
    function isValid()
    {
        if (parent::isValid())
        {
            if ($this->processed)
                return true;
            $this->processed=true;                        
            $this->getSettings()->set('google_oauth_configs',file_get_contents($this->getFile()->getTempName()));
            return true;
        }    
        return false;
    }
    
}

class google_oauth_ajaxUploadConfigAction extends mfAction {
       
    
    function execute(mfWebRequest $request) {               
        $messages = mfMessages::getInstance();    
        try
        {            
            $form=new GoogleOauthSettingConfigFileUploadForm($this->getUser(),$request->getPostParameter('GoogleOauthSettingConfigFileUpload'));
            $form->bind($request->getPostParameter('GoogleOauthSettingConfigFileUpload'),$request->getFiles('GoogleOauthSettingConfigFileUpload'));
            if ($form->isValid())
            {                         
                  $form->getSettings()->save();
                  
                  $response = array("action"=>"UploadConfig",
                            "info"=>__("Config has been uploaded."),
                             ); 
            }           
            else
            {
                $response=array('errors'=>$form->getErrorSchema()->getErrorsMessage());
            }    
        }
        catch (mfException $e)
        {           
            $response=array('errors'=>$e->getMessage());
         // $response['error']=true;
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()->toArray()):$response;        
    }
    
   
}


 
