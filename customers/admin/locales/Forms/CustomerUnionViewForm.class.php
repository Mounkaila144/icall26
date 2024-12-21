<?php


require_once dirname(__FILE__)."/CustomerUnionI18nForm.class.php";


class CustomerUnionViewForm extends mfForm {
      
    
            
    function configure()
    {
        $this->embedForm('union', new CustomerUnionBaseForm($this->getDefault('union')));
        $this->embedForm('union_i18n', new CustomerUnionI18nForm($this->getDefault('union_i18n')));
        unset($this->union_i18n['id'],             
              $this->union['id']);
    }

  

}
