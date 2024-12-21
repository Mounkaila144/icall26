<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingImportForm.class.php";
class customers_meetings_imports_ajaxImportAction extends mfAction {
    
 
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        CacheFile::removeAll();
  
        $this->form=new CustomerMeetingImportForm($this->user);  
        if (!$this->form->hasFormats())
            $messages->addWarning(__('No format available'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('CustomerMeetingImport'))
            return ;
        $this->form->bind($request->getPostParameter('CustomerMeetingImport'),$request->getFiles('CustomerMeetingImport')); 
        try
        {
            if ($this->form->isValid())
            {             
                $import=new CustomerMeetingImportFile();
                $file=$this->form['file']->getValue();    
                $import->add($this->form->getValues());
                $import->setUser($this->user->getGuardUser());   
                $import->setFile($file);   
                $import->set('columns',$import->getFormat()->get('columns'));  
                $import->save();  
                $file->save($import->getFile()->getPath(),$import->get('file'));  
                $messages->addInfo(__('File has been downloaded %s',$import->get('file')));
                $request->addRequestParameter('import', $import);               
                $request->addRequestParameter('mode', $this->form->getValue('mode'));     
                 mfContext::getInstance()->getEventManager()->notify(new mfEvent($this, 'meetings.import.clear.cache'));   
                $this->forward('customers_meetings_imports','ajaxProcessImport');   
               
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


