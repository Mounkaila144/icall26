<?php

class site_siteHolidaysAction extends cronAction {
    
    function execute()
    {
     // echo "task cron=".__METHOD__."\n" ;
      
      $this->getCron()->getReport()->addMessage("ok site holidays");
    }
}
