<?php

require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelPdfNewForPolluterForm.class.php";

class partners_polluter_ajaxSaveNewPDFModelI18nForPolluterAction extends mfAction {
    
        
            
    function execute(mfWebRequest $request) {                     
        $messages = mfMessages::getInstance();                                    
        try
        {      
            $this->polluter=new PartnerPolluterCompany($request->getPostParameter('Polluter'));
            if ($this->polluter->isNotLoaded())
                    return ;
            $this->form= new PartnerPolluterModelPdfNewForPolluterForm($this->getUser()->getCountry(),$request->getPostParameter('PolluterModel'));             
            $this->item_i18n=new PartnerPolluterModelI18n();
            $this->form->bind($request->getPostParameter('PolluterModel'),$request->getFiles('PolluterModel'));
            if ($this->form->isValid())
            {
                $this->item_i18n->getModel()->add($this->form['model']->getValues());
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                if ($this->item_i18n->isExist())
                    throw new mfException (__("Model already exists"));    
                if ($this->item_i18n->getModel()->isExist())
                    throw new mfException (__("Model already exists."));      
                $this->item_i18n->getModel()->set('polluter_id',$this->polluter);
                $this->item_i18n->getModel()->save();
                $this->item_i18n->set('model_id',$this->item_i18n->getModel());                                                                                                                                                                                                     
                 if ($this->form['model_i18n']->hasValue('file'))
                {                    
                    $file=$this->form['model_i18n']['file']->getValue();                     
                    $this->item_i18n->setFile($file);                               
                }              
                $this->item_i18n->save();
                if ($file)
                {
                    $file->save($this->item_i18n->getFile()->getPath()); 
                    $this->item_i18n->loadVariablesFromFile();    
                    $this->item_i18n->save();
                } 
                                
                $messages->addInfo("Model has been saved.");
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $request->addRequestParameter('polluter',$this->polluter);                
                $this->forward('partners_polluter','ajaxListPartialModelI18nForPolluter');
            }   
            else
            {               
                // Repopulate
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                $this->item_i18n->getModel()->add($this->form['model']->getValues());
                $messages->addError(__("Form has some errors.")); 
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }    
        $this->country=$this->getUser()->getCountry();
    }

}
