<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingStatusLeadIconForm.class.php";

class customers_meetings_ajaxSaveIconStatusLeadI18nAction extends mfAction {
    
   
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();      
        $response=null;
        $form = new CustomerMeetingStatusLeadIconForm();                
        $form->bind($request->getPostParameter('CustomerMeetingStatusLead'),$request->getFiles('CustomerMeetingStatusLead'));
        try
        {
            if ($form->isValid())
            {    
                $item=new CustomerMeetingStatusLeadI18n((string)$form['id']);                              
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

