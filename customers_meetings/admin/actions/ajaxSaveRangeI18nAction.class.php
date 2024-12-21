<?php


 require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingRangeViewForm.class.php";
 
class  customers_meetings_ajaxSaveRangeI18nAction extends mfAction {
    
    
    
    function preExecute()
    {
       $this->getResponse()->addJavascript('ui/i18n/jquery.ui.datepicker-'.str_replace('_','-',$this->getUser()->getCulture()).'.js');
    }
        
    function execute(mfWebRequest $request) {                    
        $messages = mfMessages::getInstance();     
        $this->form = new CustomerMeetingRangeViewForm($request->getPostParameter('CustomerMeetingRangeI18n'));                    
        try
        {            
            $this->item=new CustomerMeetingRangeI18n($this->form->getDefault('range_i18n'));               
            $this->form->bind($request->getPostParameter('CustomerMeetingRangeI18n'),$request->getFiles('CustomerMeetingRangeI18n'));                            
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
                $this->forward('customers_meetings','ajaxListPartialRange');
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

