<?php

require_once dirname(__FILE__)."/../locales/Forms/MarketingLeadsWpFormsLeadsImportFormatFileForm.class.php";

class marketing_leads_ajaxNewFormatFromFileAction extends mfAction {

    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                     
        $this->form=new MarketingLeadsWpFormsLeadsImportFormatFileForm($request->getPostParameter('WpFormsLeadsImportFormat'));
    }
}
