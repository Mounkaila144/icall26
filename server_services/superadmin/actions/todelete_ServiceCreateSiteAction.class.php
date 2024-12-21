<?php

require_once __DIR__."/../locales/Forms/CreateSiteForm.class.php";

class server_services_ServiceCreateSiteAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
       $messages = mfMessages::getInstance();                    
      // echo "<pre>"; var_dump($request->getPostParameters());
       try
      { 
            $form=new CreateSiteForm();
            $form->bind($request->getPostParameters());
            if($form->isValid())
            {
                $site=new Site($form->getHost());
                if ($site->isExist())        
                    return array('status'=>'KO','error'=>'site already exists');
                $site->add($form->getValues());
                if ($site->isDatabaseExist())
                    return array('status'=>'KO','error'=>'database already exists'); 
                $site->save();                 
                // create DB
                mfSiteDatabase::getInstance()->createDatabase($site);
                $response=array('status'=>'OK');
            }
            else
            {
                $response=array('status'=>'KO','error'=> $form->getErrorSchema()->getErrorsMessage());
            }
      }
      catch (mfException $e)
      {
            $messages->addError($e);
            return array('error'=>$messages->getDecodedErrors());
      }  
      return $response;
    }

}
