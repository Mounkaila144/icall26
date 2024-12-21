<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormatDirectForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/Forms/CustomerMeetingImportForm.class.php";

class customers_meetings_imports_ajaxProcessImportDirectAction extends mfAction {
    
           
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();                                                       
        try
        {
            $this->import=new CustomerMeetingImportFile($request->getPostParameter('CustomerMeetingImportFile'));
            if ($this->import->isNotLoaded())
            {
                $messages->addError(__("File is invalid."));
                $this->forward($this->getModuleName(),'ajaxImportDirect');
            }
            $this->form=new CustomerMeetingFormatDirectForm($this->getUser(),$request->getPostParameter('CustomerMeetingImport'));          
            $this->form->bind($request->getPostParameter('CustomerMeetingImport')); 
            if ($this->form->isValid())
            {                
                $format=new CustomerMeetingImportFormat();
                $format->set('name',time());               
                $format->setFieldsValues($this->form->getFieldsValues());
                $format->save();  
                $this->import->add(array('columns'=>$format->get('columns'),
                                         'format_id'=>$format 
                                ))->save();                
                                
                $messages->addInfo(__("Download is in progress."));
                
                
            }   
            else
            {
                $messages->addError(__("Form has some errors"));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('missings')));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('doubles')));
             //   echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>"; 
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);  
        } 
        $form=new CustomerMeetingImportForm($this->getUser());              
        $this->fields=$form->getFieldsI18n();  
    }
}


