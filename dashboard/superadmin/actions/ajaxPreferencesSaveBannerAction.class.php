<?php

class preferencesBannerForm extends mfForm {

    function configure() { 
        $this->setValidators(array(            
            'banner'=>new mfValidatorFile(array(
                                    'required'=>false,                                    
                                    'mime_types' => 'web_images',
                                    'max_size'=>200000,
                                    'filename'=>"banner",
                                                 )
                                            ))            
                );
    }
}


class dashboard_ajaxPreferencesSaveBannerAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
         $messages = mfMessages::getInstance();   
          try 
          {
             // var_dump($_POST,$_FILES);
               $form = new preferencesBannerForm();
               $form->bind($request->getPostParameter('preferences'),$request->getFiles('preferences'));
               $settings=new PreferencesSettings();
               
              if ($form->isValid())
              {   
                if ($form->hasValue('banner'))
                {    
                $file=$form->getValue('banner');
                $file->save($settings->getBanner()->getPath());                
                $settings->set('banner',$file->getFilename()); 
                
              //  var_dump($settings);
                $settings->save();
                
                $response=array("banner"=>$settings->get('banner'));
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

