<?php
// Destination sur un site
// Mettre le zip dans un rep temporaire
// regarde le nombre de modules dir sous le root
// MAJ du moduleAdmin


class modules_manager_ajaxSaveLoadModuleManagerAdminAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();          
        $this->form=new moduleAdminLoadForm();               
        try
        { 
            $this->form->bind($request->getPostParameter('modules'),$request->getFiles('modules'));
            if ($this->form->isValid()) 
            {    
                $zip=$this->form->getValue('file');
                $module=new moduleManagerAdmin($zip->getOriginalFilename());
                $module->setConfigFromFile();
                if ($module->isExist())
                    throw new mfException(__("module already exists."));
                $zip->extractTo($module->getCoreDirectory());
                $zip->close();
                $module->setConfigFromFile();
                $module->save();
                $messages->addInfo(__("module [%s] has been saved",$module->get('name')));    
                $this->forward("modules_manager","ajaxListPartialModuleManagerAdmin");
            }                          
        }
        catch (mfException $e)
        {
            $messages->addError($e); 
        }  
    }
}

