<?php

class CompanySignatureForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(), 
            'signature'=>new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>1 * 1024 * 1024,
                                                 )
                                            ))
                );
    }
}