<?php


class CustomerMeetingStatusCallIconForm extends mfForm {

    function configure() { 
        $this->setValidators(array(
            'id'=>new mfValidatorInteger(),              
            'icon'=>new mfValidatorFile(array(
                                    'required'=>false,
                                    'mime_types' => 'web_images',
                                    'max_size'=>200000,     
                                    'filename'=>'icon'
                                                 )
                                            ))
                );
    }
}
 