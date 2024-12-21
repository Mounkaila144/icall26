<?php

require_once dirname(__FILE__)."/../locales/Forms/DomoprimeRegionPriceForClassNewForm.class.php";

class app_domoprime_ajaxNewRegionPriceForClassAction extends mfAction {
    
       
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();          
         $this->class=$request->getRequestParameter('class',new DomoprimeClass($request->getPostParameter('DomoprimeClass')));
        if ($this->class->isNotLoaded())
            return ;
        $this->form= new DomoprimeRegionPriceForClassNewForm($request->getPostParameter('DomoprimeClassRegionPrice'));
        $this->item=new DomoprimeClassRegionPrice($request->getPostParameter('DomoprimeClassRegionPrice')); 
        if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeClassRegionPrice'))
            return ;
        $this->form->bind($request->getPostParameter('DomoprimeClassRegionPrice'));
        try
        {
            if ($this->form->isValid())
            {
                $this->item->add($this->form->getValues());
                $this->item->set('class_id',$this->class);
                if ($this->item->isExist())
                    throw new mfException(__('Price already exists.'));
                $this->item->save();
                $messages->addInfo(__('Price has been created.'));  
                $request->addRequestParameter('class', $this->class);
                $this->forward('app_domoprime','ajaxListPartialRegionPriceForClass');
            }   
            else
            {
                $messages->addError(__('Form has some errors.'));
                $this->item->add($this->form->getDefaults());
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
