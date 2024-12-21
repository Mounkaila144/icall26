<?php

class mfCronController extends mfCronControllerCore {
    
    const file="cron_report.log";
           
    function run($cron=null) {
        if ($cron==null)
            return $this->runAll();
        
        $this->updateDatabase();
        if (!$cron instanceof Cron)
            $cron=new Cron($cron);
        if ($cron->isLoaded())
        {               
           $this->forward($cron);
           $cron->setLastExecution();
           $cron->save();
           $cron->getReport()->save();
           return true;
        }    
        return false;        
    }
       
    function runAll()
    {
     /*  $time=time(); //-3600*21;
       $period="0|19|*|*|*";
       echo "Time=".date("Y-m-d H:i:s",$time)." Period=".$period."\n";
       $parser=new cronParser($period,$time);
       $parser->calcNextRun();
       var_dump($parser->getNextRunTime()); 
       return ;*/
       
       $this->updateDatabase();
       $this->schedulerStart();
       foreach ($this->loadCrons() as $cron)
       {
           try
           {
                $parser=new CronParser($cron->get('period'));                               
                $parser->calcLastRun();                          
                if ($parser->getLastRun() > strtotime($cron->get('last_execution')))
                {
                    $cron->setLastExecution();
                    $cron->save();
                    $this->forward($cron);                   
                    $cron->getReport()->save();
                }
                
             /*  $this->forward($cron);
               $cron->setLastExecution() 
                    ->setNextExecution()
                    ->save();*/
               
           }
           catch (mfErrorCronException $e)
           {
               $this->writeReport($e->getMessage()."\n"); 
               $cron->disable();
           }
           catch (Exception $e)
           {
               $cron->getReport()->addMessage("Fatal Error :".$e->getMessage()."\n");
               $cron->disable(); // disable cron with error
               $cron->getReport()->save();
           }
       } 
       $this->schedulerStop();
       return true;
    }
    

}

