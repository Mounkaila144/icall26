<?php

class userAccountPictureForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(), 
            'picture'=>new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>500000,
                                    'filename'=>"picture",
                                                 )
                                            ))
                );
    }
}