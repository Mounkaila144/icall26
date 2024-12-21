<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerContractStatusIconForm.class.php";

class customers_contracts_ajaxSaveIconStatusI18nAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request) {      
        $messages = mfMessages::getInstance();       
        $response=null;
        $form = new CustomerContractStatusIconForm();                
        $form->bind($request->getPostParameter('CustomerContractStatus'),$request->getFiles('CustomerContractStatus'));
        try
        {
            if ($form->isValid())
            {    
                $item=new CustomerContractStatusI18n((string)$form['id']);                              
                if ($item->isLoaded() && $form->hasValue('icon'))
                {  
                    $file=$form->getValue('icon');                    
                    $item->getCustomerContractStatus()->getIcon()->remove(); // remove actual file                                                             
                    $file->save($item->getCustomerContractStatus()->getIcon()->getPath()); 
                    $item->getCustomerContractStatus()->set('icon',$file->getFilename());
                    $item->getCustomerContractStatus()->save();                
                    $response=array("icon"=>$item->getCustomerContractStatus()->get('icon'),
                                    "id"=>$item->getCustomerContractStatus()->get('id'));
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

