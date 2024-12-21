<?php

class themes_ajaxNewThemeAdminAction extends mfAction {
    
    protected $application='admin';  // by default
    
    function execute(mfWebRequest $request)
    {
         $messages = mfMessages::getInstance();   
         $this->form=new themeNewForm();
         $this->theme=new Themes();
         if ($request->getPostParameter('theme')!=null)
         {
            try
            { 
                $this->form->bind($request->getPostParameter('theme'),$request->getFiles('theme'));
                if ($this->form->isValid()) 
                {
                    $this->theme->add(array('name'=>$this->form['name'],
                                            'application'=>$this->application
                                     ));
                    if ($this->theme->isExist())
                        throw new mfException(__("theme already exists.")); 
                    $zip=$this->form->getValue('zip');
                    $zip->extractTo($this->theme->getDirectory());
                    $zip->close();
                    $this->theme->save();
                    $messages->addInfo(__("theme [%s] has been saved",$this->theme->get('name')));
                    $this->forward("themes","ajaxList");
                }
                else
                {
                  $this->theme->add($request->getPostParameter('theme')); // repopulate
                }    
            }
            catch (mfException $e)
            {
                $messages->addError($e); 
            }
         }   
    }
}

