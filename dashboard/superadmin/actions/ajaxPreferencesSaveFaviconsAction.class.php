<?php

class preferencesFaviconForm extends mfForm {

    function configure() { 
        $this->setValidators(array(            
            'favicon'=>new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_categories'=>array('web_favicon' => array('image/jpeg','image/pjpeg','image/png','image/x-ico','image/x-icon','image/x-png','image/gif')),
                                    'mime_types' => 'web_favicon',
                                    'max_size'=>20000,
                                    'filename'=>"favicon",
                                                 )
                                            ))            
                );
    }
}


class dashboard_ajaxPreferencesSaveFaviconsAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
         $messages = mfMessages::getInstance();   
          try 
          {
             // var_dump($_POST,$_FILES);
               $form = new preferencesFaviconForm();
               $form->bind($request->getPostParameter('preferences'),$request->getFiles('preferences'));
               $settings=new PreferencesSettings();
               
              if ($form->isValid())
              {   
                if ($form->hasValue('favicon'))
                {    
                $file=$form->getValue('favicon');
                $file->save($settings->getFavicon()->getPath());
                $field='favicon'.($file->getExtension()=='ico'?"_ico":"");
                $settings->set($field,$file->getFilename()); 
                
              //  var_dump($settings);
                $settings->save();
                
                $response=array("favicon"=>$settings->get($field),"ico"=>($file->getExtension()=='ico'?true:false));
                }
              }
              else
                  $messages->addErrors($form->getErrorSchema()->getErrors());
              
              
          } 
          catch (mfException $e) {
              $messages->addError($e);
          }
          return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;  
    }
	
}

