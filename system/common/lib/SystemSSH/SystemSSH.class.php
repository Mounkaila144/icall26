<?php

class SystemSSH
{
    private $connection=null,$stream=null,$ssh=null;
    protected $errors=null;
    protected $server=null;
	
        function hasErrors()
        {
            return !$this->errors->isEmpty();
        }
        
        function getErrors()
        {
            return $this->errors;
        }
         
    function getServer()
    {
        return $this->server;
    }
    
    public function __construct(mfServerSSH $server)
    {
        $this->errors=new mfArray();
        $this->server=$server;    
    }
    
    function getStream()
    {
        return $this->stream;
    }
    
    function getSSH()
    {
        return $this->ssh;
    }
    
    
    function connect()
    {        
        $this->connection =  ssh2_connect($this->getServer()->getHost(), $this->getServer()->getPort());                  
        return $this->connection;
    }

    function getConnection()
    {
        return $this->connection;
    }
    
    public function login($username, $password)
    {
        if (! @ssh2_auth_password($this->getConnection(), $username, $password))
        {        
           $this->errors[]="Could not authenticate with username ".$username." and password ".$password;        
           return false;
        }           
        if (!$this->ssh=ssh2_sftp($this->getConnection()))
        {                
            $this->errors[]="Could not initialize SSH subsystem.";
            return false;
        }   
        return $this;
    }

    /*public function upload($local_file)
    {
        $ssh = $this->ssh;
        $stream = @fopen("ssh2.ssh://$ssh$remote_file", 'r');


        if (! $stream)
            throw new Exception("Could not open file: $remote_file");

        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false)
            throw new Exception("Could not open local file: $local_file.");

        if (@fwrite($stream, $data_to_send) === false)
            throw new Exception("Could not send data from file: $local_file.");
        
        $fred = @fread($stream, filesize('ssh2.ssh://' . intval($ssh) . '/page22.html') );
        echo $fred ;

        @fclose($stream);
    }
    
	
    public function mkdir($directory)
    {
     
		return $this;	 
    }
	
	function rmdir($directory)
	{
		
		return $this;
	}
	
	function rm($file)
	{
		
		return $this;
	}
	
	function unlink()
	{
		return $this;
	}
	
	function link($link)
	{
		return $this;
	}
	
	public function rename($name)
    {
       
	   return $this;
    }
	
	public function download($file)
	{
		
		return $this;
	}
	
	public function chdir($name)
    {
       
	   return $this;
    }
	
	public function chmod($name)
    {
       
	   return $this;
    }
	
	public function glob($pattern)
    {
       
	   return $this;
    }
	
	public function getFiles()
    {
       
	   return $this;
    }
	
	public function getDirectories()
    {
       
	   return $this;
    }
	
	function close()
	{
		
		return $this;
	}
	
	function disconnect()
	{
		
		return $this;
	}
        
        function hasStream()
    {
        return $this->stream;
    }*/
    
    
     function opendir($directory="/.")
    {
         $this->dh=opendir("ssh2.sftp://".intval($this->ssh).$directory);            
         return $this;
    }
   
    
    
     function readdir()
    {
        return readdir($this->dh);
    } 
    
     function rawlist($directory="/")
    {
        $list=new sFtpItemCollection();           
        $directory=in_array($directory,array('/',''))?"/.":$directory;           
        $this->opendir($directory);           
       if ($this->dh===false)
            return $list;
        while (($file = $this->readdir()) !== false) {                   
             if (in_array($file,array('.','..')))
                  continue;               
             $list[]=new SFtpItem($this,$file,$directory);            
       }       
        return $list;
    } 
      
    
     public function __call($func,$a){        
        if(function_exists("ssh2_".$func)){
            array_unshift($a,$this->getConnection());
            return call_user_func_array("ssh2_".$func,$a);
        }
        throw new mfException('class '.get_class($this).' => Method ' . $func . ' not exists.');
    } 
}



