<?php
// Destination sur un site
// Mettre le zip dans un rep temporaire
// regarde le nombre de modules dir sous le root
// MAJ du moduleAdmin

class moduleLoadForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'zip'=>new mfValidatorZipFile(array('max_size'=>500000)))
                );
    }
    
}

class modulesmanager_ajaxLoadModuleManagerAction extends mfAction {
    
    
    
    function execute(mfWebRequest $request)
    {
         $messages = mfMessages::getInstance();   
         $this->form=new themeNewForm();
      //   $this->theme=new Themes();
         if ($request->getPostParameter('modules')!=null)
         {
            try
            { 
                $this->form->bind($request->getPostParameter('modules'),$request->getFiles('modules'));
                if ($this->form->isValid()) 
                {
                  /*  $this->theme->add(array('name'=>$this->form['name'],
                                            'application'=>$this->application
                                     ));
                    if ($this->theme->isExist())
                        throw new mfException(__("theme already exists.")); 
                    $zip=$this->form->getValue('zip');
                    $zip->extractTo($this->theme->getDirectory());
                    $zip->close();
                    $this->theme->save();
                    $messages->addInfo(__("theme [%s] has been saved",$this->theme->get('name')));
                    $this->forward("themes","ajaxList");*/
                }
                else
                {
                //  $this->theme->add($request->getPostParameter('theme')); // repopulate
                }    
            }
            catch (mfException $e)
            {
                $messages->addError($e); 
            }
         }   
    }
}

