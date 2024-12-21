<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportForm.class.php";

class marketing_leads_ajaxImportAction extends mfAction {
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();      
        $this->user=$this->getUser();
        $this->form=new MarketingLeadsWpFormsLeadsImportForm($this->user);  
        if (!$this->form->hasFormats())
            $messages->addWarning(__('No format available'));
        if (!$request->isMethod('POST') || !$request->getPostParameter('WpFormsLeadsImport'))
            return ;
        $this->form->bind($request->getPostParameter('WpFormsLeadsImport'),$request->getFiles('WpFormsLeadsImport')); 
        try
        {
            if ($this->form->isValid())
            {
                $import = new MarketingLeadsWpFormsLeadsImportFile();
                $file = $this->form['file']->getValue();    
                $import->add($this->form->getValues());
                $import->setUser($this->user->getGuardUser());   
                $import->setFile($file);   
                $import->set('columns',$import->getFormat()->get('columns'));  
                $import->save();  
                $file->save($import->getFile()->getPath(),$import->get('file'));  
                $messages->addInfo(__('File has been downloaded %s',$import->get('file')));
                $request->addRequestParameter('import', $import);               
                $request->addRequestParameter('mode', $this->form->getValue('mode'));               
                $this->forward('marketing_leads','ajaxProcessImport');   
            }   
            else
            {
                $messages->addError(__("Form has some errors")); 
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);  
        }
    }
}


