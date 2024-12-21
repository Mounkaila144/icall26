<?php

class cron_test2Action extends cronAction {
    
    function execute()
    {

      $this->getCron()->getReport()->addMessage("ok impeccable");
    }
}
