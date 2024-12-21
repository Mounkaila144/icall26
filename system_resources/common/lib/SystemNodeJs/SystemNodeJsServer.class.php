<?php
// ps -ef | grep node
//$command = $yourCommand.' > /dev/null 2>&1 & echo $!'; 
//exec($command ,$output);
//$pid = (int)$op[0];

abstract class SystemNodeJsServer extends mfSettingsBase { 

    protected  $options=null,$return=null,$log_file=null;
    
    abstract function  getProgram();
    abstract function  getDirectory();
    
    function __construct($options=array()) {         
        $this->options=$options;       
        $this->log_file=new File(mfConfig::get('mf_log_dir')."/".$this->getLogName());
        parent::__construct(null,null,'frontend');
    }
    
     
    function getOption($name,$default=null){
        return isset($this->options[$name])?$this->options[$name]:$default;
    }
    
    function getSocketHost(){
        return 'ws://'.$_SERVER['SERVER_ADDR'].':'.$this->get('port');
    }
            
    function getDefaults()
     {   
         $this->add(array(        
                            'nodejs'=>(mfTools::isWindowsServer()?'node.exe':'nodejs'),
                            'port'=>'',                     
                            'log'=>'serverjs',
                            //internal
                            'pid'=>null,
                            'host'=>'ws://127.0.0.1:8088',
                            'port'=>'8088',
                            'stun'=>'stun:stun.l.google.com:19302', 
                            'debug'=>false, 
                          ));
     }    
    
  /*  function start(){
        $this->stop();    
        $cmd=$this->get("nodejs","nodejs")." ".$this->getProgram()." ".$this->get('port')." > ".mfConfig::get('mf_log_dir')."/".$this->get('log','serverjs').".log & "; 
        $descr = array();
        $pipes = array();
        $process= proc_open($cmd, $descr, $pipes,$this->getDirectory());
        $state=proc_get_status($process);
        $this->set('pid',$state['pid']);
        $this->save();
        $this->return = new mfArray($state);
        return $this;
    }*/
    function start(){
        $this->stop();    
        //$cmd=$this->get("nodejs","nodejs")." ".$this->getDirectory()."/".$this->getProgram()." ".$this->get('port')."> /dev/null 2>&1 & echo $!";        
        $cmd=$this->get("nodejs","nodejs")." ".$this->getDirectory()."/".$this->getProgram()." ".$this->get('port')." > ".$this->log_file->getFile()." 2>&1 & echo $!";                
        $return= exec($cmd);             
        $this->set('pid',$return);
        $this->save();
        $this->return = new mfArray($return);
        return $this;
    }
    
    function stop(){    
        if($this->get('pid')==null)
              return;                
        $return= exec("kill ".$this->get('pid'));
        $this->set('pid',null);
        $this->save();       
        $this->return = new mfArray($return);
        return $this;
    }
    
    function getLogName()
    {
        return "node-".$this->getProgram().".log";
    }
    
   function getReturn()
   {
       return $this->return;
   }
   
   function getPID()
   {
       return $this->get('pid');
   }
    
   function getLogFile()
   {
       return $this->log_file;
   }
    
}
