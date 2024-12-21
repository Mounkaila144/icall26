<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusCallIconForm.class.php";

class customers_meetings_ajaxSaveIconStatusCallI18nAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();      
        $response=null;
        $form = new CustomerMeetingStatusCallIconForm();                
        $form->bind($request->getPostParameter('CustomerMeetingStatusCall'),$request->getFiles('CustomerMeetingStatusCall'));
        try
        {
            if ($form->isValid())
            {    
                $item=new CustomerMeetingStatusCallI18n((string)$form['id']);                              
                if ($item->isLoaded() && $form->hasValue('icon'))
                {  
                    $file=$form->getValue('icon');                    
                    $item->getStatus()->getIcon()->remove(); // remove actual file                                                        
                    $file->save($item->getStatus()->getIcon()->getPath()); 
                    $item->getStatus()->set('icon',$file->getFilename());
                    $item->getStatus()->save();                      
                    $response=array("icon"=>$item->getStatus()->get('icon'),
                                    "id"=>$item->getStatus()->get('id'));
                }  
            }                
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        return $messages->hasMessages('error')?array("error"=>$messages->getDecodedErrors()):$response;
    }

}

