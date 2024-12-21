<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormatFileForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewFormatForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/CustomerMeetingImport.class.php";



class customers_meetings_imports_ajaxSaveFormatAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();    
        try
        {
            $this->format=new CustomerMeetingImportFormat($request->getPostParameter('CustomerMeetingReadFormat'));
            if ($this->format->isNotLoaded())
            {
                $messages->addError(__('Format is invalid'));
                $this->forward('customers_meetings_imports','ajaxListPartialFormat');
            }
            $this->form=new CustomerMeetingViewFormatForm($this->getUser(),$request->getPostParameter('CustomerMeetingReadFormat'));
            $this->form->bind($request->getPostParameter('CustomerMeetingReadFormat'));          
            if ($this->form->isValid())
            {                              
                $this->format->setFieldsValues($this->form->getFieldsValues());
                $this->format->save();
                $messages->addInfo(__("Format has been updated."));
                $this->forward('customers_meetings_imports','ajaxListPartialFormat');
            }   
            else
            {
                $messages->addError(__("Form has some errors"));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('missings')));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('doubles')));
             // echo "<pre>"; var_dump($this->form->getErrorSchema()->getNamedErrorMessage('missings')); echo "</pre>"; 
              //  echo "<pre>"; var_dump($this->form->errorSchema['missings']); echo "</pre>"; 
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }
    
}


