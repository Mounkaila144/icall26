<?php


class CustomerMeetingCommentNewForm extends CustomerMeetingCommentBaseForm {
                    
    function configure()
    {
        parent::configure();       
        unset($this['id']);
    }
}

