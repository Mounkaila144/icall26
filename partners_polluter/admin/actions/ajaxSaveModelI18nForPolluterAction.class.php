<?php


 require_once dirname(__FILE__)."/../locales/Forms/PartnerPolluterModelForPolluterForm.class.php";
 
class  partners_polluter_ajaxSaveModelI18nForPolluterAction extends mfAction {
    
    
    
   
        
    function execute(mfWebRequest $request) {                  
        $messages = mfMessages::getInstance();            
        $this->form = new PartnerPolluterModelForPolluterForm($request->getPostParameter('PolluterModelI18n'));                    
        try
        {            
            $this->item_i18n=new PartnerPolluterModelI18n($this->form->getDefault('model_i18n'));               
            $this->form->bind($request->getPostParameter('PolluterModelI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item_i18n->add($this->form['model_i18n']->getValues());
                $this->item_i18n->getModel()->add($this->form['model']->getValues());  
                if ($this->item_i18n->getModel()->isExist() || $this->item_i18n->isExist())
                            throw new mfException (__("Model already exists"));                                                      
                if ($this->item_i18n->isNotLoaded())                
                {                           
                    $this->item_i18n->set('model_id',$this->item->getModel());                                                                                                                                                             
                }         
                $this->item_i18n->getModel()->save();
                $this->item_i18n->save();
                $messages->addInfo(__('Model has been saved.'));
                $request->addRequestParameter('lang',$this->item_i18n->get('lang'));
                $request->addRequestParameter('polluter',$this->item_i18n->getModel()->getPolluter());
                $this->forward('partners_polluter','ajaxListPartialModelI18nForPolluter');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item_i18n->getModel()->add($this->form['model']->getValues());
               $this->item_i18n->add($this->form['model_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
        $this->country=$this->getUser()->getCountry();
   }

}

