<?php

class mfCronControllerCore {
       
    const file="";
    protected $controllers=array(),$crons=array(),$start=null,$report=null,$cron_in_progress,$start_scheduler=0;
    
    function __construct($options=array())
    {
        $this->options=$options;
        register_shutdown_function(array($this,"shutdown"));
        $this->configure();
    }
    
    protected function openReport()
    {
        if (!$this->report=fopen(self::getReportFile(),"a+"))
            throw new mfErrorCronException("report file can no be created.\n");  
    }
    
    protected function writeReport($data) 
    {
        if (!$this->start)
           return ;              
        fwrite($this->report,$data);
    }
    
    protected function schedulerStart()
    {
       $this->start_scheduler=time();
       fwrite($this->report,sprintf("[%s] [cron]:scheduler [start]:%s\n",date("d-m-Y"),date("H:i:s",time()))); 
    }
    
    protected function schedulerStop()
    {
       fwrite($this->report,sprintf("[%s] [cron]:scheduler [stop]:%s [duration]:%.3f s\n",date("d-m-Y"),date("H:i:s",time()),time()-$this->start_scheduler)); 
    }
    
    protected function closeReport()
    {
        
        if (!$this->report)
            return ;
        fclose($this->report);
    }
    
    protected function configure()
    {
        $this->openReport();
    }
    
    function updateDatabase()
    {
        if (is_readable(mfContext::getInstance()->getConfigCache()->getCacheName('config/cron.php')))            
            return ;
        $crons=include_once mfContext::getInstance()->getConfigCache()->checkConfig('config/cron.php'); 
        
       // var_dump($crons);
        
        $cronNames=array_keys($crons);
        $db = mfSiteDatabase::getInstance();
        // clean-up : Delete not used cron
        $db->setQuery("DELETE FROM ".Cron::getTable()." WHERE name NOT IN ('".implode("','",$cronNames)."');")
           ->makeSqlQuerySuperAdmin(); 
        $cronCollection=new CronCollection();
        // get existing crons
        $db->setQuery("SELECT * FROM ".Cron::getTable()." WHERE name IN ('".implode("','",$cronNames)."');")
           ->makeSqlQuerySuperAdmin(); 
        // Update existing crons
       
        if ($db->getNumRows())
        {    
          while ($item=$db->fetchObject('Cron'))
          {      
              //   $cron=$crons[$item->get('name')];
            //  var_dump(isset($crons[$item->get('name')]),$item->get('name'));
                 unset($crons[$item->get('name')]);
              /*   $cronCollection[]=$item->loaded()
                                        ->add($cron)
                                        ->setPeriod($cron['minutes'],$cron['hours'],$cron['days'],$cron['weekdays'],$cron['months']);
                                      //  ->setNextExecution(); // update next execution*/
          }       
        }         
        // New crons
        foreach ($crons as $name=>$cron)
        {             
            $item=new Cron();
            $item->add($cron);
           // var_dump($item->get('name'));
            $cronCollection[]=$item->set('name',$name)
                                   ->setPeriod($cron['minutes'],$cron['hours'],$cron['days'],$cron['weekdays'],$cron['months']);
                                 //  ->setNextExecution(); // update next execution  
        }    
        $cronCollection->save();    
    }
    
    function getCrons()
    {
        if (!$this->crons)
           $this->loadCrons();
        return $this->crons;
    }
    
    function getListCrons()
    {
        $db = mfSiteDatabase::getInstance()
             ->setQuery("SELECT name FROM ".cron::getTable()." WHERE is_active='YES' ;") //AND (next_execution<=NOW() OR last_execution IS NULL);")
             ->makeSqlQuerySuperAdmin(); 
        if (!$db->getNumRows())
            return array(); 
        $crons=array();
        while ($row=$db->fetchArray()) 
        {
            $crons[]=$row['name'];
        }    
        return $crons;    
    }
    
    protected function loadCrons()
    {
       $db = mfSiteDatabase::getInstance()
             ->setQuery("SELECT * FROM ".cron::getTable()." WHERE is_active='YES' ;") //AND (next_execution<=NOW() OR last_execution IS NULL);")
             ->makeSqlQuerySuperAdmin(); 
       $this->crons=array();
       if (!$db->getNumRows())
            return array();
       $this->crons=new cronCollection(); 
       while ($item=$db->fetchObject('cron'))
       {      
                 $item->loaded();
                 $this->crons[]=$item;
       }
       return $this->crons;
    }
    
    static function getReportFile()
    {
        return mfConfig::get('mf_root_dir')."/log/".static::file;
    }
    
    protected function start()
    {
      $this->start=microtime(true);  
    }
    
    protected function stop()
    {
        $data=sprintf("[%s] [cron]:%s [start]:%s [stop]:%s [duration]:%.3f s\n",date("d-m-Y"),$this->cron_in_progress->get('name'),date("H:i:s",$this->start),date("H:i:s",time()),microtime(true)-$this->start);
        $this->writeReport($data);
    }
    
   protected function getControllerDirs($moduleName)
   {
      // 1- module core  2- module site
      return array(
          mfConfig::get('mf_site_dir').'/modules/'.$moduleName."/superadmin/cron",
          mfConfig::get('mf_modules_dir').DIRECTORY_SEPARATOR.$moduleName."/superadmin/crons"
          );
  }
  
    function  shutdown()
    {
        $this->closeReport();
    }
    
   protected function actionExists($moduleName,$actionName)
    {
      foreach ($this->getControllerDirs($moduleName) as $dir) 
      {
            $file = $dir . '/' . $actionName . 'Action.class.php';
            if (is_readable($file)) {
                require_once($file);
                $this->controllers[$moduleName . '_' . $actionName]= $moduleName . "_" . $actionName . 'Action';
                return true;
            }
            $module_file = $dir . '/actions.class.php';
      }
      throw new mfErrorCronException(sprintf("[cron]:%s [Action]:%s of module [%s] does not exist.", $this->cron_in_progress->get('name'),$actionName,$moduleName));
    }
    
    protected function getAction($moduleName, $actionName) {
        if (!isset($this->controllers[$moduleName . '_' . $actionName])) 
            $this->actionExists($moduleName, $actionName);
        $moduleClass = $this->controllers[$moduleName . '_' . $actionName];     
        if (class_exists($moduleClass, false)) 
             return new $moduleClass($moduleName, $actionName,$this->cron_in_progress); 
        throw new mfErrorCronException(sprintf("[cron]:%s [action class]:%s_%sAction doesn't exist.", $this->cron_in_progress->get('name'), $moduleName, $actionName));       
   }
    
     function forward($cron) {   
        
        $this->cron_in_progress=$cron;
        $this->start();
        $task=$cron->get('task');        
        if (!preg_match("#^/([^/]*)/(.*)?$#", $task, $matches)) 
           throw new mfErrorCronException(sprintf("unknown task name [%s]\n",$task));   
        $moduleName=$matches[1];
        $taskName=$matches[2];
        if (!$this->actionExists($moduleName, $taskName))
            throw new mfErrorCronException(sprintf("[cron]:%s [Action]:%s does not exist.\n", $this->cron_in_progress->get('name'),$task));
        // Get cron resources
        //require(mfContext::getInstance()->getConfigCache()->checkConfig('module/'.$moduleName.'/config/module.php',"cron_".$taskName,"cron_".$taskName)); 
      
        $actionInstance = $this->getAction($moduleName, $taskName);        
        $cron->getReport()->start(); 
        // I18n ?
        $actionInstance->execute();       
        $this->stop(); 
     }
     
     function getCron()
     {
         return $this->cron_in_progress;
     }
     
}

