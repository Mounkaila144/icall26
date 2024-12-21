<?php
require_once dirname(__FILE__)."/../locales/Forms/UtilsGoogleSheetSettingsForm.class.php";

class utils_google_sheet_ajaxSettingsAction extends mfAction
{
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();
        $this->form=new UtilsGoogleSheetSettingsForm();
        $this->settings= new UtilsGoogleSheetSettings();
        if ($request->isMethod('POST') && $request->getPostParameter('UtilsGoogleSheet'))
        {
            try
            {
                $this->form->bind($request->getPostParameter('UtilsGoogleSheet') ,$request->getFiles('UtilsGoogleSheet'));
                if ($this->form->isValid())
                {
                    $this->settings->set('redirect_uri',$this->form->getValue('redirect_uri'));
                    $this->form->getValue('file')!=null?$this->settings->set('google_oauth_configs',file_get_contents($this->form->getValue('file')->getTempName())):null;
                    $this->settings->save();
                    $messages->addInfo(__("File have been saved."));
                }
                else
                {
                    $this->settings->add($request->getPostParameter('UtilsGoogleSheet')); // Repopulate
                    $messages->addError(__('File save has some errors.'));
                    echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo '</pre>';
                }
            }
            catch (mfException $e)
            {
                $messages->addError($e);
            }
        }
    }

}
