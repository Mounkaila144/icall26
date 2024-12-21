<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportDirectForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/Forms/CustomerMeetingImportForm.class.php";

class customers_meetings_imports_ajaxImportDirectAction extends mfAction {
    
           
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->form=new CustomerMeetingImportDirectForm($this->user);          
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingImport'))
            return ;
        $this->form->bind($request->getPostParameter('CustomerMeetingImport'),$request->getFiles('CustomerMeetingImport')); 
        try
        {
            if ($this->form->isValid())
            {
                $this->import=new CustomerMeetingImportFile();
                $file=$this->form['file']->getValue();    
                $this->import->add($this->form->getValues());
                $this->import->setUser($this->user->getGuardUser());   
                $this->import->setFile($file);                   
                $this->import->save();  
                $file->save($this->import->getFile()->getPath(),$this->import->get('file'));  
                 
                $form=new CustomerMeetingImportForm($this->getUser());              
                $this->fields=$form->getFieldsI18n();    
                mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meetings.import.clear.cache'));   
                $messages->addInfo(__('File [%s] has been uploaded.',$this->import->get('file')));               
            }   
            else
            {
                $messages->addError(__("Form has some errors"));
//                echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>";  
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);  
        } 
    }
}


