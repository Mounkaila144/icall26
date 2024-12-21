<?php


class CustomerMeetingSmsPreviewForm extends mfForm {
    
    
    function configure()
    {
        $this->setValidators(array(
            'meeting_id'=>new ObjectExistsValidator('CustomerMeeting',array('key'=>false)),
            'model_i18n_id'=>new ObjectExistsValidator('CustomerModelSmsI18n',array('key'=>false))
        ));
    }
    
    function getMeeting()
    {
        return $this['meeting_id']->getValue();
    }
    
    function getModelI18n()
    {
        return $this['model_i18n_id']->getValue();
    }
}