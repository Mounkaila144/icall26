<?php


class cronReport {
    
    protected $messages=array(),$name="",$start=0;
    
    function __construct($name)
    {
        $this->name=$name;
    }
    
    protected function getFileReport()
    {
        return mfConfig::get('mf_root_dir')."/log/cron_".$this->name.".log";
    }
    
    public function addMessage($message)
    {
        $this->messages[]=$message;
    }
    
    public function getMessages()
    {
        return $this->messages;
    }
    
    public function start()
    {
        $this->start=time();
        $this->addMessage(sprintf("[%s] [start]:%s ",date("d-m-Y"),date("H:i:s",time())));
    }
    
    public function save()
    {
        $this->addMessage(sprintf("[%s] [stop]:%s [duration]:%.3f s\n",date("d-m-Y"),date("H:i:s",time()),time()-$this->start));
        file_put_contents($this->getFileReport(), implode("\n",$this->messages), FILE_APPEND);
    }
    
    public function delete()
    {
       $this->getFile()->delete(); 
    }
    
    public function getFile()
    {
        if (!$this->_file)
             $this->_file= new File($this->getFileReport());
        return $this->_file;
    }
}

