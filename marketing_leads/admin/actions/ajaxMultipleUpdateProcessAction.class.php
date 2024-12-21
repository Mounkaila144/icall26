<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleMarketingLeadsSelectionForm.class.php";
require_once dirname(__FILE__)."/../locales/Forms/MultipleMarketingLeadsProcessSelectionForm.class.php";


class marketing_leads_ajaxMultipleUpdateProcessAction extends mfAction {
  
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();    
        $this->user=$this->getUser();
        $this->form_multiple = new MultipleMarketingLeadsSelectionForm($this->getUser(),$request->getPostParameter('MultipleMarketingLeadsSelection'));                
        $this->form_multiple->bind($request->getPostParameter('MultipleMarketingLeadsSelection'));
        try
        {
            if ($this->form_multiple->isValid())
            {
               $this->form = new MultipleMarketingLeadsProcessSelectionForm($this->getUser());
               $this->form->setSelection($this->form_multiple->getSelection());
//               mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this->form, 'marketing.leads.multiple.form.config'));   
            }  
            else
            {
                //  var_dump($this->form->getErrorSchema()->getErrorsMessage());
                $messages->addError(__("Form has some errors."));
            }
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
