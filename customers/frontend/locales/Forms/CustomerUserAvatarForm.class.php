<?php


 
class CustomerUserAvatarForm extends mfForm {

    function configure() { 
        $this->setValidators(array(            
            'avatar'=>new mfValidatorFile(array(                                   
                                    'mime_types' => 'web_images',
                                    'max_size'=>2048 * 1024,                                 
                                                 )
                                            ))
                );
    }
}