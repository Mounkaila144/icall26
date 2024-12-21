<?php

require_once dirname(__FILE__)."/../locales/Forms/MultipleMarketingLeadsProcessSelectionForm.class.php";


class marketing_leads_ajaxMultipleProcessSelectionAction extends mfAction {
    
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();                        
        $this->user=$this->getUser();
        $this->form=new MultipleMarketingLeadsProcessSelectionForm($this->getUser(),$request->getPostParameter('MutipleMarketingLeadsSelection'));
//        mfContext::getInstance()->getEventManager()->notify(new mfEvent( $this->form, 'marketing.leads.multiple.form.config'));   
        $this->form->bind($request->getPostParameter('MutipleMarketingLeadsSelection'));
        try
        {
            if ($this->form->isValid())  
            {     
                //  var_dump($this->form->getValues());                         
                if ($this->form->hasAction('state'))
                    $messages->addInfo(__("State has been modified on selection."));
                $multiple=new MarketingLeadsWpFormsMultipleProcess($this->form['actions']->getValue(),$this->form->getSelection(),$this->form->getValues());
                $multiple->process();              
                mfContext::getInstance()->getEventManager()->notify(new mfEvent( $multiple, 'marketing.leads.multiple.process'));                         
                $messages->addInfos($multiple->getMessages());         
            }  
            else
            {
                // var_dump($this->form->getErrorSchema()->getErrorsMessage());
                //var_dump($this->form->getDefaults());
                //  echo "<pre>"; var_dump($request->getPostParameter('MultipleMeetingSelection')); echo "</pre>";
                $messages->addError(__("Form has some errors."));
            }    
        }
        catch (mfException $e)
        {
            $messages->addError($e);
        }
    }

}
