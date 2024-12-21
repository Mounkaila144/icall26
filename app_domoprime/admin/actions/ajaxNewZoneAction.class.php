<?php

//require_once dirname(__FILE__)."/../locales/Forms/DomoprimeZoneNewForm.class.php";
 require_once dirname(__FILE__)."/../locales/Forms/DomoprimeZoneNewForm.class.php";
class app_domoprime_ajaxNewZoneAction extends mfAction {

    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();      
                          
            $this->form= new DomoprimeZoneNewForm();
            $this->item=new DomoprimeZone();
             
               if (!$request->isMethod('POST') || !$request->getPostParameter('DomoprimeZone'))
                return ;
                 
                $this->form->bind($request->getPostParameter('DomoprimeZone'));
                 try 
                {
                        if ($this->form->isValid())
                        {
                          
                            $this->item->add($this->form->getValues());
                            $this->item->save();
                            $messages->addInfo(__("Zone has been created."));
                            $this->forward('app_domoprime', 'ajaxListPartialZone');
                        }    
                        else 
                        {
                            $messages->addError(__("Form has some errors."));
                            $this->item->add($request->getParameter('DomoprimeZone'));
                        }

                }
                catch (mfException $e)
                {
                      $messages->addError($e);
                }
    }

}
