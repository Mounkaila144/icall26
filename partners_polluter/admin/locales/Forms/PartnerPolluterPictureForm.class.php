<?php

class PartnerPolluterPictureForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(), 
            'picture'=>new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>2 * 1024 * 1024,
                                                 )
                                            ))
                );
    }
}