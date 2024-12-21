<?php

require_once dirname(__FILE__).'/../locales/Forms/UtilsHolidayCalendarSettingsForm.class.php';

class utils_ajaxSaveHolidaysCalendarAction extends mfAction {
    
    function execute(mfWebRequest $request) {   
        $messages = mfMessages::getInstance();   
        try 
        {
            $this->user = $this->getUser();
            $this->form=new UtilsHolidayCalendarSettingsForm($request->getPostParameter('Holidays'));
            $this->form->bind($request->getPostParameter('Holidays'));
            $this->settings = UtilsHolidayCalendarSettings::load();
            
            if ($this->form->isValid()) 
            {

                $this->settings->add($this->form->getValues());
                $this->settings->save();
                $messages->addInfo(__("Settings saved."));
                $this->forward('utils','ajaxTest');
            }  
            else
            {
                $messages->addError(__('Form has some errors.'));  
                $messages->addError(implode("<br/>", $this->form->getErrorSchema()->getErrorsMessage()["Holidays"]));  
//                echo "<pre>"; var_dump($this->form->getErrorSchema()->getErrorsMessage()["Holidays"]); echo "</pre>";
            }
        } 
        catch (mfException $e) {
            $messages->addError($e);
        }     
    }

}

