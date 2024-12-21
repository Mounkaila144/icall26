<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerContractRangeViewForm.class.php";
 
class  customers_contracts_ajaxSaveRangeI18nAction extends mfAction {
    
    
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerContractRangeViewForm($request->getPostParameter('CustomerContractRangeI18n'));                    
        try
        {            
            $this->item=new CustomerContractRangeI18n($this->form->getDefault('range_i18n'));               
            $this->form->bind($request->getPostParameter('CustomerContractRangeI18n'),$request->getFiles('CustomerContractRangeI18n'));                            
            if ($this->form->isValid())
            {              
                $this->item->add($this->form['range_i18n']->getValues());
                $this->item->getRange()->add($this->form['range']->getValues());  
                if ($this->item->getRange()->isExist() || $this->item->isExist())
                            throw new mfException (__("range already exists"));                                                      
                if ($this->item->isNotLoaded())                
                {                           
                    $this->item->set('range_id',$this->item->getRange());                                                                                                                                                              
                }         
                $this->item->getRange()->save();
                $this->item->save();
                $messages->addInfo(__('Range has been saved.'));
                $request->addRequestParameter('lang',$this->item->get('lang'));
                $this->forward('customers_contracts','ajaxListPartialRange');
            }   
            else
            {                    
               $messages->addError(__('Form has some errors.'));              
               $this->item->getRange()->add($this->form['range']->getValues());
               $this->item->add($this->form['range_i18n']->getValues());   
            } 
        }
        catch (mfException $e)
        {
            $messages->addError($e);
          //  echo "<pre>"; var_dump($this->item->getRange()); echo "</pre>"; 
        }
   }

}

