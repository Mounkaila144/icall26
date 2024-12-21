<?php

class DomoprimePolluterPropertyViewForm extends DomoprimePolluterPropertyBaseForm {
    
    function configure()
    {
        parent::configure();
        unset($this['id']);
    }
}
