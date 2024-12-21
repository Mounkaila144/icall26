<?php

class dashboard_messagesActionComponent extends mfActionComponent {

    function execute(mfWebRequest $request) {
        $this->messages = mfMessages::getInstance();
//        var_dump();
    }

}
