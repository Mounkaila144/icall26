<?php

require_once dirname(__FILE__)."/MarketingLeadsWpFormsStatusI18nForm.class.php";

class MarketingLeadsWpFormsStatusViewForm extends mfForm {
      
    function configure()
    {
        $this->embedForm('status', new MarketingLeadsWpFormsStatusBaseForm($this->getDefault('status')));
        $this->embedForm('status_i18n', new MarketingLeadsWpFormsStatusI18nForm($this->getDefault('status_i18n')));
        unset($this->status_i18n['id'],
            // $this->product_download_i18n['file'],
            $this->status['id']);
    }
}
