<?php

require_once dirname(__FILE__)."/../locales/Forms/CustomerMeetingViewForms.class.php";        

class customers_meetings_forms_viewActionComponent extends mfActionComponent {

    
    function execute(mfWebRequest $request)
    {         
        $meeting=$this->getParameter('meeting');             
        $this->form=new CustomerMeetingViewForms($this->getUser(),$meeting,array());                                    
        // echo "info";
     //   $this->forms=new CustomerMeetingNewForms(array(),$this->site);
       // var_dump($this->forms->getValidatorSchema());
     //   var_dump($this->form->getValidatorSchema()->getSchema());
        
      /*  foreach ($this->forms->getValidatorSchema()->getSchema() as $name=>$form)
        {
            if ($name!='token')
                var_dump($form->getSchema()); //->form1['f1']); 
        }   */
       //var_dump($this->forms); //->form1['f1']);
       // var_dump($this->forms);
      //  return mfView::NONE;
    } 
    
    
}