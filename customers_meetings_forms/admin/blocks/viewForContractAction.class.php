<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewFormsForContractForm.class.php";        

class customers_meetings_forms_viewForContractActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {         
        $this->contract=$this->getParameter('contract');  
        if ($this->contract->isNotLoaded())
            return ;
        $this->form=new CustomerMeetingViewFormsForContractForm($this->getUser(),$this->contract,array());  
     //  echo "<pre>"; var_dump($this->form->getDefaults()); echo "</pre>";
       
     /*   foreach ($this->form->getSchemaForms() as $form_name=>$form)
        {
          //  echo "<pre>"; var_dump($this->form->getDefaults()[$form->get('name')]); echo "</pre>";
            
            echo "[".$form->getI18n()->get('value')."]<br>";
            foreach ($form->getFormfields() as $formfield_name=>$formField)
            {   
                
               echo "i18n=".$formField->getI18n()->get('request');
              // echo "Form Name=".$form->get('name')." Field=".$formField->get('name')." Default=".$this->form->default_values[$form->get('name')][$formField->get('name')];
               echo "<br/>"; 
              //  var_dump($formField->get('widget'));
                
            }    
        }  */
        //var_dump($this->form->getSchemaForms());
    } 
    
    
}