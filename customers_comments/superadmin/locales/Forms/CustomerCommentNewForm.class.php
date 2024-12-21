<?php


class CustomerCommentNewForm extends CustomerCommentBaseForm {
                    
    function configure()
    {
        parent::configure();       
        unset($this['id']);
    }
}

