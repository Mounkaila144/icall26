<?php



class PartnerPolluterModelPdfImportArchiveForPolluterForm extends mfForm {



    function configure() {
        $this->setValidators(array(
            "file"=>new mfValidatorFile(array('max_size'=>32 * 1024 * 1024,
                                              'mime_types'=>array('application/zip'))),
        ));
    }

    function getZip()
    {
        return $this['file']->getValue();
    }



}
