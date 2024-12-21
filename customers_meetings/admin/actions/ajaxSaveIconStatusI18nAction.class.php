<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusIconForm.class.php";

class customers_meetings_ajaxSaveIconStatusI18nAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();      
        $response=null;
        $form = new CustomerMeetingStatusIconForm();                
        $form->bind($request->getPostParameter('CustomerMeetingStatus'),$request->getFiles('CustomerMeetingStatus'));
        try
        {
            if ($form->isValid())
            {    
                $item=new CustomerMeetingStatusI18n((string)$form['id']);                              
                if ($item->isLoaded() && $form->hasValue('icon'))
                {  
                    $file=$form->getValue('icon');                    
                    $item->getCustomerMeetingStatus()->getIcon()->remove(); // remove actual file                                                        
                    $file->save($item->getCustomerMeetingStatus()->getIcon()->getPath()); 
                    $item->getCustomerMeetingStatus()->set('icon',$file->getFilename());
                    $item->getCustomerMeetingStatus()->save();                      
                    $response=array("icon"=>$item->getCustomerMeetingStatus()->get('icon'),
                                    "id"=>$item->getCustomerMeetingStatus()->get('id'));
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

