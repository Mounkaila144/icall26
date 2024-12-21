<?php
require_once dirname(__FILE__)."/CustomerMeetingImportGoogleSheetFormatForm.class.php";


class CustomerMeetingImportGoogleSheetFormatViewForm extends CustomerMeetingImportGoogleSheetFormatForm {
                
        function configure()
        {
            parent::configure();
            $this->setValidator('id', new mfValidatorInteger());
        }
}

