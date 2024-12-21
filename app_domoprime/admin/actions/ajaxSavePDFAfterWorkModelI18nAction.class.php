<?php


require_once dirname(__FILE__)."/../locales/Forms/DomoprimeAfterWorkModelPdfViewForm.class.php";
 
class  app_domoprime_ajaxSavePDFAfterWorkModelI18nAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                  
        $messages = mfMessages::getInstance(); 
        $this->user=$this->getUser();
        $this->form = new DomoprimeAfterWorkModelPdfViewForm($request->getPostParameter('AfterWorkModelI18n'),$request->getFiles('AfterWorkModelI18n'));                    
        try
        {            
            $this->item_i18n=new DomoprimeAfterWorkModelI18n($this->form->getDefault('model_i18n'));               
            $this->form->bind($request->getPostParameter('AfterWorkModelI18n'),$request->getFiles('AfterWorkModelI18n'));                            
            if ($this->form->isValid())
            {                                       
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                $this->item_i18n->getModel()->add($this->form->getValue('model'));                                
               if ($this->item_i18n->getModel()->isExist() || $this->item_i18n->isExist())
                    throw new mfException (__("Model already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                                                         
                    $this->item_i18n->set('model_id',$this->item_i18n->getModel());                                                                                                                                                                             
                $this->item_i18n->getModel()->save();                                 
                $this->item_i18n->save();            
             //   var_dump($this->form['model_i18n']->hasValue('file'));
                if ($this->form['model_i18n']->hasValue('file'))
                {                                        
                    $file=$this->form['model_i18n']['file']->getValue();                     
                    $this->item_i18n->setFile($file);                                                   
                    $file->save($this->item_i18n->getFile()->getPath());                 
                    $this->item_i18n->loadVariablesFromFile();  
                    $this->item_i18n->save();    
                }
                $messages->addInfo(__('Model has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));      
                $this->forward('app_domoprime','ajaxListPartialAfterWorkModel');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item_i18n->getModel()->add($this->form['model']->getValues());
               $this->item_i18n->add($this->form['model_i18n']->getValues());   
              // var_dump($this->form->getErrorSchema()->getErrorsMessage());
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        $this->country=$this->getUser()->getCountry();
   }

}

