<?php
 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeZoneViewForm.class.php";

class app_domoprime_ajaxSaveZoneAction extends mfAction {
    
        
    
        
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                      
        $this->form= new DomoprimeZoneViewForm();
        $this->item=new DomoprimeZone($request->getParameter('DomoprimeZone'));
        try
        {
            if ($request->isMethod('POST') && $request->getParameter('DomoprimeZone'))
            {
                $this->form->bind($request->getParameter('DomoprimeZone'));

                if ($this->form->isValid())
                {
                    $this->item->add($this->form->getValues());
                    $this->item->save();
                    $messages->addInfo(__("Zone has been updated."));
                    $this->forward('app_domoprime', 'ajaxListPartialZone');
                }    
                else 
                {
                        echo '<pre>';var_dump($this->form->getErrorSchema()->getErrorsMessage());echo'</pre>';
                    $messages->addError(__("Form has some errors."));
                    $this->item->add($request->getParameter('DomoprimeZone'));
                }
            }  
        }
        catch (mfException $e)
        {
             $messages->addError($e);
        }
    }

}
