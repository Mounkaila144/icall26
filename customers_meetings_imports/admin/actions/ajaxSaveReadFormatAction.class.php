<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormatFileForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingFormatForm.class.php";
require_once dirname(__FILE__)."/../locales/Imports/CustomerMeetingImport.class.php";

class customers_meetings_imports_ajaxSaveReadFormatAction extends mfAction {
    
       
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();    
        try
        {
            $this->form=new CustomerMeetingFormatForm($this->getUser(),$request->getPostParameter('CustomerMeetingReadFormat'));          
            $this->form->bind($request->getPostParameter('CustomerMeetingReadFormat'));         
            if ($this->form->isValid())
            {
                $format=new CustomerMeetingImportFormat();
                $format->set('name',$this->form['name']->getValue());
                if ($format->isExist())
                    throw new mfException(__('Format already exists.'));
               // var_dump($this->form->getFieldsValues());
                $format->setFieldsValues($this->form->getFieldsValues());
                $format->save();
                $messages->addInfo(__("Format has been created."));
                $this->forward('customers_meetings_imports','ajaxListPartialFormat');
            }   
            else
            {
                $messages->addError(__("Form has some errors"));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('missings')));
                $messages->addError(implode("<br/>",$this->form->getErrorSchema()->getNamedErrorMessage('doubles')));
//                echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()); echo "</pre>"; 

            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
    }
}


